#!/usr/bin/env bash
set -euo pipefail

MAX_BACKUPS=20
BRIDGE_TARGET="/home/xc_vm/crons/servers.php"
STREAMING_TARGET="/home/xc_vm/includes/StreamingUtilities.php"
BACKUP_ROOT="/home/.patch_backups"

usage() {
  cat <<'EOF'
Usage:
  /home/add_bridge_to_servers_cron.sh <action>
  /home/add_bridge_to_servers_cron.sh <patch> <action> [backup_file]

Patches:
  bridge      Patch /home/xc_vm/crons/servers.php (xbridge watchdog block)
  streaming   Patch /home/xc_vm/includes/StreamingUtilities.php (getStreamingURL block)

Actions:
  install              Apply patch (idempotent) and create backup
  list                 List backups for selected patch
  restore [backup]     Restore selected backup or latest backup

Examples:
  /home/add_bridge_to_servers_cron.sh install
  /home/add_bridge_to_servers_cron.sh restore
  /home/add_bridge_to_servers_cron.sh list
  /home/add_bridge_to_servers_cron.sh bridge install
  /home/add_bridge_to_servers_cron.sh bridge list
  /home/add_bridge_to_servers_cron.sh bridge restore
  /home/add_bridge_to_servers_cron.sh streaming install
  /home/add_bridge_to_servers_cron.sh streaming restore /home/.patch_backups/streaming/StreamingUtilities.php.bak.20260326090000
EOF
}

get_target_file() {
  local patch="$1"
  case "$patch" in
    bridge) echo "$BRIDGE_TARGET" ;;
    streaming) echo "$STREAMING_TARGET" ;;
    *)
      echo "Unknown patch type: $patch" >&2
      exit 1
      ;;
  esac
}

get_backup_dir() {
  local patch="$1"
  echo "$BACKUP_ROOT/$patch"
}

ensure_target() {
  local target_file="$1"
  if [[ ! -f "$target_file" ]]; then
    echo "Target file not found: $target_file" >&2
    exit 1
  fi
}

ensure_backup_dir() {
  local backup_dir="$1"
  mkdir -p "$backup_dir"
}

create_backup() {
  local target_file="$1"
  local backup_dir="$2"
  ensure_backup_dir "$backup_dir"
  local backup_file="$backup_dir/$(basename "$target_file").bak.$(date +%Y%m%d%H%M%S)"
  cp "$target_file" "$backup_file"
  echo "Backup created: $backup_file"
}

prune_backups() {
  local backup_dir="$1"
  local max_backups="$2"
  python3 <<PY
from pathlib import Path

backup_dir = Path(r"$backup_dir")
max_backups = int("$max_backups")
files = sorted(
    [p for p in backup_dir.glob("*.bak.*") if p.is_file()],
    key=lambda p: p.stat().st_mtime,
    reverse=True,
)
for old in files[max_backups:]:
    old.unlink(missing_ok=True)
PY
}

install_bridge_patch() {
  python3 <<'PY'
from pathlib import Path
import sys

target = Path("/home/xc_vm/crons/servers.php")
text = target.read_text(encoding="utf-8")

bridge_block = """        $rBridge = intval(trim(shell_exec('pgrep -U xc_vm | xargs ps -f -p | grep /bin/xbridge | grep -v grep | grep -v pgrep | wc -l')));
        if ($rBridge == 0 && $rServers[SERVER_ID]['is_main']) {
            shell_exec('rm -rf /tmp/app.sock;' . BIN_PATH . 'xbridge > /dev/null 2>/dev/null &');
        }
"""

if "/bin/xbridge" in text:
    print("Bridge block already present. No changes made.")
    sys.exit(0)

needle = "        $rNetwork = intval(trim(shell_exec('pgrep -U xc_vm | xargs ps -f -p | grep network | grep -v grep | grep -v pgrep | wc -l')));"
if needle not in text:
    print("Could not find network block insertion point.", file=sys.stderr)
    sys.exit(2)

target.write_text(text.replace(needle, bridge_block + needle, 1), encoding="utf-8")
print("Inserted bridge startup block successfully.")
PY
}

install_streaming_patch() {
  python3 <<'PY'
from pathlib import Path
import re
import sys

target = Path("/home/xc_vm/includes/StreamingUtilities.php")
target_text = target.read_text(encoding="utf-8")

target_pattern = re.compile(
    r"public static function getStreamingURL\([^\)]*\)\s*\{.*?(?=\n\s*/\*\*)",
    re.S,
)

replacement = """public static function getStreamingURL($redirect_id = null, $originator_id = null, $isStandard = false, $user_info = null) {
                // init
                $rUrl = '';
                $host = HOST; //means this main server at default
                $protocol = 'http';
                $rMode = 'EMPTY';
                $allocated_domain = "";

                $selected_server = self::$rServers[$redirect_id];
                $domain_list = array_filter(explode(',', $selected_server["domain_name"]));

                // set the protocol
                if ($isStandard) {
                    $protocol = "http";
                } else{
                    if (self::$rSettings["keep_protocol"]) {
                        $protocol = !empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== "off" || $_SERVER["SERVER_PORT"] == 443 ? "https" : "http";
                    } else{
                        $protocol = $selected_server["server_protocol"];
                    }
                }
                $port = $selected_server[$protocol . "_broadcast_port"]; //set the port

                // fetch bridge data
                $sock = socket_create(AF_UNIX, SOCK_STREAM, 0);
                if (socket_connect($sock, '/tmp/app.sock')) {
                    $msg = "domain." . $user_info['id'];
                    socket_write($sock, $msg, strlen($msg));
                    socket_write($sock, "\\0", 1);
                    $allocated_domain = trim(socket_read($sock, 200));
                    socket_close($sock);
                }
                $sock_mode = socket_create(AF_UNIX, SOCK_STREAM, 0);
                if (socket_connect($sock_mode, '/tmp/app.sock')) {
                    socket_write($sock_mode, "mode", 4);
                    socket_write($sock_mode, "\\0", 1);
                    $rMode = trim(socket_read($sock_mode, 200));
                    if ($rMode === '') {
                        $rMode = 'EMPTY';
                    }
                    socket_close($sock_mode);
                }
                if(!empty($allocated_domain) && $allocated_domain != null && $rMode != 'EMPTY') {
                    // UCS allocated domain
                    if($rMode == "VPS") {
                        // need to implement later
                    }else if($rMode == "DOMAIN" || $rMode == "CFDOMAIN") {
                        $host = strval(ip2long(self::$rServers[$redirect_id]["server_ip"])) . "." . $allocated_domain;
                    }
                } else if(count($domain_list) > 0) {
                    // use the domain to direct the request
                    if($selected_server["random_ip"]) {
                        $host = $domain_list[array_rand($domain_list)];
                    }else{
                        $host = $domain_list[0];
                    }
                    $host = str_replace('*.', $user_info['id'] . '.', $host);
                }else{
                    // use the ip to direct the request
                    $host = $selected_server["server_ip"];
                }

                $rUrl = $protocol . "://" . $host . ":" . $port;

                //I guess this is the case for the proxy
                if ($selected_server["server_type"] == 1 && $originator_id && self::$rServers[$originator_id]["is_main"] == 0) {
                    $rUrl .= "/" . md5($redirect_id . "_" . $originator_id . "_" . OPENSSL_EXTRA);
                }
                return $rUrl;
            }
"""

new_text, count = target_pattern.subn(lambda _: replacement, target_text, count=1)
if count != 1:
    print("Failed to locate getStreamingURL() in target file.", file=sys.stderr)
    sys.exit(2)

new_text = new_text.replace("\x00", "\\0")
target.write_text(new_text, encoding="utf-8")
print("Replaced getStreamingURL() in target successfully.")
PY
}

list_backups() {
  local backup_dir="$1"
  ensure_backup_dir "$backup_dir"
  python3 <<PY
from pathlib import Path

backup_dir = Path(r"$backup_dir")
files = sorted(
    [p for p in backup_dir.glob("*.bak.*") if p.is_file()],
    key=lambda p: p.stat().st_mtime,
    reverse=True,
)
if not files:
    print("No backups found.")
else:
    for f in files:
        print(str(f))
PY
}

restore_backup() {
  local target_file="$1"
  local backup_dir="$2"
  local selected_backup="${3:-}"
  ensure_backup_dir "$backup_dir"

  if [[ -z "$selected_backup" ]]; then
    selected_backup="$(python3 <<PY
from pathlib import Path

backup_dir = Path(r"$backup_dir")
files = sorted(
    [p for p in backup_dir.glob("*.bak.*") if p.is_file()],
    key=lambda p: p.stat().st_mtime,
    reverse=True,
)
print(str(files[0]) if files else "")
PY
)"
  fi

  if [[ -z "$selected_backup" ]]; then
    echo "No backups available to restore." >&2
    exit 1
  fi

  if [[ ! -f "$selected_backup" ]]; then
    echo "Backup file not found: $selected_backup" >&2
    exit 1
  fi

  cp "$selected_backup" "$target_file"
  php -l "$target_file"
  echo "Restored from: $selected_backup"
}

install_patch() {
  local patch="$1"
  local target_file="$2"
  local backup_dir="$3"

  create_backup "$target_file" "$backup_dir"
  case "$patch" in
    bridge) install_bridge_patch ;;
    streaming) install_streaming_patch ;;
  esac
  php -l "$target_file"
  prune_backups "$backup_dir" "$MAX_BACKUPS"
  echo "Install complete."
}

main() {
  local arg1="${1:-}"
  local arg2="${2:-}"
  local arg3="${3:-}"
  local patches=("bridge" "streaming")

  if [[ -z "$arg1" ]]; then
    usage
    exit 1
  fi

  # Single-command mode: install/restore/list applies to both patches.
  if [[ "$arg1" == "install" || "$arg1" == "restore" || "$arg1" == "list" ]]; then
    local action="$arg1"
    for patch in "${patches[@]}"; do
      local target_file
      target_file="$(get_target_file "$patch")"
      local backup_dir
      backup_dir="$(get_backup_dir "$patch")"
      ensure_target "$target_file"
      echo "== $patch =="
      case "$action" in
        install) install_patch "$patch" "$target_file" "$backup_dir" ;;
        list) list_backups "$backup_dir" ;;
        restore) restore_backup "$target_file" "$backup_dir" ;;
      esac
    done
    exit 0
  fi

  # Patch-specific mode: <patch> <action> [backup_file]
  local patch="$arg1"
  local action="$arg2"
  local maybe_backup="$arg3"

  if [[ -z "$patch" || -z "$action" ]]; then
    usage
    exit 1
  fi

  local target_file
  target_file="$(get_target_file "$patch")"
  local backup_dir
  backup_dir="$(get_backup_dir "$patch")"

  ensure_target "$target_file"
  case "$action" in
    install) install_patch "$patch" "$target_file" "$backup_dir" ;;
    list) list_backups "$backup_dir" ;;
    restore) restore_backup "$target_file" "$backup_dir" "$maybe_backup" ;;
    *)
      usage
      exit 1
      ;;
  esac
}

main "$@"
