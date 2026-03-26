#!/usr/bin/env bash
set -euo pipefail

MAX_BACKUPS=20
BRIDGE_TARGET="/home/xc_vm/crons/servers.php"
STREAMING_TARGET="/home/xc_vm/includes/StreamingUtilities.php"
MIDNIGHT_TARGET="/home/midnightstreamer/iptv_midnight_streamer/wwwdir/application/controllers/clients_live.php"
MIDNIGHT_FILE_OWNER="midnightstreamer:midnightstreamer"
MIDNIGHT_PATCH_URL="https://raw.githubusercontent.com/hserver71/ucs-plusin/main/midnight_patch.php"
BACKUP_ROOT="/home/.patch_backups"
MIDNIGHT_TMP_FILE=""

cleanup_temp_files() {
  if [[ -n "$MIDNIGHT_TMP_FILE" && -f "$MIDNIGHT_TMP_FILE" ]]; then
    rm -f "$MIDNIGHT_TMP_FILE"
  fi
}
trap cleanup_temp_files EXIT

usage() {
  cat <<'EOF'
Usage:
  ./install.sh <project> <action> [patch_or_backup] [backup_file]

Projects:
  xc_vm       Patch xc_vm files
  midnight    Patch MidnightStreamer clients_live.php

xc_vm patches:
  bridge      Patch /home/xc_vm/crons/servers.php (xbridge watchdog block)
  streaming   Patch /home/xc_vm/includes/StreamingUtilities.php (getStreamingURL block)

Actions:
  install              Apply patch (idempotent) and create backup only when file changes
  list                 List backups
  restore [backup]     Restore selected backup or latest backup

Examples:
  ./install.sh xc_vm install
  ./install.sh xc_vm list
  ./install.sh xc_vm restore
  ./install.sh xc_vm install bridge
  ./install.sh xc_vm restore streaming /home/.patch_backups/xc_vm/streaming/StreamingUtilities.php.bak.20260326090000
  ./install.sh midnight install
  ./install.sh midnight list
  ./install.sh midnight restore
EOF
}

get_target_file() {
  local project="$1"
  local patch="$2"
  case "$project:$patch" in
    xc_vm:bridge) echo "$BRIDGE_TARGET" ;;
    xc_vm:streaming) echo "$STREAMING_TARGET" ;;
    midnight:midnight) echo "$MIDNIGHT_TARGET" ;;
    *)
      echo "Unknown project/patch: $project / $patch" >&2
      exit 1
      ;;
  esac
}

get_backup_dir() {
  local project="$1"
  local patch="$2"
  if [[ "$project" == "midnight" ]]; then
    echo "$BACKUP_ROOT/midnight"
  else
    echo "$BACKUP_ROOT/$project/$patch"
  fi
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

download_midnight_patch() {
  if [[ -n "$MIDNIGHT_TMP_FILE" && -f "$MIDNIGHT_TMP_FILE" ]]; then
    return 0
  fi

  MIDNIGHT_TMP_FILE="$(mktemp /tmp/midnight_patch.XXXXXX.php)"
  echo "Downloading midnight patch from GitHub raw..."
  curl -fsSL "$MIDNIGHT_PATCH_URL" -o "$MIDNIGHT_TMP_FILE"
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
  local target_file="$1"
  python3 <<PY
from pathlib import Path
import sys

target = Path(r"$target_file")
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
  local target_file="$1"
  python3 <<PY
from pathlib import Path
import re
import sys

target = Path(r"$target_file")
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

install_midnight_patch() {
  local target_file="$1"
  if [[ -z "$MIDNIGHT_TMP_FILE" || ! -f "$MIDNIGHT_TMP_FILE" ]]; then
    echo "Midnight patch temp file missing. Download failed." >&2
    exit 1
  fi

  mv "$MIDNIGHT_TMP_FILE" "$target_file"
  MIDNIGHT_TMP_FILE=""
  chown "$MIDNIGHT_FILE_OWNER" "$target_file"
  chmod 0777 "$target_file"
  echo "Replaced target with downloaded midnight patch from /tmp (owner set to $MIDNIGHT_FILE_OWNER)."
}

patch_needs_install() {
  local project="$1"
  local patch="$2"
  local target_file="$3"

  case "$project:$patch" in
    xc_vm:bridge)
      if python3 <<PY
from pathlib import Path
text = Path(r"$target_file").read_text(encoding="utf-8")
raise SystemExit(0 if "/bin/xbridge" not in text else 1)
PY
      then
        return 0
      else
        return 1
      fi
      ;;
    xc_vm:streaming)
      if python3 <<PY
from pathlib import Path
text = Path(r"$target_file").read_text(encoding="utf-8")
markers = [
    "socket_connect($sock, '/tmp/app.sock')",
    "$msg = \"domain.\" . $user_info['id'];",
    "public static function getStreamingURL($redirect_id = null, $originator_id = null, $isStandard = false, $user_info = null)"
]
raise SystemExit(1 if all(m in text for m in markers) else 0)
PY
      then
        return 0
      else
        return 1
      fi
      ;;
    midnight:midnight)
      download_midnight_patch
      if cmp -s "$MIDNIGHT_TMP_FILE" "$target_file"; then
        return 1
      fi
      return 0
      ;;
    *)
      echo "Unknown patch: $project / $patch" >&2
      exit 1
      ;;
  esac
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
  echo "Restored from: $selected_backup"
}

install_patch() {
  local project="$1"
  local patch="$2"
  local target_file="$3"
  local backup_dir="$4"

  if ! patch_needs_install "$project" "$patch" "$target_file"; then
    echo "Patch already installed for $project/$patch. No changes made."
    return 0
  fi

  create_backup "$target_file" "$backup_dir"
  case "$project:$patch" in
    xc_vm:bridge) install_bridge_patch "$target_file" ;;
    xc_vm:streaming) install_streaming_patch "$target_file" ;;
    midnight:midnight) install_midnight_patch "$target_file" ;;
    *)
      echo "Unknown patch: $project / $patch" >&2
      exit 1
      ;;
  esac

  prune_backups "$backup_dir" "$MAX_BACKUPS"
  echo "Install complete for $project/$patch."
}

run_for_patch() {
  local project="$1"
  local patch="$2"
  local action="$3"
  local maybe_backup="${4:-}"

  local target_file
  target_file="$(get_target_file "$project" "$patch")"
  local backup_dir
  backup_dir="$(get_backup_dir "$project" "$patch")"

  ensure_target "$target_file"
  echo "== $project / $patch =="
  case "$action" in
    install) install_patch "$project" "$patch" "$target_file" "$backup_dir" ;;
    list) list_backups "$backup_dir" ;;
    restore) restore_backup "$target_file" "$backup_dir" "$maybe_backup" ;;
    *)
      usage
      exit 1
      ;;
  esac
}

main() {
  local project="${1:-}"
  local action="${2:-}"
  local arg3="${3:-}"
  local arg4="${4:-}"

  if [[ -z "$project" || -z "$action" ]]; then
    usage
    exit 1
  fi

  case "$project" in
    xc_vm)
      if [[ -z "$arg3" ]]; then
        for patch in bridge streaming; do
          run_for_patch "$project" "$patch" "$action"
        done
      else
        local patch="$arg3"
        if [[ "$patch" != "bridge" && "$patch" != "streaming" ]]; then
          echo "Invalid xc_vm patch: $patch" >&2
          exit 1
        fi
        run_for_patch "$project" "$patch" "$action" "$arg4"
      fi
      ;;
    midnight)
      run_for_patch "$project" "midnight" "$action" "$arg3"
      ;;
    *)
      usage
      exit 1
      ;;
  esac
}

main "$@"
