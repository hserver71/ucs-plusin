<?php 
// Decoded file for php version 72.
if( defined("BASEPATH") ) 
{

class Clients_live extends Cli_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($fc2a167a09521747688932a80d94dd3f = "", $E9de05dd30389f87f6b5fbdff8a09bfb = "", $bd4899690fc160f6505c95b627e712ed = "", $c6cef649c5ccc2e49628212e385609d9 = "", $E69f16cb1d07c47c0973074ea5fc1dea = -1, $E284e1670ab070d4174de07b7785f292 = "", $ef9f2f872a955ba4cb4705bf0beeb69f = "-1", $afdcaab101de2b8db331d46c5bd2a3ad = -1, $cb09066a5ec2eb4f26f3e827570d96ad = -1, $f0f1b8dccf11e21d74fd94d4b68b83f4 = "", $bd9207b0a10a30baa611eee87a79cd30 = "", $adcb27fd4144232f8e83e92003e5ec9d = 0, $Ec2f979a3f78cac1bc2dc13a3f1f2305 = "", $Db151558825f38b3793a66c3a5e04779 = "")
    {
        $e143cb387aec179ecf671d2c80bd4c07 = explode("&", $c6cef649c5ccc2e49628212e385609d9);
        $this->stalker_key = $E284e1670ab070d4174de07b7785f292;
        if( !isset($e143cb387aec179ecf671d2c80bd4c07[1]) ) 
        {
        }
        else
        {
            $c6cef649c5ccc2e49628212e385609d9 = $e143cb387aec179ecf671d2c80bd4c07[0];
            parse_str($e143cb387aec179ecf671d2c80bd4c07[1], $B538453e2ce3f7160c48111a0194d68c);
            if( !isset($B538453e2ce3f7160c48111a0194d68c["stalker_key"]) ) 
            {
            }
            else
            {
                $this->stalker_key = $B538453e2ce3f7160c48111a0194d68c["stalker_key"];
            }

        }

        set_time_limit(0);
        if( $this->settings->buffer_stream ) 
        {
        }
        else
        {
            header("X-Accel-Buffering: no");
        }

        header("Access-Control-Allow-Origin: *");
        $this->username = $fc2a167a09521747688932a80d94dd3f;
        $this->password = $E9de05dd30389f87f6b5fbdff8a09bfb;
        $this->sid = $bd4899690fc160f6505c95b627e712ed;
        $this->extension = $c6cef649c5ccc2e49628212e385609d9;
        $this->num_fragment = $E69f16cb1d07c47c0973074ea5fc1dea;
        $this->archive_time = urldecode($ef9f2f872a955ba4cb4705bf0beeb69f);
        $this->xc_archive_duration = $Ec2f979a3f78cac1bc2dc13a3f1f2305;
        $this->token = ($afdcaab101de2b8db331d46c5bd2a3ad != -1 ? _decrypt(urldecode($afdcaab101de2b8db331d46c5bd2a3ad)) : (isset($this->token) ? $this->token : -1));
        $this->hls_token = $Db151558825f38b3793a66c3a5e04779;
        $this->preview = false;
        $this->ip = ($c6cef649c5ccc2e49628212e385609d9 != "rtmp" ? $_SERVER[$this->settings->get_real_ip_client] : $f0f1b8dccf11e21d74fd94d4b68b83f4);
        $this->country = @_get_ip_country_code($this->ip);
        $this->isp = @_get_ip_isp($this->ip);
        $this->anonymous = @_get_ip_anonymous($this->ip);
        $this->user_agent = (!empty($_SERVER["HTTP_USER_AGENT"]) ? $_SERVER["HTTP_USER_AGENT"] : "unknown");
        $this->rtmp_client_id = $bd9207b0a10a30baa611eee87a79cd30;
        $this->adaptive_level = $adcb27fd4144232f8e83e92003e5ec9d;
        $this->adaptive_streaming_locked = ($adcb27fd4144232f8e83e92003e5ec9d != 0 ? true : false);
        $this->server_time = _time();
        if( in_array($c6cef649c5ccc2e49628212e385609d9, array_merge(["m3u8", "rtmp"], _get_container_formats())) ) 
        {
        }
        else
        {
            $this->lines_model->F6F1D68dA8d25b3C1b8C9abE62Fac2E5($fc2a167a09521747688932a80d94dd3f, uri_string(), _LINE_ERROR_INVALID_FORMAT, $this->sid, $this->ip, $this->user_agent, $this->country, $this->isp);
            show_404();
        }

        if( $E9de05dd30389f87f6b5fbdff8a09bfb == $this->settings->preview_pass ) 
        {
            $this->preview = true;
            $this->line = new stdClass();
            $this->line->id = -1;
            $this->line->server_id = 0;
            $this->line->username = "preview";
            $this->line->password = "preview";
            $this->line->reseller_id = -1;
            $this->line->restreamer = 1;
            $this->line->line_hostname = NULL;
            $this->line->reseller_hostname = NULL;
            $this->line->https = 1;
            $this->line->vpn = $this->settings->cms_vpn;
            $this->line->no_stream_video_stream_id = NULL;
            $this->line->mac_address = NULL;
            $this->line->log_errors = false;
            $this->line->encrypt_playlist = false;
            $this->adaptive_streaming_locked = true;
        }
        else
        {
            if( $fc2a167a09521747688932a80d94dd3f != "" && $E9de05dd30389f87f6b5fbdff8a09bfb != "" && $bd4899690fc160f6505c95b627e712ed != "" && $c6cef649c5ccc2e49628212e385609d9 != "" ) 
            {
                if( ($this->line = $this->lines_model->E6FD269b9D19af910ACc0C17435A4EBA($fc2a167a09521747688932a80d94dd3f, $E9de05dd30389f87f6b5fbdff8a09bfb)) !== false ) 
                {
                }
                else
                {
                    $this->lines_model->f6f1d68DA8d25B3c1b8c9abE62fAc2e5($fc2a167a09521747688932a80d94dd3f, uri_string(), _LINE_ERROR_AUTH_FAILED, $this->sid, $this->ip, $this->user_agent, $this->country, $this->isp);
                    show_error("Forbidden", 403);
                }

            }
            else
            {
                $this->lines_model->F6F1d68da8D25b3C1B8C9abE62FAc2e5($fc2a167a09521747688932a80d94dd3f, uri_string(), _LINE_ERROR_URI_INCOMPLETE, $this->sid, $this->ip, $this->user_agent, $this->country, $this->isp);
                show_404();
            }

        }

        $this->stream = $this->streams_model->AEabF7DB8e80cFbcE898e268F6220608($this->sid);
        if( !$this->C1876E969B998a303636262f55E0fdF7() ) 
        {
        }
        else
        {
            show_error("Forbidden", 403);
        }

        if( is_object($this->stream) ) 
        {
        }
        else
        {
            $this->lines_model->f6f1d68DA8d25b3C1b8C9aBe62fAc2e5(($this->line->mac_address != NULL ? $this->line->mac_address : $fc2a167a09521747688932a80d94dd3f), uri_string(), _LINE_ERROR_NO_STREAM, $this->sid, $this->ip, $this->user_agent, $this->country, $this->isp, $this->line->log_errors, $this->line->id);
            $this->sid = ($this->line->no_stream_video_stream_id != NULL ? $this->line->no_stream_video_stream_id : $this->settings->no_stream_video_stream_id);
            if( $this->sid == NULL ) 
            {
            }
            else
            {
                $this->f05774e81A8D25EDdE2840Dc93c195a0();
            }

            show_404();
        }

        if( $this->archive_time == "-1" ) 
        {
        }
        else
        {
            $this->stream->type = _STREAM_TYPE_ARCHIVE;
        }

        if( !$this->preview ) 
        {
            if( !($this->extension != "m3u8" && !$this->b48c167Cb1D38801bA07f55F6B52F639() && !$this->server->main && !$this->server->allow_direct_conn && 10 < _time() - $this->token) ) 
            {
            }
            else
            {
                $this->lines_model->f6F1d68da8D25b3c1b8C9ABe62fAc2e5(($this->line->mac_address != NULL ? $this->line->mac_address : $fc2a167a09521747688932a80d94dd3f), uri_string(), _LINE_ERROR_INVALID_TOKEN, $this->sid, $this->ip, $this->user_agent, $this->country, $this->isp, $this->line->log_errors, $this->line->id);
                show_error("Forbidden", 403);
            }

        }

        if( !(!$this->preview && ($this->server->main || $this->server->allow_direct_conn) && ($this->extension != "m3u8" && !$this->B48C167cb1d38801BA07f55f6b52F639() || $this->extension == "m3u8" && $this->hls_token == "" && $this->num_fragment == -1)) ) 
        {
        }
        else
        {
            $this->lines_model->b37EF7EB7CB7082a6E2053DcbfabedD8($this->line->id, $this->sid);
        }

        $this->bC9eeD73390DbfCD77Fd114498AD7545();
        if( $this->archive_time == "-1" ) 
        {
            if( $this->line->server_id ) 
            {
                if( $this->server_config->server_id == $this->line->server_id ) 
                {
                }
                else
                {
                    $this->server = $this->servers_model->D886445738DAB32adAAE918e808a8774($this->line->server_id);
                }

            }
            else
            {
                if( !($this->line->id != -1 && !$this->stream->redirect && ($this->server->main || $this->server->allow_direct_conn) && $this->server_config->server_id != ($bde9d82238cc5126be8d68f4ff6d00b5 = $this->dB83A01752506656C6F8E4fa39693ec6())) ) 
                {
                }
                else
                {
                    if( $bde9d82238cc5126be8d68f4ff6d00b5 == -1 ) 
                    {
                    }
                    else
                    {
                        $this->server = $this->servers_model->D886445738DaB32AdaAE918E808A8774($bde9d82238cc5126be8d68f4ff6d00b5);
                    }

                }

            }

        }
        else
        {
            if( $this->server_config->server_id == $this->stream->tv_archive_server_id ) 
            {
            }
            else
            {
                $this->server = $this->servers_model->D886445738dAb32AdAae918E808a8774($this->stream->tv_archive_server_id);
            }

        }

        if( $this->server->id == $this->server_config->server_id ) 
        {
        }
        else
        {
            $C5b3d43234e8d53313c4effe1a45d551 = "/play/" . str_replace("%2F", "_", rawurlencode(_encrypt(json_encode(["username" => $this->line->username, "password" => $this->line->password, "id" => $this->sid, "archive_time" => $this->archive_time, "token" => $this->server_time, "url_num" => $cb09066a5ec2eb4f26f3e827570d96ad, "rtmp_ip_address" => $f0f1b8dccf11e21d74fd94d4b68b83f4, "rtmp_client_id" => $bd9207b0a10a30baa611eee87a79cd30, "adaptive_level" => $this->adaptive_level, "xc_archive_duration" => $this->xc_archive_duration])))) . "/" . $this->extension;
            
            $redirect_url = "";
            $protocol ="http" . ((!$this->line->https ? "" : "s"));

            if($this->line->vpn && $this->server->vpn_ip){
                $redirect_url = $this->server->vpn_ip;
            }else if($this->server->hostname != NULL){
                if(explode(".", $this->server->hostname, 2)[0] == "wildcard"){
                    $random_string_8 = bin2hex(random_bytes(4));
                    $master_dns = explode(".", $this->server->hostname, 2)[1];
                    $redirect_url = $random_string_8 . strval($this->line->id + 1234) . "h." . $master_dns;
                }else{
                    $redirect_url = $this->server->hostname;
                }
            }else{
                 $redirect_url = $this->server->server_ip;
            }
            redirect($protocol . "://" . $redirect_url . ":" . ((!$this->line->https ? $this->server->http_port : $this->server->https_port)) . $C5b3d43234e8d53313c4effe1a45d551);
        }

        if( $this->stream->type != _STREAM_TYPE_LIVE ) 
        {
        }
        else
        {
            $this->stream->proxy = $this->streams_model->d5d0166AA78D35BAFd953924F18d7847($this->stream->proxy_servers);
        }

        $this->on_demand = false;
        $this->url_num = NULL;
        $this->original_sid = $this->sid;
        $this->current_adaptive_stream = -1;
        $this->stream->adaptive_streams = json_decode($this->stream->adaptive_streams, true);
        $this->stream->transcoding_options = json_decode($this->stream->transcoding_options);
        $this->adaptive_levels_count = (is_object($this->stream->transcoding_options) && property_exists($this->stream->transcoding_options, "avg_video_bitrate") ? count($this->stream->transcoding_options->avg_video_bitrate[1]) : 0);
        if( in_array($this->stream->type, [_STREAM_TYPE_LIVE, _STREAM_TYPE_CHANNELS]) && !$this->stream->redirect ) 
        {
            if( $this->stream->delay && !$this->stream->use_ramdisk ) 
            {
                $this->streams_dir = _DELAY_DIR;
            }
            else
            {
                $this->streams_dir = _STREAMS_DIR;
            }

            if( $this->stream->proxy ) 
            {
            }
            else
            {
                $this->on_demand = $this->streams_model->B9E3DDf9Ecb664238cdd1aEf400B70dF($this->stream->on_demand_servers);
                $Fa544d772f0fceae55b6f9f386aae760 = $this->streams_model->af1DA44A7633e136041cEC14005832eb($this->stream->servers);
                $this->stream_server_id = $Fa544d772f0fceae55b6f9f386aae760[0];
                $this->url_num = ($cb09066a5ec2eb4f26f3e827570d96ad == -1 ? $this->c54b3C82541912F15409d00C9569e10e() : $cb09066a5ec2eb4f26f3e827570d96ad);
                $this->mandatory_url_num = ($cb09066a5ec2eb4f26f3e827570d96ad == -1 ? false : true);
            }

        }
        else
        {
            if( $this->stream->type == _STREAM_TYPE_VOD ) 
            {
                $this->streams_dir = _MOVIES_DIR;
            }

        }

        if( !in_array($this->extension, _get_container_formats()) ) 
        {
        }
        else
        {
            $this->lines_model->C824C69F0dF522067C20d88c854fd0E3($this->line->id, $this->sid, $this->ip, $this->user_agent, $this->country, $this->isp, $this->url_num, $this->stalker_key, _CONNECTION_TYPE_MPEGTS, -1, $this->stream->redirect, $this->stream->append_flussonic_token);
            $this->mpegts_lines_log_insert_id = $this->db->F8B21658eF0740f944923c5db0a1Fe66();
            $this->conn_time = _time();
            if( $this->stream->redirect && (!$this->stream->redirect || $this->stream->append_flussonic_token) ) 
            {
            }
            else
            {
                register_shutdown_function([$this, "_shutdown_stream"]);
            }

        }

        if( $this->extension != "m3u8" ) 
        {
        }
        else
        {
            if( $this->hls_token == "" && $this->num_fragment == -1 ) 
            {
                $this->lines_model->c824c69f0Df522067c20D88C854FD0E3($this->line->id, $this->sid, $this->ip, $this->user_agent, $this->country, $this->isp, $this->url_num, $this->stalker_key, _CONNECTION_TYPE_HLS, -1, $this->stream->redirect, $this->stream->append_flussonic_token);
                $this->hls_lines_log = new stdClass();
                $this->hls_lines_log->id = $this->db->f8B21658Ef0740F944923c5Db0A1fE66();
                $this->hls_lines_log->connection_time = 0;
                $this->hls_lines_log->speed = NULL;
            }
            else
            {
                $c883d9210da257983308aaf91bfbe4d9 = $this->aE1f80257Ea5d13b7382F7A425F839a8();
                $this->hls_lines_log = new stdClass();
                $this->hls_lines_log->id = $c883d9210da257983308aaf91bfbe4d9->id;
                $this->hls_lines_log->connection_time = $c883d9210da257983308aaf91bfbe4d9->connection_time;
                $this->hls_lines_log->speed = $c883d9210da257983308aaf91bfbe4d9->speed;
            }

        }

        if( !$this->FB4b61f859648726c9D7040B1a68d6EB() ) 
        {
        }
        else
        {
            show_error("Forbidden", 403);
        }

        if( $this->extension != "rtmp" ) 
        {
            if( in_array($this->stream->type, [_STREAM_TYPE_LIVE, _STREAM_TYPE_CHANNELS]) ) 
            {
                if( $this->stream->redirect ) 
                {
                    $this->Da537B0A841CDca0B8604C8DA608417a();
                }
                else
                {
                    if( $this->stream->proxy ) 
                    {
                        if( $this->extension != "ts" ) 
                        {
                        }
                        else
                        {
                            $this->fE706ee1c129A70f3FD2dfe4F1f3B771();
                        }

                    }
                    else
                    {
                        if( $this->extension == "ts" ) 
                        {
                            $this->E4a03C6E8Ec8cF278BCD792949D6640c();
                        }
                        else
                        {
                            if( $this->extension == "m3u8" ) 
                            {
                                $this->A4EB049c9e93BA88A184De9D8Ce26aDd();
                            }

                        }

                    }

                }

            }
            else
            {
                if( in_array($this->stream->type, [_STREAM_TYPE_VOD, _STREAM_TYPE_ARCHIVE]) ) 
                {
                    if( $this->stream->redirect ) 
                    {
                        $this->da537b0a841CdCa0b8604c8da608417a();
                    }
                    else
                    {
                        if( $this->stream->proxy ) 
                        {
                            $this->A38165A05941f06D13cE456E4FEe04f2();
                        }
                        else
                        {
                            if( in_array($this->extension, _get_container_formats()) ) 
                            {
                                $this->A38165a05941f06D13Ce456e4fEE04f2();
                            }

                        }

                    }

                }
                else
                {
                    if( $this->stream->type == _STREAM_TYPE_POSTERS ) 
                    {
                        if( !in_array($this->extension, _get_container_formats()) ) 
                        {
                        }
                        else
                        {
                            $this->A38165A05941f06D13cE456E4FEe04f2();
                        }

                    }
                    else
                    {
                        if( in_array($this->stream->type, [_STREAM_TYPE_VIDEO_ERROR_NO_VIDEO, _STREAM_TYPE_VIDEO_ERROR_BANNED, _STREAM_TYPE_VIDEO_ERROR_LINE_EXPIRED]) ) 
                        {
                            if( $this->extension == "ts" ) 
                            {
                                $this->f05774e81A8d25EdDe2840dc93c195a0();
                            }
                            else
                            {
                                if( in_array($this->extension, _get_container_formats()) ) 
                                {
                                    $this->A38165A05941f06d13CE456e4FEE04f2();
                                }

                            }

                        }

                    }

                }

            }

        }
        else
        {
            $this->conn_time = _time();
            $this->lines_model->c824C69f0Df522067c20d88c854FD0e3($this->line->id, $this->sid, $this->ip, $this->user_agent, $this->country, $this->isp, $this->url_num, $this->stalker_key, _CONNECTION_TYPE_RTMP, $bd9207b0a10a30baa611eee87a79cd30);
            $this->lines_model->fa95938EFca8c5686E5915F9B71851E1($this->line->id, $this->sid, $this->conn_time);
            http_response_code(201);
            exit();
        }

    }

    public function c1876e969b998a303636262F55e0FDF7()
    {
        if( !$this->preview ) 
        {
            if( $this->_check_allowed_ips() ) 
            {
                if( $this->a8f584AB5C6E77df006D5A46b6FE21e4() ) 
                {
                    if( !(is_object($this->stream) && in_array($this->stream->type, [_STREAM_TYPE_VIDEO_ERROR_NO_VIDEO, _STREAM_TYPE_VIDEO_ERROR_BANNED, _STREAM_TYPE_VIDEO_ERROR_LINE_EXPIRED])) ) 
                    {
                        if( !$this->A7859B30630Db629e9F2534f1a57fB84() ) 
                        {
                            if( !$this->e2E8860Cc38776F486a58EAE99Af7c89() ) 
                            {
                                if( !$this->a88C3c3E14f47b3138EEC5C597A27690() ) 
                                {
                                    if( $this->B42025Bb9A4b46D176d3F9023721E088() ) 
                                    {
                                        if( $this->e4819246dfF71b789C66773B37Eeefd9() ) 
                                        {
                                            if( !$this->af13f6bDcE567dA4B92937caB42AA724() ) 
                                            {
                                                if( $this->Ed7834dE5D74c700cae867Bc059aD467() ) 
                                                {
                                                    if( !$this->a75d2322AA8F1d1047DBA005ac44Ac68() ) 
                                                    {
                                                        if( !$this->e4e3BF5385d3E39C3EFA1546B29CA359() ) 
                                                        {
                                                            if( !$this->E40de64999fc9eA140D9a7b2E930175a() ) 
                                                            {
                                                                if( !$this->BDfB366C316af89eE5Fbd4Cc35f6b810() ) 
                                                                {
                                                                    if( !$this->bb7d1cB8664a7b1f38A7e661B2DFB3CA() ) 
                                                                    {
                                                                        if( !$this->DFE68048b9C67727273a9c0233c3caBE() ) 
                                                                        {
                                                                            if( !$this->aF06E423c832EfA5d9C2382D7B2c7aef() ) 
                                                                            {
                                                                                if( !$this->ed049463BA1a88Ac31CA62aa3448606e() ) 
                                                                                {
                                                                                    if( !$this->DE9b1C23C07D3ef51342217EdF8BfB80() ) 
                                                                                    {
                                                                                        if( $this->DC678cDF057A5B6BD2aA34bf5c503D38() ) 
                                                                                        {
                                                                                            if( $this->a4EDb93269C5b01544c71805c400fdD3() ) 
                                                                                            {
                                                                                                if( $this->E046A4a3D007092b8242acA9F32ed205() ) 
                                                                                                {
                                                                                                    if( $this->f87de0B2aB174Ad52C80bd903468a1d2() ) 
                                                                                                    {
                                                                                                        if( $this->b56F95C1589Bf1bD64C8c4faB38Bc0f4() ) 
                                                                                                        {
                                                                                                            if( $this->DE766714f4181B0185e022D9CED6Dd5D() ) 
                                                                                                            {
                                                                                                                if( $this->C4a0297AC9440C451Ba0Ea0084601d20() ) 
                                                                                                                {
                                                                                                                }
                                                                                                                else
                                                                                                                {
                                                                                                                    $this->lines_model->F6F1d68DA8D25B3c1B8C9ABe62fAC2e5(($this->line->mac_address != NULL ? $this->line->mac_address : $this->line->username), uri_string(), _LINE_ERROR_INVALID_STALKER_KEY, $this->sid, $this->ip, $this->user_agent, $this->country, $this->isp, $this->line->log_errors, $this->line->id);
                                                                                                                    return true;
                                                                                                                }

                                                                                                            }
                                                                                                            else
                                                                                                            {
                                                                                                                return true;
                                                                                                            }

                                                                                                        }
                                                                                                        else
                                                                                                        {
                                                                                                            $this->lines_model->F6F1d68DA8D25B3C1B8c9ABe62FAc2e5(($this->line->mac_address != NULL ? $this->line->mac_address : $this->line->username), uri_string(), _LINE_ERROR_BOUQUET_DISALLOWED, $this->sid, $this->ip, $this->user_agent, $this->country, $this->isp, $this->line->log_errors, $this->line->id);
                                                                                                            return true;
                                                                                                        }

                                                                                                    }
                                                                                                    else
                                                                                                    {
                                                                                                        $this->lines_model->f6F1d68da8d25b3c1b8c9aBe62fAC2e5(($this->line->mac_address != NULL ? $this->line->mac_address : $this->line->username), uri_string(), _LINE_ERROR_ISP_DISALLOWED, $this->sid, $this->ip, $this->user_agent, $this->country, $this->isp, $this->line->log_errors, $this->line->id);
                                                                                                        return true;
                                                                                                    }

                                                                                                }
                                                                                                else
                                                                                                {
                                                                                                    $this->lines_model->F6f1D68DA8d25B3C1B8c9Abe62faC2E5(($this->line->mac_address != NULL ? $this->line->mac_address : $this->line->username), uri_string(), _LINE_ERROR_RTMP_DISALLOWED, $this->sid, $this->ip, $this->user_agent, $this->country, $this->isp, $this->line->log_errors, $this->line->id);
                                                                                                    return true;
                                                                                                }

                                                                                            }
                                                                                            else
                                                                                            {
                                                                                                $this->lines_model->F6F1D68DA8d25b3c1b8c9abe62fAC2E5(($this->line->mac_address != NULL ? $this->line->mac_address : $this->line->username), uri_string(), _LINE_ERROR_MPEGTS_DISALLOWED, $this->sid, $this->ip, $this->user_agent, $this->country, $this->isp, $this->line->log_errors, $this->line->id);
                                                                                                return true;
                                                                                            }

                                                                                        }
                                                                                        else
                                                                                        {
                                                                                            $this->lines_model->f6F1D68Da8D25b3c1b8C9AbE62fac2e5(($this->line->mac_address != NULL ? $this->line->mac_address : $this->line->username), uri_string(), _LINE_ERROR_HLS_DISALLOWED, $this->sid, $this->ip, $this->user_agent, $this->country, $this->isp, $this->line->log_errors, $this->line->id);
                                                                                            return true;
                                                                                        }

                                                                                    }
                                                                                    else
                                                                                    {
                                                                                        $this->lines_model->F6f1d68Da8D25B3C1b8c9abE62FAc2E5(($this->line->mac_address != NULL ? $this->line->mac_address : $this->line->username), uri_string(), _LINE_ERROR_TOR_NOT_ALLOWED, $this->sid, $this->ip, $this->user_agent, $this->country, $this->isp, $this->line->log_errors, $this->line->id);
                                                                                        return true;
                                                                                    }

                                                                                }
                                                                                else
                                                                                {
                                                                                    $this->lines_model->F6F1D68dA8d25B3c1b8c9ABE62fAc2E5(($this->line->mac_address != NULL ? $this->line->mac_address : $this->line->username), uri_string(), _LINE_ERROR_HOSTING_PROVIDER_NOT_ALLOWED, $this->sid, $this->ip, $this->user_agent, $this->country, $this->isp, $this->line->log_errors, $this->line->id);
                                                                                    return true;
                                                                                }

                                                                            }
                                                                            else
                                                                            {
                                                                                $this->lines_model->f6f1d68dA8D25b3c1b8c9aBe62FAC2E5(($this->line->mac_address != NULL ? $this->line->mac_address : $this->line->username), uri_string(), _LINE_ERROR_VPN_NOT_ALLOWED, $this->sid, $this->ip, $this->user_agent, $this->country, $this->isp, $this->line->log_errors, $this->line->id);
                                                                                return true;
                                                                            }

                                                                        }
                                                                        else
                                                                        {
                                                                            $this->lines_model->f6F1D68dA8D25b3c1b8C9AbE62FAc2e5(($this->line->mac_address != NULL ? $this->line->mac_address : $this->line->username), uri_string(), _LINE_ERROR_PROXY_NOT_ALLOWED, $this->sid, $this->ip, $this->user_agent, $this->country, $this->isp, $this->line->log_errors, $this->line->id);
                                                                            return true;
                                                                        }

                                                                    }
                                                                    else
                                                                    {
                                                                        $this->lines_model->f6F1d68DA8D25B3C1b8C9Abe62FaC2e5(($this->line->mac_address != NULL ? $this->line->mac_address : $this->line->username), uri_string(), _LINE_ERROR_IP_LOCKED, $this->sid, $this->ip, $this->user_agent, $this->country, $this->isp, $this->line->log_errors, $this->line->id);
                                                                        return true;
                                                                    }

                                                                }
                                                                else
                                                                {
                                                                    $this->lines_model->f6F1d68da8D25b3C1B8C9aBe62fac2e5(($this->line->mac_address != NULL ? $this->line->mac_address : $this->line->username), uri_string(), _LINE_ERROR_IP_LOCKED, $this->sid, $this->ip, $this->user_agent, $this->country, $this->isp, $this->line->log_errors, $this->line->id);
                                                                    return true;
                                                                }

                                                            }
                                                            else
                                                            {
                                                                $this->lines_model->f6F1d68da8d25b3C1b8C9AbE62FaC2e5(($this->line->mac_address != NULL ? $this->line->mac_address : $this->line->username), uri_string(), _LINE_ERROR_IP_LOCKED, $this->sid, $this->ip, $this->user_agent, $this->country, $this->isp, $this->line->log_errors, $this->line->id);
                                                                return true;
                                                            }

                                                        }
                                                        else
                                                        {
                                                            $this->lines_model->f6f1d68dA8d25B3C1b8C9ABE62Fac2E5(($this->line->mac_address != NULL ? $this->line->mac_address : $this->line->username), uri_string(), _LINE_ERROR_COUNTRY_LOCKED, $this->sid, $this->ip, $this->user_agent, $this->country, $this->isp, $this->line->log_errors, $this->line->id);
                                                            return true;
                                                        }

                                                    }
                                                    else
                                                    {
                                                        $this->lines_model->f6F1D68dA8d25B3c1b8C9ABe62fAc2e5(($this->line->mac_address != NULL ? $this->line->mac_address : $this->line->username), uri_string(), _LINE_ERROR_USER_AGENT_LOCKED, $this->sid, $this->ip, $this->user_agent, $this->country, $this->isp, $this->line->log_errors, $this->line->id);
                                                        return true;
                                                    }

                                                }
                                                else
                                                {
                                                    $this->lines_model->F6F1D68DA8d25b3C1b8C9ABE62FAc2e5(($this->line->mac_address != NULL ? $this->line->mac_address : $this->line->username), uri_string(), _LINE_ERROR_UA_DISALLOWED, $this->sid, $this->ip, $this->user_agent, $this->country, $this->isp, $this->line->log_errors, $this->line->id);
                                                    return true;
                                                }

                                            }
                                            else
                                            {
                                                $this->lines_model->F6f1D68dA8d25b3c1B8C9abE62FaC2e5(($this->line->mac_address != NULL ? $this->line->mac_address : $this->line->username), uri_string(), _LINE_ERROR_ISP_LOCKED, $this->sid, $this->ip, $this->user_agent, $this->country, $this->isp, $this->line->log_errors, $this->line->id);
                                                return true;
                                            }

                                        }
                                        else
                                        {
                                            $this->lines_model->f6f1D68dA8d25b3C1b8c9ABe62FAC2e5(($this->line->mac_address != NULL ? $this->line->mac_address : $this->line->username), uri_string(), _LINE_ERROR_HTTPS_CLIENT_TO_NON_HTTPS_PORT, $this->sid, $this->ip, $this->user_agent, $this->country, $this->isp, $this->line->log_errors, $this->line->id);
                                            return true;
                                        }

                                    }
                                    else
                                    {
                                        $this->lines_model->F6f1d68dA8D25B3c1b8C9ABe62fAC2E5(($this->line->mac_address != NULL ? $this->line->mac_address : $this->line->username), uri_string(), _LINE_ERROR_VPN_CLIENT_TO_NON_VPN_IP, $this->sid, $this->ip, $this->user_agent, $this->country, $this->isp, $this->line->log_errors, $this->line->id);
                                        return true;
                                    }

                                }
                                else
                                {
                                    $this->lines_model->f6F1D68DA8d25b3C1b8C9aBe62faC2E5(($this->line->mac_address != NULL ? $this->line->mac_address : $this->line->username), uri_string(), _LINE_ERROR_EXPIRED_DATE, $this->sid, $this->ip, $this->user_agent, $this->country, $this->isp, $this->line->log_errors, $this->line->id);
                                    $this->sid = ($this->line->line_expired_video_stream_id != NULL ? $this->line->line_expired_video_stream_id : $this->settings->line_expired_video_stream_id);
                                    if( $this->sid == NULL ) 
                                    {
                                    }
                                    else
                                    {
                                        $this->F05774e81A8d25eDde2840DC93c195A0();
                                    }

                                    return true;
                                }

                            }
                            else
                            {
                                $this->lines_model->F6f1d68DA8d25b3c1b8C9AbE62fac2e5(($this->line->mac_address != NULL ? $this->line->mac_address : $this->line->username), uri_string(), _LINE_ERROR_LINE_LOCKED, $this->sid, $this->ip, $this->user_agent, $this->country, $this->isp, $this->line->log_errors, $this->line->id);
                                $this->sid = ($this->line->line_banned_video_stream_id != NULL ? $this->line->line_banned_video_stream_id : $this->settings->line_banned_video_stream_id);
                                if( $this->sid == NULL ) 
                                {
                                }
                                else
                                {
                                    $this->f05774E81A8D25edde2840dC93C195A0();
                                }

                                return true;
                            }

                        }
                        else
                        {
                            $this->lines_model->f6F1d68dA8d25B3c1b8C9aBe62fAC2E5(($this->line->mac_address != NULL ? $this->line->mac_address : $this->line->username), uri_string(), _LINE_ERROR_LINE_DISABLED, $this->sid, $this->ip, $this->user_agent, $this->country, $this->isp, $this->line->log_errors, $this->line->id);
                            $this->sid = ($this->line->line_banned_video_stream_id != NULL ? $this->line->line_banned_video_stream_id : $this->settings->line_banned_video_stream_id);
                            if( $this->sid == NULL ) 
                            {
                            }
                            else
                            {
                                $this->F05774e81a8d25eDde2840Dc93C195a0();
                            }

                            return true;
                        }

                    }
                    else
                    {
                        return true;
                    }

                }
                else
                {
                    $this->lines_model->f6f1D68Da8d25b3C1B8c9ABE62FaC2E5(($this->line->mac_address != NULL ? $this->line->mac_address : $this->line->username), uri_string(), _LINE_ERROR_COUNTRY_DISALLOWED, $this->sid, $this->ip, $this->user_agent, $this->country, $this->isp, $this->line->log_errors, $this->line->id);
                    return true;
                }

            }
            else
            {
                $this->lines_model->F6f1d68dA8D25b3c1B8c9abE62fAC2E5(($this->line->mac_address != NULL ? $this->line->mac_address : $this->line->username), uri_string(), _LINE_ERROR_IP_DISALLOWED, $this->sid, $this->ip, $this->user_agent, $this->country, $this->isp, $this->line->log_errors, $this->line->id);
                return true;
            }

        }

        if( !(is_object($this->stream) && (!$this->preview || $this->preview && $this->stream->type != _STREAM_TYPE_VOD) && $this->a5b8Bd17f33d794A2BdC2C170abC0C42()) ) 
        {
        }
        else
        {
            $this->lines_model->F6F1D68da8d25b3C1b8c9aBe62Fac2E5(($this->line->mac_address != NULL ? $this->line->mac_address : $this->line->username), uri_string(), _LINE_ERROR_STREAM_DISABLED, $this->sid, $this->ip, $this->user_agent, $this->country, $this->isp, $this->line->log_errors, $this->line->id);
            $this->sid = ($this->line->no_stream_video_stream_id != NULL ? $this->line->no_stream_video_stream_id : $this->settings->no_stream_video_stream_id);
            if( $this->sid == NULL ) 
            {
            }
            else
            {
                $this->F05774E81A8D25eDde2840Dc93c195A0();
            }

            return true;
        }

    }

    public function fb4b61f859648726C9D7040b1a68D6eb()
    {
        if( !$this->preview ) 
        {
            if( $this->eA4Eea31909c76405Ea2bf33d5384C1B() ) 
            {
                if( !$this->f0Aa949b17DAEf48227B1CE065499D2e() ) 
                {
                }
                else
                {
                    $this->lines_model->e4d0C8fA12a6674adBD6fCB95D2eB5eF($this->hls_lines_log->id, ["kicked" => true]);
                    $this->lines_model->f6f1D68Da8D25b3C1b8c9aBe62FaC2E5(($this->line->mac_address != NULL ? $this->line->mac_address : $this->line->username), uri_string(), _LINE_ERROR_MAX_CONN_TIME_REACHED, $this->sid, $this->ip, $this->user_agent, $this->country, $this->isp, $this->line->log_errors, $this->line->id);
                    return true;
                }

            }
            else
            {
                return true;
            }

        }
        else
        {
            return false;
        }

    }

    public function F7bc53dD1620acE7e262d666b477871A()
    {
        if( $this->F4352a2908487eD198590D077d339e7C() ) 
        {
            if( !$this->D77cFb15Bc982740b03008702cD0AB4D() ) 
            {
                return false;
            }

            $this->lines_model->e4D0C8Fa12A6674ADbD6FCB95d2eB5EF($this->mpegts_lines_log_insert_id, ["kicked" => true]);
            $this->lines_model->f6F1d68dA8D25B3C1b8C9Abe62FAc2e5(($this->line->mac_address != NULL ? $this->line->mac_address : $this->line->username), uri_string(), _LINE_ERROR_MAX_CONN_TIME_REACHED, $this->sid, $this->ip, $this->user_agent, $this->country, $this->isp, $this->line->log_errors, $this->line->id);
            return true;
        }

        return true;
    }

    public function EA4eEA31909C76405Ea2BF33D5384c1B()
    {
        if( !($this->extension == "m3u8" && $this->hls_token != "") ) 
        {
            $bf45532484bd7dc938867a9d6b56502c = $this->line->pair_id;
            $F18da4b41674303f9b9a2670aae252c6 = $this->line->max_allowed_connections;
            if( $bf45532484bd7dc938867a9d6b56502c == NULL ) 
            {
            }
            else
            {
                $Baf66774bcf416adb3f6b46bff8488cd = $this->lines_model->F93D64835f58F173B81a3Aa098EdCA00($bf45532484bd7dc938867a9d6b56502c);
                $E20e8e952176f49c81570020ec57296d = $Baf66774bcf416adb3f6b46bff8488cd->max_allowed_connections;
            }

            if( $F18da4b41674303f9b9a2670aae252c6 && ($bf45532484bd7dc938867a9d6b56502c == NULL || $E20e8e952176f49c81570020ec57296d) ) 
            {
                $Baf1b0bfbd0d44f788663f83f6a6a41d = ($bf45532484bd7dc938867a9d6b56502c != NULL ? max($F18da4b41674303f9b9a2670aae252c6, $E20e8e952176f49c81570020ec57296d) : $F18da4b41674303f9b9a2670aae252c6);
                if( !$this->line->mag || $this->line->hide_records ) 
                {
                }
                else
                {
                    $Baf1b0bfbd0d44f788663f83f6a6a41d++;
                }

                $dce74bd8064bfaf808496e60977c6bb5 = $this->lines_model->B288c8029DA5C3Cc4Cde4f4Df8B481cC($this->line->id, $bf45532484bd7dc938867a9d6b56502c);
                if( !(($this->line->disallow_2nd_ip || $this->line->mag) && isset($dce74bd8064bfaf808496e60977c6bb5[0]["IP_address"]) && $this->ip != $dce74bd8064bfaf808496e60977c6bb5[0]["IP_address"]) ) 
                {
                    $bf3d0cc4ea9b8afc052a843587a2122f = count($dce74bd8064bfaf808496e60977c6bb5);
                    if( $Baf1b0bfbd0d44f788663f83f6a6a41d >= $bf3d0cc4ea9b8afc052a843587a2122f ) 
                    {
                    }
                    else
                    {
                        if( in_array($this->extension, ["rtmp", "m3u8"]) ) 
                        {
                        }
                        else
                        {
                            $this->lines_model->e4D0c8FA12A6674ADBD6Fcb95d2Eb5EF($dce74bd8064bfaf808496e60977c6bb5[0]["id"], ["disconnect" => 1]);
                            if( $dce74bd8064bfaf808496e60977c6bb5[0]["server_id"] == $this->server->id ) 
                            {
                                shell_exec("(sleep 2; kill -9 " . $dce74bd8064bfaf808496e60977c6bb5[0]["pid"] . ") >/dev/null 2>/dev/null &");
                            }
                            else
                            {
                                $this->lines_model->E23FD17f350EE11A30572D42813253b1($dce74bd8064bfaf808496e60977c6bb5[0]["pid"], $dce74bd8064bfaf808496e60977c6bb5[0]["server_id"], 0);
                            }

                        }

                        if( $this->extension != "m3u8" ) 
                        {
                        }
                        else
                        {
                            $this->lines_model->e4d0c8fA12a6674ADbD6Fcb95D2EB5ef($dce74bd8064bfaf808496e60977c6bb5[0]["id"], ["disconnect" => 1]);
                        }

                        if( $dce74bd8064bfaf808496e60977c6bb5[0]["rtmp_client_id"] == NULL ) 
                        {
                        }
                        else
                        {
                            $this->lines_model->e4D0c8fA12a6674ADBd6fCB95d2EB5Ef($dce74bd8064bfaf808496e60977c6bb5[0]["id"], ["disconnect" => 1]);
                            if( $dce74bd8064bfaf808496e60977c6bb5[0]["server_id"] == $this->server->id ) 
                            {
                                _set_rtmp_control("drop/client?clientid=" . $dce74bd8064bfaf808496e60977c6bb5[0]["rtmp_client_id"]);
                            }
                            else
                            {
                                $this->lines_model->e23fd17f350ee11A30572d42813253B1(0, $dce74bd8064bfaf808496e60977c6bb5[0]["server_id"], $dce74bd8064bfaf808496e60977c6bb5[0]["rtmp_client_id"]);
                            }

                        }

                    }

                    return true;
                }

                return false;
            }

            return true;
        }

        return true;
    }

    public function A5B8bD17F33d794a2bdC2C170AbC0C42()
    {
        if( !$this->stream->disabled ) 
        {
            return false;
        }

        return true;
    }

    public function e2E8860cC38776f486a58EaE99aF7C89()
    {
        if( !($this->line->admin_lock || $this->line->reseller_lock) ) 
        {
            return false;
        }

        return true;
    }

    public function a7859b30630Db629E9f2534f1A57fb84()
    {
        if( !$this->line->disabled ) 
        {
            return false;
        }

        return true;
    }

    public function DC678cdf057A5b6Bd2Aa34bF5c503d38()
    {
        if( !($this->line->mag && $this->extension == "m3u8" && $this->settings->mag_format == _CONNECTION_TYPE_HLS) ) 
        {
            if( $this->extension != "m3u8" || $this->line->hls ) 
            {
                return true;
            }

            return false;
        }

        return true;
    }

    public function a4edB93269C5b01544c71805C400fdD3()
    {
        if( !($this->line->mag && $this->extension == "ts" && $this->settings->mag_format == _CONNECTION_TYPE_MPEGTS) ) 
        {
            if( $this->extension != "ts" || $this->line->mpegts ) 
            {
                return true;
            }

            return false;
        }

        return true;
    }

    public function e046a4A3D007092B8242acA9F32ed205()
    {
        if( !($this->line->mag && $this->extension == "rtmp" && $this->settings->mag_format == _CONNECTION_TYPE_RTMP) ) 
        {
            if( $this->extension != "rtmp" || $this->line->rtmp ) 
            {
                return true;
            }

            return false;
        }

        return true;
    }

    public function _check_allowed_ips()
    {
        $d7fd75f763d2db1f7018eba8a80fb046 = $this->lines_model->F0CC59dC1a55975684d5bCA6C1C64807($this->line->allowed_ips);
        if( count($d7fd75f763d2db1f7018eba8a80fb046) != 0 ) 
        {
            if( !in_array($this->ip, $d7fd75f763d2db1f7018eba8a80fb046) ) 
            {
                return false;
            }

            $this->bypass_ip_check = true;
            return true;
        }

        return true;
    }

    public function ed7834De5d74C700caE867bC059ad467()
    {
        if( !($this->user_agent == "" && $this->settings->disallow_empty_agents) ) 
        {
            $d3682507a54f3dbad37abc009ecb45a3 = $this->lines_model->B35528d75DBF0B758B3fe966555d1930($this->line->allowed_user_agents);
            if( !in_array($this->user_agent, $d3682507a54f3dbad37abc009ecb45a3) ) 
            {
                $f680a24b577df35faf35e795dc8afa36 = json_decode($this->settings->blocked_uas);
                if( empty($f680a24b577df35faf35e795dc8afa36) ) 
                {
                }
                else
                {
                    foreach( $f680a24b577df35faf35e795dc8afa36 as $A6accd2b414d542e60391dcb309b09db => $a3b25ba5a2dbaaa205f5bf6c779428b7 ) 
                    {
                        if( $a3b25ba5a2dbaaa205f5bf6c779428b7 ) 
                        {
                            if( $this->user_agent != $A6accd2b414d542e60391dcb309b09db ) 
                            {
                            }
                            else
                            {
                                return false;
                            }

                        }
                        else
                        {
                            if(  ( stripos(strtolower($this->user_agent), strtolower($A6accd2b414d542e60391dcb309b09db)) === false )  ) 
                            {
                            }
                            else
                            {
                                return false;
                            }

                        }

                    }
                }

                if( count($d3682507a54f3dbad37abc009ecb45a3) != 0 ) 
                {
                    return false;
                }

                return true;
            }

            $this->bypass_ua_check = true;
            return true;
        }

        return false;
    }

    public function f87De0b2Ab174Ad52C80bD903468a1d2()
    {
        if( !isset($this->bypass_ip_check) ) 
        {
            $C5808cf0d11095b950e23832240d0f42 = json_decode($this->settings->blocked_isps);
            if( empty($C5808cf0d11095b950e23832240d0f42) ) 
            {
            }
            else
            {
                foreach( $C5808cf0d11095b950e23832240d0f42 as $A6accd2b414d542e60391dcb309b09db => $a3b25ba5a2dbaaa205f5bf6c779428b7 ) 
                {
                    if( $a3b25ba5a2dbaaa205f5bf6c779428b7 ) 
                    {
                        if( $this->isp != $A6accd2b414d542e60391dcb309b09db ) 
                        {
                        }
                        else
                        {
                            return false;
                        }

                    }
                    else
                    {
                        if(  ( stripos(strtolower($this->isp), strtolower($A6accd2b414d542e60391dcb309b09db)) === false )  ) 
                        {
                        }
                        else
                        {
                            return false;
                        }

                    }

                }
            }

            return true;
        }

        return true;
    }

    public function a88c3c3e14f47b3138Eec5C597A27690()
    {
        if( $this->line->expire_date != NULL ) 
        {
            if( $this->line->expire_date >= _time() ) 
            {
                return false;
            }

            return true;
        }

        return false;
    }

    public function B56f95c1589bF1BD64C8c4FaB38bC0f4()
    {
        if( is_object($this->stream) && !in_array($this->stream->type, [_STREAM_TYPE_VIDEO_ERROR_NO_VIDEO, _STREAM_TYPE_VIDEO_ERROR_BANNED, _STREAM_TYPE_VIDEO_ERROR_LINE_EXPIRED]) ) 
        {
            return $this->lines_model->E8B96Ac058f5f6F0c40094c2485AFab2($this->line->bouquets, $this->sid);
        }

        return true;
    }

    public function B42025Bb9A4B46D176D3F9023721E088()
    {
        if( $this->line->vpn && $this->server->vpn_ip != NULL ) 
        {
            if( $_SERVER["SERVER_ADDR"] != $this->server->vpn_ip ) 
            {
                return false;
            }

            return true;
        }

        return true;
    }

    public function E4819246DFF71b789c66773B37eeEfD9()
    {
        if( $this->line->https ) 
        {
            if( $_SERVER["SERVER_PORT"] == $this->server->https_port ) 
            {
                return true;
            }

            return false;
        }

        return true;
    }

    public function AF13f6BDce567DA4b92937CAb42aA724()
    {
        if( !($this->line->restreamer || isset($this->bypass_ip_check)) ) 
        {
            if( !$this->settings->disable_isp_lock ) 
            {
                if( $this->line->locked_isp == NULL ) 
                {
                }
                else
                {
                    if( $this->settings->isp_aliases != NULL ) 
                    {
                        $d487d40be9bd021cc327f37b1b26f8ed = json_decode($this->settings->isp_aliases, true);
                        foreach( $d487d40be9bd021cc327f37b1b26f8ed as $A6accd2b414d542e60391dcb309b09db => $a3b25ba5a2dbaaa205f5bf6c779428b7 ) 
                        {
                            $F5c67d6f09a3a11e027ebdaa1a05758c = json_decode($a3b25ba5a2dbaaa205f5bf6c779428b7, true);
                            array_push($F5c67d6f09a3a11e027ebdaa1a05758c, $A6accd2b414d542e60391dcb309b09db);
                            $F5c67d6f09a3a11e027ebdaa1a05758c = array_map("strtolower", $F5c67d6f09a3a11e027ebdaa1a05758c);
                            if( !(in_array(strtolower($this->isp), $F5c67d6f09a3a11e027ebdaa1a05758c) && in_array(strtolower($this->line->locked_isp), $F5c67d6f09a3a11e027ebdaa1a05758c)) ) 
                            {
                            }
                            else
                            {
                                return false;
                            }

                        }
                        return true;
                    }
                    else
                    {
                        if( $this->isp == $this->line->locked_isp ) 
                        {
                        }
                        else
                        {
                            return true;
                        }

                    }

                }

                return false;
            }

            return false;
        }

        return false;
    }

    public function a75d2322AA8F1D1047dBA005Ac44aC68()
    {
        if( !($this->line->restreamer || isset($this->bypass_ua_check)) ) 
        {
            if( !$this->settings->disable_user_agent_lock ) 
            {
                if( $this->line->locked_user_agent == NULL ) 
                {
                }
                else
                {
                    if( $this->user_agent == $this->line->locked_user_agent ) 
                    {
                    }
                    else
                    {
                        return true;
                    }

                }

                return false;
            }

            return false;
        }

        return false;
    }

    public function e4e3bf5385D3e39c3eFa1546b29cA359()
    {
        if( !($this->line->restreamer || isset($this->bypass_ip_check)) ) 
        {
            if( !$this->settings->disable_country_lock ) 
            {
                if( $this->line->locked_country == NULL ) 
                {
                }
                else
                {
                    if( $this->country == $this->line->locked_country ) 
                    {
                    }
                    else
                    {
                        return true;
                    }

                }

                return false;
            }

            return false;
        }

        return false;
    }

    public function E40dE64999fC9EA140d9a7B2e930175a()
    {
        if( !($this->line->restreamer || isset($this->bypass_ip_check)) ) 
        {
            if( !$this->settings->disable_ip_lock ) 
            {
                if( $this->line->locked_ip == NULL ) 
                {
                }
                else
                {
                    if( $this->ip == $this->line->locked_ip ) 
                    {
                    }
                    else
                    {
                        return true;
                    }

                }

                return false;
            }

            return false;
        }

        return false;
    }

    public function BDfb366C316AF89ee5fBd4cC35f6B810()
    {
        if( !($this->line->restreamer || isset($this->bypass_ip_check)) ) 
        {
            if( !($this->line->mag_ip_lock && $this->ip != $this->line->mag_ip_to_lock) ) 
            {
                return false;
            }

            return true;
        }

        return false;
    }

    public function bB7d1Cb8664a7b1f38A7e661B2dfb3ca()
    {
        if( !($this->line->restreamer || isset($this->bypass_ip_check)) ) 
        {
            if( !($this->line->e2_ip_lock && $this->ip != $this->line->e2_ip_to_lock) ) 
            {
                return false;
            }

            return true;
        }

        return false;
    }

    public function dFe68048b9c67727273A9c0233c3CabE()
    {
        if( !($this->line->restreamer || isset($this->bypass_ip_check)) ) 
        {
            if( !$this->settings->disallow_proxies || $this->line->allow_from_proxy ) 
            {
            }
            else
            {
                if( !(isset($this->anonymous["is_public_proxy"]) || isset($this->anonymous["is_residential_proxy"])) ) 
                {
                }
                else
                {
                    return true;
                }

            }

            return false;
        }

        return false;
    }

    public function aF06E423c832EFa5d9C2382d7B2C7aEF()
    {
        if( !($this->line->restreamer || isset($this->bypass_ip_check)) ) 
        {
            if( !$this->settings->disallow_vpns || $this->line->allow_from_proxy ) 
            {
            }
            else
            {
                if( !isset($this->anonymous["is_anonymous_vpn"]) ) 
                {
                }
                else
                {
                    return true;
                }

            }

            return false;
        }

        return false;
    }

    public function eD049463ba1a88ac31Ca62aa3448606E()
    {
        if( !($this->line->restreamer || isset($this->bypass_ip_check)) ) 
        {
            if( !$this->settings->disallow_hosting_providers || $this->line->allow_from_proxy ) 
            {
            }
            else
            {
                if( !isset($this->anonymous["is_hosting_provider"]) || isset($this->anonymous["is_anonymous_vpn"]) ) 
                {
                }
                else
                {
                    return true;
                }

            }

            return false;
        }

        return false;
    }

    public function DE9b1c23C07d3EF51342217EDF8BFB80()
    {
        if( !($this->line->restreamer || isset($this->bypass_ip_check)) ) 
        {
            if( !$this->settings->disallow_tor || $this->line->allow_from_proxy ) 
            {
            }
            else
            {
                if( !isset($this->anonymous["is_tor_exit_node"]) ) 
                {
                }
                else
                {
                    return true;
                }

            }

            return false;
        }

        return false;
    }

    public function a8f584AB5c6e77Df006D5a46b6Fe21e4()
    {
        if( !isset($this->bypass_ip_check) ) 
        {
            if( $this->line->override_country ) 
            {
                $f8c37e059a42cbed3f5e1a8c6f447296 = $this->lines_model->ead1704e077Ec95B73e522eE1FfFd970($this->line->allowed_countries);
            }
            else
            {
                $f8c37e059a42cbed3f5e1a8c6f447296 = $this->system_model->EAD1704E077EC95B73E522Ee1FfFd970($this->settings->allowed_countries);
            }

            if( !(!count($f8c37e059a42cbed3f5e1a8c6f447296) || $_SERVER[$this->settings->get_real_ip_client] == "127.0.0.1" || !filter_var($_SERVER[$this->settings->get_real_ip_client], FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE) || in_array($this->country, $f8c37e059a42cbed3f5e1a8c6f447296)) ) 
            {
                return false;
            }

            return true;
        }

        return true;
    }

    public function f4352a2908487Ed198590d077D339E7c()
    {
        if( !(connection_status() != CONNECTION_NORMAL || connection_aborted()) ) 
        {
            return true;
        }

        return false;
    }

    public function D77CfB15bc982740b03008702cd0Ab4d()
    {
        if( isset($this->mpegts_lines_log_insert_id) ) 
        {
            if( !$this->line->restreamer ) 
            {
                if( $this->settings->user_kick_hours ) 
                {
                    if( $this->settings->user_kick_hours * 3600 >= _time() - $this->conn_time ) 
                    {
                        return false;
                    }

                    return true;
                }

                return false;
            }

            return false;
        }

        return false;
    }

    public function F0aA949B17DAeF48227b1Ce065499D2E()
    {
        if( $this->hls_token != "" ) 
        {
            if( !$this->line->restreamer ) 
            {
                if( $this->settings->user_kick_hours ) 
                {
                    if( $this->extension != "m3u8" ) 
                    {
                    }
                    else
                    {
                        if( $this->hls_lines_log != NULL ) 
                        {
                            if( $this->settings->user_kick_hours * 3600 >= _time() - $this->hls_lines_log->connection_time ) 
                            {
                            }
                            else
                            {
                                return true;
                            }

                        }
                        else
                        {
                            return false;
                        }

                    }

                    return false;
                }

                return false;
            }

            return false;
        }

        return false;
    }

    public function dE766714F4181b0185E022d9ced6dd5d()
    {
        if( !($this->line->stalker && $this->extension == "m3u8") ) 
        {
            return true;
        }

        return false;
    }

    public function C4A0297ac9440c451BA0eA0084601D20()
    {
        if( !$this->line->stalker ) 
        {
        }
        else
        {
            $this->stalker_key = $this->lines_model->aac0775Fd2B6f424efDbbA8303deDDD1($this->stalker_key);
            $this->stalker_key = explode("=", $this->stalker_key);
            if( isset($this->stalker_key[3]) ) 
            {
                if( $this->stalker_key[1] == $this->ip ) 
                {
                    if( $this->stalker_key[2] == $this->sid ) 
                    {
                        $A353dc0c83e32302d1beda4d558f8a17 = $this->stalker_key[3];
                        if( $A353dc0c83e32302d1beda4d558f8a17 >= time() ) 
                        {
                        }
                        else
                        {
                            return false;
                        }

                    }
                    else
                    {
                        return false;
                    }

                }
                else
                {
                    return false;
                }

            }
            else
            {
                return false;
            }

        }

        return true;
    }

    public function A37a9A2409D6d7D21436D877bb2D9229($B58e890a3fa71452e92e1102ba72f7ee, $C487fcef8d2055b7be0923c71c90efca)
    {
        $B58e890a3fa71452e92e1102ba72f7ee = explode(PHP_EOL, $B58e890a3fa71452e92e1102ba72f7ee);
        $d5112ca5207a8e6c687e5151252a08a0 = "";
        $e4f4ac2cc03302722678bdd12ca989da = 0;
        foreach( $B58e890a3fa71452e92e1102ba72f7ee as $F13b5357c31f9fa331253b7964ffdef6 ) 
        {
            if( $e4f4ac2cc03302722678bdd12ca989da <= $C487fcef8d2055b7be0923c71c90efca ) 
            {
                $d5112ca5207a8e6c687e5151252a08a0 .= $F13b5357c31f9fa331253b7964ffdef6 . PHP_EOL;
                $e4f4ac2cc03302722678bdd12ca989da++;
            }
            else
            {
                return $d5112ca5207a8e6c687e5151252a08a0;
            }

        }
    }

    public function dA537B0A841CDCA0B8604c8Da608417a()
    {
        if( $this->stream->type == _STREAM_TYPE_LIVE ) 
        {
            $f59a8e6d51407fd3e6dea3f052f4edb3 = $this->streams_model->ba389B135aBF6A3a8e0347cff0153384($this->stream->urls);
        }
        else
        {
            if( $this->stream->type == _STREAM_TYPE_VOD ) 
            {
                $this->load->C7e2E88E4C7811bd3c499f37A2bc14BB("movies_model", "", true);
                $f59a8e6d51407fd3e6dea3f052f4edb3 = $this->movies_model->E9F283880d9816dD1661Ce2af6302455($this->stream->files);
            }

        }

        $f59a8e6d51407fd3e6dea3f052f4edb3 = $this->streams_model->c3fDE755F6FA44fbB2090B511AB8a7a1([$f59a8e6d51407fd3e6dea3f052f4edb3]);
        $f59a8e6d51407fd3e6dea3f052f4edb3 = array_shift($f59a8e6d51407fd3e6dea3f052f4edb3);
        $f59a8e6d51407fd3e6dea3f052f4edb3 = $f59a8e6d51407fd3e6dea3f052f4edb3["url"];
        if( !$this->stream->append_flussonic_token ) 
        {
        }
        else
        {
            $f59a8e6d51407fd3e6dea3f052f4edb3 .= ((parse_url($f59a8e6d51407fd3e6dea3f052f4edb3, PHP_URL_QUERY) ? "&" : "?")) . "token=" . $this->CD46E74588A545346924F435545b9668();
        }

        redirect(strtr($this->D9d459dEAA098136EC64AE64C7B66CF6($f59a8e6d51407fd3e6dea3f052f4edb3), ["{USER}" => $this->line->username, "{PASSWORD}" => $this->line->password, "{EXTENSION}" => $this->extension]));
        exit();
    }

    public function Fe706EE1C129a70f3fd2DFe4F1f3B771()
    {
        if( !$this->stream->radio ) 
        {
            header("Content-type: video/MP2T");
        }
        else
        {
            header("Content-type: audio/mpeg");
        }

        $e43e93b38841d8f9812557ca23b3bcde = $this->settings->proxy_buffer_timeout / 1000;
        clearstatcache();
        if( $this->streams_model->Ff2e241003628a61A7864955eB1Da13e($this->sid) == "" ) 
        {
            $this->streams_model->ad2803F5f243748ECD78DFE62BDf75C3($this->sid);
            $E04737a2a13be4a986d0367e2f1ce9bc = socket_create(AF_UNIX, SOCK_DGRAM, 0);
            $d2f775210ad7c4028a52dad1ef7c152c = $this->streams_dir . $this->sid . "_.sock";
            @unlink($d2f775210ad7c4028a52dad1ef7c152c);
            socket_bind($E04737a2a13be4a986d0367e2f1ce9bc, $d2f775210ad7c4028a52dad1ef7c152c);
            $d849695f38a4b150371bcbbfceadcb17 = count(json_decode($this->stream->urls)) * $this->settings->proxy_connect_timeout + 1;
            socket_set_option($E04737a2a13be4a986d0367e2f1ce9bc, SOL_SOCKET, SO_RCVTIMEO, ["sec" => $d849695f38a4b150371bcbbfceadcb17, "usec" => 0]);
            $F2b7bcee480c82650ee928e4b1b3173d = socket_recvfrom($E04737a2a13be4a986d0367e2f1ce9bc, $d26e8a9796d43733405fb489e78d02ff, 1, 0, $b4f7b7e72d0532fdfd8ba28d5a8dbc7f);
            if( !( ( $F2b7bcee480c82650ee928e4b1b3173d === false )  || $d26e8a9796d43733405fb489e78d02ff == 1) ) 
            {
                socket_close($E04737a2a13be4a986d0367e2f1ce9bc);
                @unlink($d2f775210ad7c4028a52dad1ef7c152c);
                $d839d1aa795e57216b1c1bd000a6cad7 = 0;
            }
            else
            {
                exit();
            }

        }
        else
        {
            $d839d1aa795e57216b1c1bd000a6cad7 = $this->d0adb666d23d4AcA687A6323a960f8E4($this->sid);
        }

        $b2c4e1a725fc19da28f20ccee922f4c0 = 0;
        $Acdd9634169b62d6e42845073f5f9733 = 0;
        $c3482f9ad18d87390913a2a6effe578d = 0;
        $d7100998f5c35e24a96e1a607c3fe0d9 = 0;
        $Fbd20a3a83e4516354d81e9ed23c1041 = NULL;
        $E5cfa84920ccd9503f61ed2a39b8b703 = 0;
        $b2d699f7c34e63f56f51978542e74adb = ceil(60 / ($this->settings->proxy_buffer_timeout / 1000));
        $fa9776325a83de94baf0956babbdadec = microtime(true);
        $this->connection_speed_file = _TMP_DIR . $this->mpegts_lines_log_insert_id . ".con";
        $this->signal_file = _TMP_DIR . $this->mpegts_lines_log_insert_id . ".sig";
        while( false ) 
        {
            if( $d7100998f5c35e24a96e1a607c3fe0d9 >= ($a252ae664a7f9060ea9ce51772180fa3 = floor($b2c4e1a725fc19da28f20ccee922f4c0 / 10)) ) 
            {
            }
            else
            {
                $d7100998f5c35e24a96e1a607c3fe0d9 = $a252ae664a7f9060ea9ce51772180fa3;
                if( !$this->f7bC53dD1620ACe7E262D666B477871a() ) 
                {
                    file_put_contents($this->connection_speed_file, $Fbd20a3a83e4516354d81e9ed23c1041);
                }

            }

            $B9c2e4bb1e887dfc8d5ea3f438aab3f5 = $this->streams_dir . $this->sid . "_" . $d839d1aa795e57216b1c1bd000a6cad7 . ".ts";
            if( !file_exists($B9c2e4bb1e887dfc8d5ea3f438aab3f5) ) 
            {
                $E5cfa84920ccd9503f61ed2a39b8b703++;
                if( $b2d699f7c34e63f56f51978542e74adb >= $E5cfa84920ccd9503f61ed2a39b8b703 ) 
                {
                }
                else
                {
                    exit();
                }

            }
            else
            {
                $E5cfa84920ccd9503f61ed2a39b8b703 = 0;
                if( 0 >= filesize($B9c2e4bb1e887dfc8d5ea3f438aab3f5) ) 
                {
                }
                else
                {
                    $b3e05bfcd09b880906fa5fa4b438bfac = microtime(true);
                    readfile($B9c2e4bb1e887dfc8d5ea3f438aab3f5);
                    $Fbd20a3a83e4516354d81e9ed23c1041 = microtime(true) - $b3e05bfcd09b880906fa5fa4b438bfac;
                }

                $d839d1aa795e57216b1c1bd000a6cad7++;
            }

            $Acdd9634169b62d6e42845073f5f9733++;
            $c59c918bd650300aeef76c9e20358511 = $Acdd9634169b62d6e42845073f5f9733 * $e43e93b38841d8f9812557ca23b3bcde;
            $b2c4e1a725fc19da28f20ccee922f4c0 = microtime(true) - $fa9776325a83de94baf0956babbdadec;
            if( $b2c4e1a725fc19da28f20ccee922f4c0 >= $c59c918bd650300aeef76c9e20358511 ) 
            {
            }
            else
            {
                usleep(($c59c918bd650300aeef76c9e20358511 - $b2c4e1a725fc19da28f20ccee922f4c0) * 1000000);
            }

            exit();
        }
    }

    public function d0ADb666d23d4acA687A6323a960F8E4($bfb7542761ba43798ebfbac279e1b9d6)
    {
        $fa856c8c24246bf1730f47003bfda8c6 = _TMP_DIR . $bfb7542761ba43798ebfbac279e1b9d6 . ".proxy";
        if( !file_exists($fa856c8c24246bf1730f47003bfda8c6) ) 
        {
            return 0;
        }

        $Fd833cca17ce707955da69b2938094d2 = file_get_contents($fa856c8c24246bf1730f47003bfda8c6);
        $D2ea5acb2ccd06e3579b9fff747855d0 = ceil($this->settings->proxy_prebuffer_seconds / ($this->settings->proxy_buffer_timeout / 1000));
        for( $Acdd9634169b62d6e42845073f5f9733 = 2; $Acdd9634169b62d6e42845073f5f9733 >= $D2ea5acb2ccd06e3579b9fff747855d0; $Acdd9634169b62d6e42845073f5f9733++ ) 
        {
            $fc3bc1168c2bd6fac9bb86c0daee786e = $this->streams_dir . $bfb7542761ba43798ebfbac279e1b9d6 . "_" . $Fd833cca17ce707955da69b2938094d2 . ".ts";
            if( !(file_exists($fc3bc1168c2bd6fac9bb86c0daee786e) && 0 < filesize($fc3bc1168c2bd6fac9bb86c0daee786e)) ) 
            {
            }
            else
            {
                readfile($fc3bc1168c2bd6fac9bb86c0daee786e);
            }

            $Fd833cca17ce707955da69b2938094d2++;
        }
        return $Fd833cca17ce707955da69b2938094d2;
    }

    public function c9bBB2EccF904B42a28afFED485cE56a($path)
    {
        $b3e05bfcd09b880906fa5fa4b438bfac = microtime(true);
        clearstatcache(true, $path);
        while( file_exists($path) ) 
        {
            clearstatcache(true, $path);
            if( 5 >= microtime(true) - $b3e05bfcd09b880906fa5fa4b438bfac ) 
            {
                usleep(300);
            }
            else
            {
                exit();
            }

        }
    }

    public function eaFEC9E8ff2bc0cD0A108E5b946508Bf()
    {
        if( !($this->stream->proxy && $this->stream->direct_streaming_on_demand) ) 
        {
        }
        else
        {
            if( $this->streams_model->b21184eaCC6aa889142Cff7035080E08($this->sid) ) 
            {
            }
            else
            {
                $this->streams_model->cCFAA47e7539dF586103D405cb9a3B61($this->sid);
            }

        }

    }

    public function E4a03c6e8eC8cF278BcD792949d6640c()
    {
        if( !$this->stream->radio ) 
        {
            header("Content-type: video/MP2T");
        }
        else
        {
            header("Content-type: audio/mpeg");
        }

        if( !$this->on_demand ) 
        {
        }
        else
        {
            if( $this->streams_model->A08128E00E3cC9C5a62B1dF26c9355D6($this->sid, $this->url_num, $this->adaptive_level) != "" ) 
            {
            }
            else
            {
                $e64aaf53e52de8cb88c0b3bc2360b7d5 = $this->streams_dir . $this->sid . "_" . $this->url_num . (($this->adaptive_level != 0 ? "_" . $this->adaptive_level : "")) . "_0.ts";
                $this->streams_model->ED38E472eBfE9C3e2462088B033CCF31($this->sid, 1, 0, 1, 0, 0, false);
                $this->c9bBB2eccf904b42a28aFfed485ce56a($e64aaf53e52de8cb88c0b3bc2360b7d5);
                $this->first_on_demand = true;
            }

        }

        if( isset($this->first_on_demand) ) 
        {
        }
        else
        {
            $B9311b821a4fd3facdbcdc7d2c50e211 = $this->streams_dir . $this->sid . "_" . $this->url_num . (($this->adaptive_level != 0 ? "_" . $this->adaptive_level : "")) . "_.m3u8";
            if( file_exists($B9311b821a4fd3facdbcdc7d2c50e211) ) 
            {
            }
            else
            {
                if( $this->preview ) 
                {
                }
                else
                {
                    $this->sid = ($this->line->no_stream_video_stream_id != NULL ? $this->line->no_stream_video_stream_id : $this->settings->no_stream_video_stream_id);
                    if( $this->sid == NULL ) 
                    {
                    }
                    else
                    {
                        $this->f05774e81a8D25eddE2840dc93C195a0();
                    }

                }

                return NULL;
            }

        }

        $b3c658519f363b50cfd5fba3b1faabef = -1;
        if( isset($this->first_on_demand) ) 
        {
        }
        else
        {
            $a3230008bedbfb727ad412708cfffe37 = file_get_contents($B9311b821a4fd3facdbcdc7d2c50e211);
            preg_match_all("/(.*?)\\_(.*?)\\_(.*?)" . (($this->adaptive_level ? "\\_(.*?)" : "")) . "\\.ts/", $a3230008bedbfb727ad412708cfffe37, $e998b8375112c49cac6e4912c0df7304);
            if( !is_array($e998b8375112c49cac6e4912c0df7304) ) 
            {
            }
            else
            {
                $b3c658519f363b50cfd5fba3b1faabef = ($this->adaptive_level == 0 ? end($e998b8375112c49cac6e4912c0df7304[3]) : end($e998b8375112c49cac6e4912c0df7304[4]));
            }

        }

        $this->connection_speed_file = _TMP_DIR . $this->mpegts_lines_log_insert_id . ".con";
        $this->signal_file = _TMP_DIR . $this->mpegts_lines_log_insert_id . ".sig";
        if( isset($this->first_on_demand) || !$this->preview && $this->line->restreamer && !$this->settings->prebuffer_restreamers ) 
        {
            $a2b49939e3ae81c9e822c8a7d77d769d = 0;
        }
        else
        {
            $a2b49939e3ae81c9e822c8a7d77d769d = ceil($this->settings->prebuffer_seconds / $this->stream->segment_time);
        }

        $Cd6648b3af921c28e9a073dabc934fb1 = 50;
        if( isset($this->first_on_demand) || $a2b49939e3ae81c9e822c8a7d77d769d > count($e998b8375112c49cac6e4912c0df7304[0]) ) 
        {
        }
        else
        {
            if( !$this->stream->delay ) 
            {
                $B4c7625a26743c03919862f4ec32004b = array_slice($e998b8375112c49cac6e4912c0df7304[0], -1 * $a2b49939e3ae81c9e822c8a7d77d769d, $a2b49939e3ae81c9e822c8a7d77d769d, true);
            }
            else
            {
                $B4c7625a26743c03919862f4ec32004b = array_slice($e998b8375112c49cac6e4912c0df7304[0], 0, $a2b49939e3ae81c9e822c8a7d77d769d, true);
            }

            $b3e05bfcd09b880906fa5fa4b438bfac = microtime(true);
            foreach( $B4c7625a26743c03919862f4ec32004b as $Fd833cca17ce707955da69b2938094d2 ) 
            {
                if( file_exists($this->streams_dir . $Fd833cca17ce707955da69b2938094d2) ) 
                {
                    readfile($this->streams_dir . $Fd833cca17ce707955da69b2938094d2);
                }
                else
                {
                    exit();
                }

            }
            if( !$a2b49939e3ae81c9e822c8a7d77d769d ) 
            {
            }
            else
            {
                $Fbd20a3a83e4516354d81e9ed23c1041 = (microtime(true) - $b3e05bfcd09b880906fa5fa4b438bfac) / $a2b49939e3ae81c9e822c8a7d77d769d;
                file_put_contents($this->connection_speed_file, $Fbd20a3a83e4516354d81e9ed23c1041);
            }

        }

        $this->stream_fail = false;
        $Bf465eb4185d2f7f6fde7ad0a0a113d8 = $b3c658519f363b50cfd5fba3b1faabef + 2;
        if( !$this->stream->delay ) 
        {
        }
        else
        {
            $b3c658519f363b50cfd5fba3b1faabef = ((($this->adaptive_level == 0 ? $e998b8375112c49cac6e4912c0df7304[3][0] : $e998b8375112c49cac6e4912c0df7304[4][0])) + $a2b49939e3ae81c9e822c8a7d77d769d) - 1;
        }

        while( false ) 
        {
            $b3e05bfcd09b880906fa5fa4b438bfac = microtime(true);
            $fc3bc1168c2bd6fac9bb86c0daee786e = $this->sid . "_" . $this->url_num . (($this->adaptive_level != 0 ? "_" . $this->adaptive_level : "")) . "_" . ($b3c658519f363b50cfd5fba3b1faabef + 1) . ".ts";
            $Be2f272b10aed8e68d8b9b4f944d1f4a = $this->sid . "_" . $this->url_num . (($this->adaptive_level != 0 ? "_" . $this->adaptive_level : "")) . "_" . $Bf465eb4185d2f7f6fde7ad0a0a113d8 . ".ts";
            for( $c0a198310d5d90c192c0f237dd2d1162 = 0; file_exists($this->streams_dir . $fc3bc1168c2bd6fac9bb86c0daee786e) || $c0a198310d5d90c192c0f237dd2d1162 > $Cd6648b3af921c28e9a073dabc934fb1 * 10; $c0a198310d5d90c192c0f237dd2d1162++ ) 
            {
                usleep(100000);
            }
            if( file_exists($this->streams_dir . $fc3bc1168c2bd6fac9bb86c0daee786e) ) 
            {
                if( !file_exists($this->signal_file) ) 
                {
                    $ebc1dca5e49cf7931f2a26bfe3f04710 = 0;
                    $eddb7933322e0184578f69f758bc8785 = 0;
                    $D737333b54210631e5e0cd55049923cf = time();
                    $e1bcb345eaa7fcfd93b6a15da8ce2ded = fopen($this->streams_dir . $fc3bc1168c2bd6fac9bb86c0daee786e, "r");
                    while( $ebc1dca5e49cf7931f2a26bfe3f04710 > $Cd6648b3af921c28e9a073dabc934fb1 || file_exists($this->streams_dir . $Be2f272b10aed8e68d8b9b4f944d1f4a) ) 
                    {
                        $db9b946eddd9105718e479c171f7097a = stream_get_line($e1bcb345eaa7fcfd93b6a15da8ce2ded, 8192);
                        if( !empty($db9b946eddd9105718e479c171f7097a) ) 
                        {
                            echo $db9b946eddd9105718e479c171f7097a;
                            $ebc1dca5e49cf7931f2a26bfe3f04710 = 0;
                        }
                        else
                        {
                            sleep(1);
                            $ebc1dca5e49cf7931f2a26bfe3f04710++;
                            $eddb7933322e0184578f69f758bc8785++;
                        }

                    }
                    if( !($ebc1dca5e49cf7931f2a26bfe3f04710 <= $Cd6648b3af921c28e9a073dabc934fb1 && file_exists($this->streams_dir . $fc3bc1168c2bd6fac9bb86c0daee786e) && is_resource($e1bcb345eaa7fcfd93b6a15da8ce2ded)) ) 
                    {
                    }
                    else
                    {
                        $b076963fb4594e276bdd6ef174838f89 = filesize($this->streams_dir . $fc3bc1168c2bd6fac9bb86c0daee786e);
                        $F13b5357c31f9fa331253b7964ffdef6 = $b076963fb4594e276bdd6ef174838f89 - ftell($e1bcb345eaa7fcfd93b6a15da8ce2ded);
                        if( 0 >= $F13b5357c31f9fa331253b7964ffdef6 ) 
                        {
                        }
                        else
                        {
                            echo stream_get_line($e1bcb345eaa7fcfd93b6a15da8ce2ded, $F13b5357c31f9fa331253b7964ffdef6);
                        }

                    }

                    fclose($e1bcb345eaa7fcfd93b6a15da8ce2ded);
                    $ebc1dca5e49cf7931f2a26bfe3f04710 = 0;
                    $b3c658519f363b50cfd5fba3b1faabef++;
                    $Bf465eb4185d2f7f6fde7ad0a0a113d8++;
                    $Fbd20a3a83e4516354d81e9ed23c1041 = microtime(true) - $b3e05bfcd09b880906fa5fa4b438bfac;
                    if( !$this->f7Bc53DD1620ACe7E262D666B477871a() ) 
                    {
                        file_put_contents($this->connection_speed_file, $Fbd20a3a83e4516354d81e9ed23c1041 - $eddb7933322e0184578f69f758bc8785);
                        $eddb7933322e0184578f69f758bc8785 = 0;
                        if( !($this->adaptive_levels_count || is_array($this->stream->adaptive_streams)) ) 
                        {
                        }
                        else
                        {
                            $this->dA96611a41489E58a2DFc37836307c9E($Fbd20a3a83e4516354d81e9ed23c1041);
                        }

                    }

                }
                else
                {
                    $db9b946eddd9105718e479c171f7097a = json_decode(file_get_contents($this->signal_file), true);
                    switch( $db9b946eddd9105718e479c171f7097a["type"] ) 
                    {
                        case "fingerprint":
                            $c0a198310d5d90c192c0f237dd2d1162 = 0;
                            while( file_exists($this->streams_dir . $Be2f272b10aed8e68d8b9b4f944d1f4a) || $c0a198310d5d90c192c0f237dd2d1162 > $Cd6648b3af921c28e9a073dabc934fb1 ) 
                            {
                                sleep(1);
                                $c0a198310d5d90c192c0f237dd2d1162++;
                            }
                            $this->Dbe1dC9b7E7602E8A961ccA08Ae24749($db9b946eddd9105718e479c171f7097a, $fc3bc1168c2bd6fac9bb86c0daee786e);
                            $b3c658519f363b50cfd5fba3b1faabef++;
                            break;
                        case "redirect":
                            $b3c658519f363b50cfd5fba3b1faabef = $this->A23918f9d4E71b1d6916B54F1Ee58859($db9b946eddd9105718e479c171f7097a["stream_id"], $a2b49939e3ae81c9e822c8a7d77d769d);
                            break;
                        default:
                            $db9b946eddd9105718e479c171f7097a = NULL;
                            unlink($this->signal_file);
                    }
                }

            }
            else
            {
                exit();
            }

        }
    }

    public function a4Eb049c9e93BA88A184dE9D8ce26Add()
    {
        if( -1 < $this->num_fragment ) 
        {
            header("Content-disposition: attachment; filename=" . $this->sid . "_" . $this->url_num . "_" . $this->num_fragment);
            header("Content-type: video/MP2T");
            if( !($this->adaptive_levels_count || is_array($this->stream->adaptive_streams)) ) 
            {
            }
            else
            {
                $this->dA96611A41489E58a2dfC37836307c9e($this->hls_lines_log->speed);
            }

            $B74d2e4e4966979da45b346549967216 = $this->streams_dir . $this->sid . "_" . $this->url_num . (($this->adaptive_level != 0 ? "_" . $this->adaptive_level : "")) . "_" . $this->num_fragment . ".ts";
            if( file_exists($B74d2e4e4966979da45b346549967216) ) 
            {
                if( $this->hls_lines_log == NULL ) 
                {
                }
                else
                {
                    $this->signal_file = _TMP_DIR . $this->hls_lines_log->id . ".sig";
                    if( !file_exists($this->signal_file) ) 
                    {
                    }
                    else
                    {
                        $db9b946eddd9105718e479c171f7097a = json_decode(file_get_contents($this->signal_file), true);
                        switch( $db9b946eddd9105718e479c171f7097a["type"] ) 
                        {
                            case "fingerprint":
                                $b3e05bfcd09b880906fa5fa4b438bfac = microtime(true);
                                $this->dbE1dC9b7e7602E8A961cCA08ae24749($db9b946eddd9105718e479c171f7097a, $this->sid . "_" . $this->url_num . (($this->adaptive_level != 0 ? "_" . $this->adaptive_level : "")) . "_" . $this->num_fragment . ".ts");
                                $Fbd20a3a83e4516354d81e9ed23c1041 = microtime(true) - $b3e05bfcd09b880906fa5fa4b438bfac;
                                break;
                            default:
                                unlink($this->signal_file);
                        }
                    }

                }

                if( isset($Fbd20a3a83e4516354d81e9ed23c1041) ) 
                {
                }
                else
                {
                    $Fbd20a3a83e4516354d81e9ed23c1041 = $this->A1B7191fA416A8C1Fd9a5B2F92017b6C($B74d2e4e4966979da45b346549967216);
                }

                if( $this->preview || $this->hls_lines_log == NULL ) 
                {
                }
                else
                {
                    $this->lines_model->e4d0C8fa12a6674aDBd6fcB95d2EB5EF($this->hls_lines_log->id, ["speed" => $Fbd20a3a83e4516354d81e9ed23c1041]);
                    $this->lines_model->fA95938efCA8C5686E5915f9B71851e1($this->line->id, $this->sid, $this->stream->segment_time);
                }

            }
            else
            {
                exit();
            }

        }
        else
        {
            if( $this->hls_token != "" ) 
            {
            }
            else
            {
                $afdcaab101de2b8db331d46c5bd2a3ad = urlencode(sha1($this->settings->api_key . $this->hls_lines_log->id) . ":" . $this->hls_lines_log->id);
                redirect("/hls_playlist/" . $this->username . "/" . $this->password . "/" . $afdcaab101de2b8db331d46c5bd2a3ad . "/" . $this->sid . ".m3u8");
            }

            header("Content-disposition: attachment; filename=" . $this->sid . "_.m3u8");
            header("Content-type: application/x-mpegURL");
            $B9311b821a4fd3facdbcdc7d2c50e211 = $this->streams_dir . $this->sid . "_" . $this->url_num . "_.m3u8";
            $e64aaf53e52de8cb88c0b3bc2360b7d5 = $this->streams_dir . $this->sid . "_" . $this->url_num . (($this->adaptive_level != 0 ? "_" . $this->adaptive_level : "")) . "_2.ts";
            if( !($this->on_demand && $this->streams_model->A08128E00e3CC9C5A62B1DF26c9355d6($this->sid, $this->url_num, $this->adaptive_level) == "") ) 
            {
            }
            else
            {
                $this->streams_model->eD38E472EBFE9C3e2462088B033ccF31($this->sid, 1, 0, 1);
                $this->C9bBb2EccF904b42a28AffEd485ce56a($e64aaf53e52de8cb88c0b3bc2360b7d5);
            }

            if( file_exists($B9311b821a4fd3facdbcdc7d2c50e211) ) 
            {
                $a3230008bedbfb727ad412708cfffe37 = file_get_contents($B9311b821a4fd3facdbcdc7d2c50e211);
                $a3230008bedbfb727ad412708cfffe37 = preg_replace("/(.*?)\\_(.*?)\\_(.*?)\\.ts/", "/hls/" . $this->username . "/" . $this->password . "/\$1/" . $this->url_num . "/" . urlencode($this->hls_token) . "/\$3.ts", $this->a37A9a2409d6D7d21436D877bB2D9229($a3230008bedbfb727ad412708cfffe37, 15));
                echo $a3230008bedbfb727ad412708cfffe37;
            }
            else
            {
                exit();
            }

        }

    }

    public function A38165A05941f06d13ce456E4fEE04F2()
    {
        if( in_array($this->stream->type, [_STREAM_TYPE_VOD, _STREAM_TYPE_VIDEO_ERROR_NO_VIDEO, _STREAM_TYPE_VIDEO_ERROR_BANNED, _STREAM_TYPE_VIDEO_ERROR_LINE_EXPIRED]) ) 
        {
            if( !$this->stream->proxy || $this->stream->server_id != $this->server->id ) 
            {
                $F0099c44a8adf1e4184f655b55c33b3d = _MOVIES_DIR . $this->sid . "_." . $this->extension;
            }
            else
            {
                $F0099c44a8adf1e4184f655b55c33b3d = $this->movies_model->e9F283880D9816Dd1661CE2aF6302455($this->stream->files);
            }

        }
        else
        {
            if( $this->stream->type == _STREAM_TYPE_POSTERS ) 
            {
                $F0099c44a8adf1e4184f655b55c33b3d = _UPLOADED_MOVIES_DIR . $this->stream->name . "." . $this->extension;
            }
            else
            {
                if( $this->stream->type == _STREAM_TYPE_ARCHIVE ) 
                {
                    if( $this->stream->tv_archive_dir != NULL ) 
                    {
                        $a26bba3a2d962c8b9bc2f26cf7706b38 = _add_trailing_slash($this->stream->tv_archive_dir);
                    }
                    else
                    {
                        $a26bba3a2d962c8b9bc2f26cf7706b38 = _ARCHIVE_DIR;
                    }

                    if( $this->xc_archive_duration == "" ) 
                    {
                        $F0099c44a8adf1e4184f655b55c33b3d = $a26bba3a2d962c8b9bc2f26cf7706b38 . $this->sid . "/" . date("Y-m-d_H:i:s", $this->archive_time) . "." . $this->extension;
                        if( file_exists($F0099c44a8adf1e4184f655b55c33b3d) ) 
                        {
                        }
                        else
                        {
                            $F0099c44a8adf1e4184f655b55c33b3d = $a26bba3a2d962c8b9bc2f26cf7706b38 . $this->sid . "/" . date("Y-m-d_H:i:s", $this->archive_time) . ".ts";
                        }

                    }
                    else
                    {
                        preg_match("/([0-9]+)-([0-9]+)-([0-9]+):([0-9]+)[-|:]([0-9]+)/", $this->archive_time, $e998b8375112c49cac6e4912c0df7304);
                        if( isset($e998b8375112c49cac6e4912c0df7304[5]) ) 
                        {
                            $ef9f2f872a955ba4cb4705bf0beeb69f = strtotime($e998b8375112c49cac6e4912c0df7304[1] . "-" . $e998b8375112c49cac6e4912c0df7304[2] . "-" . $e998b8375112c49cac6e4912c0df7304[3] . " " . $e998b8375112c49cac6e4912c0df7304[4] . ":" . $e998b8375112c49cac6e4912c0df7304[5]);
                            $F0099c44a8adf1e4184f655b55c33b3d = $a26bba3a2d962c8b9bc2f26cf7706b38 . $this->sid . "/" . date("Y-m-d_H:i:s", $ef9f2f872a955ba4cb4705bf0beeb69f + $this->xc_archive_duration * 60) . ".mkv";
                            if( file_exists($F0099c44a8adf1e4184f655b55c33b3d) ) 
                            {
                            }
                            else
                            {
                                $F0099c44a8adf1e4184f655b55c33b3d = $a26bba3a2d962c8b9bc2f26cf7706b38 . $this->sid . "/" . date("Y-m-d_H:i:s", $ef9f2f872a955ba4cb4705bf0beeb69f + $this->xc_archive_duration * 60) . ".ts";
                                if( file_exists($F0099c44a8adf1e4184f655b55c33b3d) ) 
                                {
                                }
                                else
                                {
                                    $F0099c44a8adf1e4184f655b55c33b3d = $a26bba3a2d962c8b9bc2f26cf7706b38 . $this->sid . "/" . date("Y-m-d_H:i:s", $ef9f2f872a955ba4cb4705bf0beeb69f + ($this->xc_archive_duration - 2) * 60) . ".mkv";
                                    if( file_exists($F0099c44a8adf1e4184f655b55c33b3d) ) 
                                    {
                                    }
                                    else
                                    {
                                        $F0099c44a8adf1e4184f655b55c33b3d = $a26bba3a2d962c8b9bc2f26cf7706b38 . $this->sid . "/" . date("Y-m-d_H:i:s", $ef9f2f872a955ba4cb4705bf0beeb69f + ($this->xc_archive_duration - 2) * 60) . ".ts";
                                    }

                                }

                            }

                        }
                        else
                        {
                            exit( "Incorrect archive URL format" );
                        }

                    }

                }

            }

        }

        if( !(file_exists($F0099c44a8adf1e4184f655b55c33b3d) && ($e1bcb345eaa7fcfd93b6a15da8ce2ded = fopen($F0099c44a8adf1e4184f655b55c33b3d, "rb")) !== false) ) 
        {
        }
        else
        {
            $b076963fb4594e276bdd6ef174838f89 = filesize($F0099c44a8adf1e4184f655b55c33b3d);
            $Ba7af1279841c0089999409b6eecf2c5 = $b076963fb4594e276bdd6ef174838f89;
            $Ddd835210710ee6a6380486217785259 = 0;
            $D10be4644fb623bc4f88a56fd411c449 = $b076963fb4594e276bdd6ef174838f89 - 1;
            if( -1 >= $this->settings->vod_limit_after_percent ) 
            {
            }
            else
            {
                $C4322743e33209199c1a55fdb21926ab = 0;
                if( in_array($this->stream->type, [_STREAM_TYPE_VOD]) ) 
                {
                    $b4fa83f5963d2d396fbdb9c467372983 = json_decode($this->streams_model->cAD47220f166f383b989F0c304aEA28b($this->sid, $this->stream->server_id));
                }
                else
                {
                    $b4fa83f5963d2d396fbdb9c467372983 = _ffprobe_by_movie_file_name($F0099c44a8adf1e4184f655b55c33b3d);
                }

                $D6f4d8c94b6cc20827c152018bbb7bd9 = _get_movie_duration($b4fa83f5963d2d396fbdb9c467372983);
                if( $D6f4d8c94b6cc20827c152018bbb7bd9 ) 
                {
                    $cb22b44f655744da0e79ddcad403c89a = ceil($b076963fb4594e276bdd6ef174838f89 / $this->settings->vod_buffer_size / $D6f4d8c94b6cc20827c152018bbb7bd9 / 10);
                    $cb22b44f655744da0e79ddcad403c89a += ceil($cb22b44f655744da0e79ddcad403c89a * $this->settings->vod_increase_download_speed_percent / 100);
                    $D12b9a487431a6a1600dca29c1518443 = ceil(($b076963fb4594e276bdd6ef174838f89 * $this->settings->vod_limit_after_percent / 100) / $this->settings->vod_buffer_size);
                }
                else
                {
                    exit();
                }

            }

            header("Content-type: " . mime_content_type($F0099c44a8adf1e4184f655b55c33b3d));
            header("Accept-Ranges: bytes");
            if( !isset($_SERVER["HTTP_RANGE"]) ) 
            {
            }
            else
            {
                $B79c6bfc7a96a861537cf51fa51e6324 = $Ddd835210710ee6a6380486217785259;
                $E8c1ca5d4c3a633c52494b7208ccfbfe = $D10be4644fb623bc4f88a56fd411c449;
                list($f3542dad9bc7be9af44d413158d623b0) = explode("=", $_SERVER["HTTP_RANGE"], 2);
                if(  ( strpos($f3542dad9bc7be9af44d413158d623b0, ",") === false )  ) 
                {
                    if( $f3542dad9bc7be9af44d413158d623b0 == "-" ) 
                    {
                        $B79c6bfc7a96a861537cf51fa51e6324 = $b076963fb4594e276bdd6ef174838f89 - substr($f3542dad9bc7be9af44d413158d623b0, 1);
                    }
                    else
                    {
                        $f3542dad9bc7be9af44d413158d623b0 = explode("-", $f3542dad9bc7be9af44d413158d623b0);
                        $B79c6bfc7a96a861537cf51fa51e6324 = $f3542dad9bc7be9af44d413158d623b0[0];
                        $E8c1ca5d4c3a633c52494b7208ccfbfe = (isset($f3542dad9bc7be9af44d413158d623b0[1]) && is_numeric($f3542dad9bc7be9af44d413158d623b0[1]) ? $f3542dad9bc7be9af44d413158d623b0[1] : $b076963fb4594e276bdd6ef174838f89);
                    }

                    $E8c1ca5d4c3a633c52494b7208ccfbfe = ($D10be4644fb623bc4f88a56fd411c449 < $E8c1ca5d4c3a633c52494b7208ccfbfe ? $D10be4644fb623bc4f88a56fd411c449 : $E8c1ca5d4c3a633c52494b7208ccfbfe);
                    if( !($E8c1ca5d4c3a633c52494b7208ccfbfe < $B79c6bfc7a96a861537cf51fa51e6324 || $b076963fb4594e276bdd6ef174838f89 - 1 < $B79c6bfc7a96a861537cf51fa51e6324 || $b076963fb4594e276bdd6ef174838f89 <= $E8c1ca5d4c3a633c52494b7208ccfbfe) ) 
                    {
                        $Ddd835210710ee6a6380486217785259 = $B79c6bfc7a96a861537cf51fa51e6324;
                        $D10be4644fb623bc4f88a56fd411c449 = $E8c1ca5d4c3a633c52494b7208ccfbfe;
                        $Ba7af1279841c0089999409b6eecf2c5 = $D10be4644fb623bc4f88a56fd411c449 - $Ddd835210710ee6a6380486217785259 + 1;
                        fseek($e1bcb345eaa7fcfd93b6a15da8ce2ded, $Ddd835210710ee6a6380486217785259);
                        header("HTTP/1.1 206 Partial Content");
                    }
                    else
                    {
                        header("HTTP/1.1 416 Requested Range Not Satisfiable");
                        header("Content-Range: bytes " . $Ddd835210710ee6a6380486217785259 . "-" . $D10be4644fb623bc4f88a56fd411c449 . "/" . $b076963fb4594e276bdd6ef174838f89);
                        exit();
                    }

                }
                else
                {
                    header("HTTP/1.1 416 Requested Range Not Satisfiable");
                    header("Content-Range: bytes " . $Ddd835210710ee6a6380486217785259 . "-" . $D10be4644fb623bc4f88a56fd411c449 . "/" . $b076963fb4594e276bdd6ef174838f89);
                    exit();
                }

            }

            header("Content-Range: bytes " . $Ddd835210710ee6a6380486217785259 . "-" . $D10be4644fb623bc4f88a56fd411c449 . "/" . $b076963fb4594e276bdd6ef174838f89);
            header("Content-Length: " . $Ba7af1279841c0089999409b6eecf2c5);
            $d26e8a9796d43733405fb489e78d02ff = $this->settings->vod_buffer_size;
            $D737333b54210631e5e0cd55049923cf = microtime(true);
            while( feof($e1bcb345eaa7fcfd93b6a15da8ce2ded) || ($C12f98f8755e67d699d291ac016c6c83 = ftell($e1bcb345eaa7fcfd93b6a15da8ce2ded)) > $D10be4644fb623bc4f88a56fd411c449 ) 
            {
                $c41bba1e2d187c91c2193aaa9decec97 = microtime(true);
                if( 10 >= $c41bba1e2d187c91c2193aaa9decec97 - $D737333b54210631e5e0cd55049923cf ) 
                {
                }
                else
                {
                    $D737333b54210631e5e0cd55049923cf = $c41bba1e2d187c91c2193aaa9decec97;
                    if( !$this->f7Bc53dD1620aCE7E262d666b477871a() ) 
                    {
                    }

                }

                if( $D10be4644fb623bc4f88a56fd411c449 >= $C12f98f8755e67d699d291ac016c6c83 + $d26e8a9796d43733405fb489e78d02ff ) 
                {
                }
                else
                {
                    $d26e8a9796d43733405fb489e78d02ff = $D10be4644fb623bc4f88a56fd411c449 - $C12f98f8755e67d699d291ac016c6c83 + 1;
                }

                echo fread($e1bcb345eaa7fcfd93b6a15da8ce2ded, $d26e8a9796d43733405fb489e78d02ff);
                if( -1 >= $this->settings->vod_limit_after_percent ) 
                {
                }
                else
                {
                    $C4322743e33209199c1a55fdb21926ab++;
                    if( !($C4322743e33209199c1a55fdb21926ab % $cb22b44f655744da0e79ddcad403c89a == 0 && $D12b9a487431a6a1600dca29c1518443 <= $C4322743e33209199c1a55fdb21926ab) ) 
                    {
                    }
                    else
                    {
                        usleep(100000);
                    }

                }

                fclose($e1bcb345eaa7fcfd93b6a15da8ce2ded);
            }
        }

        exit();
    }

    public function F05774E81A8d25edde2840dc93C195a0()
    {
        header("Content-type: video/MP2T");
        if( file_exists(_MOVIES_DIR . $this->sid . "_.m3u8") ) 
        {
            $a3230008bedbfb727ad412708cfffe37 = file_get_contents(_MOVIES_DIR . $this->sid . "_.m3u8");
            $b931a957ff0525ac0f00f0a14ce759db = preg_match_all("/\\#EXTINF:(.*?)\\,(.*?)\\_(.*?)\\.ts/s", $a3230008bedbfb727ad412708cfffe37, $e998b8375112c49cac6e4912c0df7304);
            if( $this->line->restreamer && !$this->settings->prebuffer_restreamers ) 
            {
                $a2b49939e3ae81c9e822c8a7d77d769d = 0;
            }
            else
            {
                $a2b49939e3ae81c9e822c8a7d77d769d = $this->settings->prebuffer_seconds / 10;
            }

            $Acdd9634169b62d6e42845073f5f9733 = 0;
            $Bd8c09770e7af4631f3e4cb9ccf38c13 = 0;
            while( $Bd8c09770e7af4631f3e4cb9ccf38c13 >= $a2b49939e3ae81c9e822c8a7d77d769d ) 
            {
                $B74d2e4e4966979da45b346549967216 = _MOVIES_DIR . $this->sid . "_" . $Acdd9634169b62d6e42845073f5f9733 . ".ts";
                if( file_exists($B74d2e4e4966979da45b346549967216) ) 
                {
                    readfile($B74d2e4e4966979da45b346549967216);
                    $Acdd9634169b62d6e42845073f5f9733++;
                    if( $Acdd9634169b62d6e42845073f5f9733 != $b931a957ff0525ac0f00f0a14ce759db ) 
                    {
                    }
                    else
                    {
                        $Acdd9634169b62d6e42845073f5f9733 = 0;
                    }

                    $Bd8c09770e7af4631f3e4cb9ccf38c13++;
                }
                else
                {
                    exit();
                }

            }
            $d839d1aa795e57216b1c1bd000a6cad7 = $Acdd9634169b62d6e42845073f5f9733;
            $Acdd9634169b62d6e42845073f5f9733 = 0;
            $fa9776325a83de94baf0956babbdadec = microtime(true);
            while( false ) 
            {
                if( !$this->F7bc53dD1620ace7e262d666B477871a() ) 
                {
                    $B74d2e4e4966979da45b346549967216 = _MOVIES_DIR . $this->sid . "_" . $d839d1aa795e57216b1c1bd000a6cad7 . ".ts";
                    if( file_exists($B74d2e4e4966979da45b346549967216) ) 
                    {
                        $this->A1B7191fa416A8c1fD9A5b2f92017b6c($B74d2e4e4966979da45b346549967216);
                        $d839d1aa795e57216b1c1bd000a6cad7++;
                        if( $d839d1aa795e57216b1c1bd000a6cad7 != $b931a957ff0525ac0f00f0a14ce759db ) 
                        {
                        }
                        else
                        {
                            $d839d1aa795e57216b1c1bd000a6cad7 = 0;
                        }

                        $Acdd9634169b62d6e42845073f5f9733++;
                        $c59c918bd650300aeef76c9e20358511 = $Acdd9634169b62d6e42845073f5f9733 * 10;
                        $b2c4e1a725fc19da28f20ccee922f4c0 = microtime(true) - $fa9776325a83de94baf0956babbdadec;
                        if( $b2c4e1a725fc19da28f20ccee922f4c0 >= $c59c918bd650300aeef76c9e20358511 ) 
                        {
                        }
                        else
                        {
                            usleep(($c59c918bd650300aeef76c9e20358511 - $b2c4e1a725fc19da28f20ccee922f4c0) * 1000000);
                        }

                    }
                    else
                    {
                        exit();
                    }

                }

            }
        }
        else
        {
            exit();
        }

    }

    public function dBe1Dc9b7E7602e8A961CcA08AE24749($db9b946eddd9105718e479c171f7097a, $fc3bc1168c2bd6fac9bb86c0daee786e)
    {
        passthru(_BIN_DIR . "ffmpeg -y -fflags +igndts -copyts -vsync 0 -nostats -nostdin -hide_banner -i " . $this->streams_dir . $fc3bc1168c2bd6fac9bb86c0daee786e . " -filter_complex drawtext=\"fontfile=" . _ROOT_DIR . "fonts/FreeSans.ttf:text='" . $db9b946eddd9105718e479c171f7097a["text"] . "':fontsize=" . $db9b946eddd9105718e479c171f7097a["font_size"] . ":x=" . $db9b946eddd9105718e479c171f7097a["x"] . ":y=" . $db9b946eddd9105718e479c171f7097a["y"] . ":fontcolor=" . $db9b946eddd9105718e479c171f7097a["font_color"] . "\" -map 0 -vcodec " . $db9b946eddd9105718e479c171f7097a["video_codec"] . " -preset ultrafast -acodec copy -scodec copy -mpegts_copyts 1 -f mpegts -");
        return true;
    }

    public function a23918f9d4E71b1D6916b54f1ee58859($F2cae3a5a9a17bedb78a57b97c786e56, $a2b49939e3ae81c9e822c8a7d77d769d)
    {
        $this->sid = $F2cae3a5a9a17bedb78a57b97c786e56;
        $B9311b821a4fd3facdbcdc7d2c50e211 = $this->streams_dir . $this->sid . "_" . $this->url_num . (($this->adaptive_level != 0 ? "_" . $this->adaptive_level : "")) . "_.m3u8";
        if( file_exists($B9311b821a4fd3facdbcdc7d2c50e211) ) 
        {
            $a3230008bedbfb727ad412708cfffe37 = file_get_contents($B9311b821a4fd3facdbcdc7d2c50e211);
            $d839d1aa795e57216b1c1bd000a6cad7 = -1;
            if( !preg_match_all("/(.*?)\\_(.*?)\\_(.*?)" . (($this->adaptive_level ? "\\_(.*?)" : "")) . "\\.ts/", $a3230008bedbfb727ad412708cfffe37, $e998b8375112c49cac6e4912c0df7304) ) 
            {
            }
            else
            {
                $d839d1aa795e57216b1c1bd000a6cad7 = (($this->adaptive_level == 0 ? end($e998b8375112c49cac6e4912c0df7304[3]) : end($e998b8375112c49cac6e4912c0df7304[4]))) - $a2b49939e3ae81c9e822c8a7d77d769d;
            }

            return $d839d1aa795e57216b1c1bd000a6cad7;
        }

        return -1;
    }

    public function Da96611A41489e58a2Dfc37836307c9E($Fbd20a3a83e4516354d81e9ed23c1041)
    {
        if( !$this->adaptive_streaming_locked ) 
        {
            $e43e93b38841d8f9812557ca23b3bcde = $this->stream->segment_time;
            if( $e43e93b38841d8f9812557ca23b3bcde - $this->settings->adaptive_streaming_min_quality / 100 * $e43e93b38841d8f9812557ca23b3bcde < $Fbd20a3a83e4516354d81e9ed23c1041 ) 
            {
                if( $this->adaptive_levels_count ) 
                {
                    if( $this->adaptive_level >= $this->adaptive_levels_count - 1 ) 
                    {
                    }
                    else
                    {
                        $this->adaptive_level++;
                    }

                }
                else
                {
                    if( !isset($this->stream->adaptive_streams[$this->current_adaptive_stream + 1]) ) 
                    {
                    }
                    else
                    {
                        $this->current_adaptive_stream++;
                        $this->sid = $this->stream->adaptive_streams[$this->current_adaptive_stream];
                    }

                }

            }
            else
            {
                if( $Fbd20a3a83e4516354d81e9ed23c1041 < $e43e93b38841d8f9812557ca23b3bcde - $this->settings->adaptive_streaming_max_quality / 100 * $e43e93b38841d8f9812557ca23b3bcde ) 
                {
                    if( $this->adaptive_levels_count ) 
                    {
                        if( 0 >= $this->adaptive_level ) 
                        {
                        }
                        else
                        {
                            $this->adaptive_level--;
                        }

                    }
                    else
                    {
                        if( isset($this->stream->adaptive_streams[$this->current_adaptive_stream - 1]) ) 
                        {
                            $this->current_adaptive_stream--;
                            $this->sid = $this->stream->adaptive_streams[$this->current_adaptive_stream];
                        }
                        else
                        {
                            if( $this->sid == $this->original_sid ) 
                            {
                            }
                            else
                            {
                                $this->sid = $this->original_sid;
                                $this->current_adaptive_stream = -1;
                            }

                        }

                    }

                }

            }

        }

    }

    public function DB83a01752506656C6F8E4FA39693eC6()
    {
        if( !in_array($this->stream->type, [_STREAM_TYPE_POSTERS, _STREAM_TYPE_VIDEO_ERROR_NO_VIDEO, _STREAM_TYPE_VIDEO_ERROR_BANNED, _STREAM_TYPE_VIDEO_ERROR_LINE_EXPIRED]) ) 
        {
            $c15958650df9a0d4d1270d26e228d882 = json_decode($this->stream->servers, true);
            if( !in_array($this->stream->type, [_STREAM_TYPE_LIVE, _STREAM_TYPE_CHANNELS]) ) 
            {
            }
            else
            {
                $c15958650df9a0d4d1270d26e228d882 = array_keys($c15958650df9a0d4d1270d26e228d882);
            }

            if( count($c15958650df9a0d4d1270d26e228d882) != 1 ) 
            {
                return $this->servers_model->ff3514F17bc2Ed6c4CDae6A4805383C1($c15958650df9a0d4d1270d26e228d882, $this->settings->clients_servers_distribution, $this->country, $this->isp);
            }

            return $c15958650df9a0d4d1270d26e228d882[0];
        }

        return $this->stream->server_id;
    }

    public function a1B7191fa416A8c1Fd9a5b2F92017B6C($B74d2e4e4966979da45b346549967216)
    {
        if( file_exists($B74d2e4e4966979da45b346549967216) ) 
        {
            $b3e05bfcd09b880906fa5fa4b438bfac = microtime(true);
            @readfile($B74d2e4e4966979da45b346549967216);
            $Fbd20a3a83e4516354d81e9ed23c1041 = microtime(true) - $b3e05bfcd09b880906fa5fa4b438bfac;
            return $Fbd20a3a83e4516354d81e9ed23c1041;
        }

        return 0;
    }

    public function c54B3c82541912F15409d00C9569e10e()
    {
        if( !($this->stream->stream_backup_simultaneus && $this->server_config->server_id == $this->stream_server_id) ) 
        {
        }
        else
        {
            $cb09066a5ec2eb4f26f3e827570d96ad = 0;
            foreach( json_decode($this->stream->urls) as $f59a8e6d51407fd3e6dea3f052f4edb3 ) 
            {
                $cb09066a5ec2eb4f26f3e827570d96ad++;
                $B9311b821a4fd3facdbcdc7d2c50e211 = $this->streams_dir . $this->sid . "_" . $cb09066a5ec2eb4f26f3e827570d96ad . (($this->adaptive_level != 0 ? "_" . $this->adaptive_level : "")) . "_.m3u8";
                if( !file_exists($B9311b821a4fd3facdbcdc7d2c50e211) ) 
                {
                }
                else
                {
                    $a3230008bedbfb727ad412708cfffe37 = file_get_contents($B9311b821a4fd3facdbcdc7d2c50e211);
                    if( !preg_match_all("/(.*?)\\_(.*?)\\_(.*?)\\.ts/", $a3230008bedbfb727ad412708cfffe37, $e998b8375112c49cac6e4912c0df7304) ) 
                    {
                    }
                    else
                    {
                        if( !(file_exists($this->streams_dir . end($e998b8375112c49cac6e4912c0df7304[0])) && time() - filemtime($this->streams_dir . end($e998b8375112c49cac6e4912c0df7304[0])) <= $this->stream->segment_time) ) 
                        {
                        }
                        else
                        {
                            return $cb09066a5ec2eb4f26f3e827570d96ad;
                        }

                    }

                }

            }
        }

        return 1;
    }

    public function d238A62cE2ad03Bcf0454BF530fa7f02($Fb7196873ebb46cf492d0a11a7797bd4, $d839d1aa795e57216b1c1bd000a6cad7)
    {
        if( $this->stream_fail ) 
        {
        }
        else
        {
            $d839d1aa795e57216b1c1bd000a6cad7 -= 2;
        }

        if( !$this->mandatory_url_num ) 
        {
            $cb09066a5ec2eb4f26f3e827570d96ad = 0;
            $e807c9793ffd20c6d8f379a108758316 = json_decode($this->stream->urls);
            if( $this->stream->stream_backup_simultaneus || 1 >= count($e807c9793ffd20c6d8f379a108758316) ) 
            {
                foreach( $e807c9793ffd20c6d8f379a108758316 as $f59a8e6d51407fd3e6dea3f052f4edb3 ) 
                {
                    $cb09066a5ec2eb4f26f3e827570d96ad++;
                    if( $this->stream_fail || 1 >= count($e807c9793ffd20c6d8f379a108758316) ) 
                    {
                    }
                    else
                    {
                        if( $cb09066a5ec2eb4f26f3e827570d96ad != $this->url_num ) 
                        {
                        }
                        else
                        {
                            if( $Fb7196873ebb46cf492d0a11a7797bd4 ) 
                            {
                                return $d839d1aa795e57216b1c1bd000a6cad7;
                            }

                        }

                    }

                    $B9311b821a4fd3facdbcdc7d2c50e211 = $this->streams_dir . $this->sid . "_" . $cb09066a5ec2eb4f26f3e827570d96ad . (($this->adaptive_level != 0 ? "_" . $this->adaptive_level : "")) . "_.m3u8";
                    if( !file_exists($B9311b821a4fd3facdbcdc7d2c50e211) ) 
                    {
                    }
                    else
                    {
                        $a3230008bedbfb727ad412708cfffe37 = file_get_contents($B9311b821a4fd3facdbcdc7d2c50e211);
                        if( !preg_match_all("/(.*?)\\_(.*?)\\_(.*?)" . (($this->adaptive_level ? "\\_(.*?)" : "")) . "\\.ts/", $a3230008bedbfb727ad412708cfffe37, $e998b8375112c49cac6e4912c0df7304) ) 
                        {
                        }
                        else
                        {
                            if( !(file_exists($this->streams_dir . end($e998b8375112c49cac6e4912c0df7304[0])) && time() - filemtime($this->streams_dir . end($e998b8375112c49cac6e4912c0df7304[0])) <= $this->stream->segment_time) ) 
                            {
                            }
                            else
                            {
                                $this->url_num = $cb09066a5ec2eb4f26f3e827570d96ad;
                                $this->stream_fail = false;
                                return ($this->adaptive_level == 0 ? end($e998b8375112c49cac6e4912c0df7304[3]) : end($e998b8375112c49cac6e4912c0df7304[4]));
                            }

                        }

                    }

                }
                $this->stream_fail = true;
                return $d839d1aa795e57216b1c1bd000a6cad7;
            }
            else
            {
                return 0;
            }

        }
        else
        {
            $B9311b821a4fd3facdbcdc7d2c50e211 = $this->streams_dir . $this->sid . "_" . $this->url_num . (($this->adaptive_level != 0 ? "_" . $this->adaptive_level : "")) . "_.m3u8";
            if( !file_exists($B9311b821a4fd3facdbcdc7d2c50e211) ) 
            {
            }
            else
            {
                $a3230008bedbfb727ad412708cfffe37 = file_get_contents($B9311b821a4fd3facdbcdc7d2c50e211);
                if( !preg_match_all("/(.*?)\\_(.*?)\\_(.*?)" . (($this->adaptive_level ? "\\_(.*?)" : "")) . "\\.ts/", $a3230008bedbfb727ad412708cfffe37, $e998b8375112c49cac6e4912c0df7304) ) 
                {
                }
                else
                {
                    if( !(file_exists($this->streams_dir . end($e998b8375112c49cac6e4912c0df7304[0])) && time() - filemtime($this->streams_dir . end($e998b8375112c49cac6e4912c0df7304[0])) <= $this->stream->segment_time) ) 
                    {
                    }
                    else
                    {
                        $this->stream_fail = false;
                        return ($this->adaptive_level == 0 ? end($e998b8375112c49cac6e4912c0df7304[3]) : end($e998b8375112c49cac6e4912c0df7304[4]));
                    }

                }

            }

            $this->stream_fail = true;
            return $d839d1aa795e57216b1c1bd000a6cad7;
        }

    }

    public function bc9eed73390DbfcD77fd114498Ad7545()
    {
        $F9d6fd53c7f64257e899b94f8f35b5f9 = $this->system_model->f57cdBA994B90BE58fcfC07d794bDed2($this->country, $this->isp);
        if( count($F9d6fd53c7f64257e899b94f8f35b5f9) != 0 ) 
        {
            $cace12eef2b5ec3aa13e4b66c8a64136 = array_sum(array_column($F9d6fd53c7f64257e899b94f8f35b5f9, "weight"));
            $E446a07e4f5ae50fff5b24a72a5110dc = rand(0, $cace12eef2b5ec3aa13e4b66c8a64136);
            $Dc40ce28c5f672a032b62681a33879cd = 0;
            $B9a2545f133104cc4ef556a64fbe4159 = -1;
            foreach( $F9d6fd53c7f64257e899b94f8f35b5f9 as $F16733b14b8c0c30286756ef7a9eda9f ) 
            {
                $Dc40ce28c5f672a032b62681a33879cd = $B9a2545f133104cc4ef556a64fbe4159 + 1;
                $B9a2545f133104cc4ef556a64fbe4159 = $Dc40ce28c5f672a032b62681a33879cd + $F16733b14b8c0c30286756ef7a9eda9f["weight"];
                if( !($E446a07e4f5ae50fff5b24a72a5110dc <= $B9a2545f133104cc4ef556a64fbe4159 && $Dc40ce28c5f672a032b62681a33879cd < $E446a07e4f5ae50fff5b24a72a5110dc) ) 
                {
                }
                else
                {
                    redirect(rtrim($F16733b14b8c0c30286756ef7a9eda9f["host"], "/") . $_SERVER["REQUEST_URI"]);
                }

            }
        }

    }

    public function d9D459Deaa098136Ec64AE64C7B66cf6($f59a8e6d51407fd3e6dea3f052f4edb3)
    {
        $F69f401afe7a64ebaf8025b4c0d5f3b8 = $this->system_model->B0C24072Bf7B50e910C002fac08fda63($this->country, $this->isp);
        if( $F69f401afe7a64ebaf8025b4c0d5f3b8 != NULL ) 
        {
            return str_replace($F69f401afe7a64ebaf8025b4c0d5f3b8->old_url, $F69f401afe7a64ebaf8025b4c0d5f3b8->new_url, $f59a8e6d51407fd3e6dea3f052f4edb3);
        }

        return $f59a8e6d51407fd3e6dea3f052f4edb3;
    }

    public function Ab68E9C70B841b1696c9478C1eC684D6()
    {
        if( !(isset($this->connection_speed_file) && file_exists($this->connection_speed_file)) ) 
        {
        }
        else
        {
            unlink($this->connection_speed_file);
        }

    }

    public function Cd46E74588A545346924f435545B9668()
    {
        $a31176b111e9b160c353dda2a6be8b0c = ($this->extension == "m3u8" ? $this->hls_lines_log->id : $this->mpegts_lines_log_insert_id);
        $afdcaab101de2b8db331d46c5bd2a3ad = sha1($this->settings->api_key . $a31176b111e9b160c353dda2a6be8b0c) . ":" . $a31176b111e9b160c353dda2a6be8b0c;
        return $afdcaab101de2b8db331d46c5bd2a3ad;
    }

    public function Ae1F80257ea5D13B7382F7A425f839a8()
    {
        $Db151558825f38b3793a66c3a5e04779 = urldecode($this->hls_token);
        $b2920fd009b8dd77441e375d17037b64 = explode(":", $Db151558825f38b3793a66c3a5e04779);
        if( isset($b2920fd009b8dd77441e375d17037b64[1]) ) 
        {
            $c16cc201e8bb771f5de5e1c79255d796 = sha1($this->settings->api_key . $b2920fd009b8dd77441e375d17037b64[1]) . ":" . $b2920fd009b8dd77441e375d17037b64[1];
            if( $Db151558825f38b3793a66c3a5e04779 == $c16cc201e8bb771f5de5e1c79255d796 ) 
            {
                $c883d9210da257983308aaf91bfbe4d9 = $this->logs_model->AC781C1CD56b6688927593940a30eFE6($b2920fd009b8dd77441e375d17037b64[1]);
                if( isset($c883d9210da257983308aaf91bfbe4d9) ) 
                {
                    if( !$c883d9210da257983308aaf91bfbe4d9->disconnect ) 
                    {
                        if( $c883d9210da257983308aaf91bfbe4d9->IP_address == $this->ip ) 
                        {
                            if( $c883d9210da257983308aaf91bfbe4d9->user_agent == $this->user_agent ) 
                            {
                                if( $c883d9210da257983308aaf91bfbe4d9->lid == $this->line->id ) 
                                {
                                    if( $c883d9210da257983308aaf91bfbe4d9->sid == $this->sid ) 
                                    {
                                        return $c883d9210da257983308aaf91bfbe4d9;
                                    }

                                    exit();
                                }

                                exit();
                            }

                            exit();
                        }

                        exit();
                    }

                    exit();
                }

                exit();
            }

            exit( "Invalid HLS Token" );
        }

        exit( "Invalid HLS Token" );
    }

    public function play($C5b3d43234e8d53313c4effe1a45d551, $c6cef649c5ccc2e49628212e385609d9)
    {
        $C5b3d43234e8d53313c4effe1a45d551 = json_decode(_decrypt(rawurldecode(str_replace("_", "%2F", $C5b3d43234e8d53313c4effe1a45d551))));
        if( is_object($C5b3d43234e8d53313c4effe1a45d551) ) 
        {
        }
        else
        {
            show_404();
        }

        if( !isset($C5b3d43234e8d53313c4effe1a45d551->token) ) 
        {
        }
        else
        {
            $this->token = $C5b3d43234e8d53313c4effe1a45d551->token;
        }

        $this->index($C5b3d43234e8d53313c4effe1a45d551->username, $C5b3d43234e8d53313c4effe1a45d551->password, $C5b3d43234e8d53313c4effe1a45d551->id, $c6cef649c5ccc2e49628212e385609d9, -1, "", (isset($C5b3d43234e8d53313c4effe1a45d551->archive_time) ? $C5b3d43234e8d53313c4effe1a45d551->archive_time : -1), -1, (isset($C5b3d43234e8d53313c4effe1a45d551->url_num) ? $C5b3d43234e8d53313c4effe1a45d551->url_num : -1), (isset($C5b3d43234e8d53313c4effe1a45d551->rtmp_ip_address) ? $C5b3d43234e8d53313c4effe1a45d551->rtmp_ip_address : ""), (isset($C5b3d43234e8d53313c4effe1a45d551->rtmp_client_id) ? $C5b3d43234e8d53313c4effe1a45d551->rtmp_client_id : ""), (isset($C5b3d43234e8d53313c4effe1a45d551->adaptive_level) ? $C5b3d43234e8d53313c4effe1a45d551->adaptive_level : 0), (isset($C5b3d43234e8d53313c4effe1a45d551->xc_archive_duration) ? $C5b3d43234e8d53313c4effe1a45d551->xc_archive_duration : ""));
    }

    public function _shutdown_stream()
    {
        $this->lines_model->E73224D2B366DdaD3dB121ab90E77244($this->mpegts_lines_log_insert_id);
        $this->EafEc9E8ff2bC0cd0a108e5B946508bf();
        $this->aB68e9C70b841B1696C9478C1EC684D6();
        if( $this->preview ) 
        {
        }
        else
        {
            $this->lines_model->aA50888CA8F7703845332f7af70B1caF($this->line->id, $this->ip, $this->user_agent, $this->country, $this->isp, $this->sid);
            $this->lines_model->fA95938efCA8C5686E5915F9b71851e1($this->line->id, $this->sid, $this->conn_time);
        }

    }

    public function B48C167CB1d38801Ba07f55f6b52F639()
    {
        if( in_array($this->stream->type, [_STREAM_TYPE_VOD, _STREAM_TYPE_ARCHIVE]) && isset($_SERVER["HTTP_RANGE"]) && $_SERVER["HTTP_RANGE"] == "bytes=0-" || !in_array($this->stream->type, [_STREAM_TYPE_VOD, _STREAM_TYPE_ARCHIVE]) ) 
        {
            return false;
        }

        return true;
    }

}

}
else
{
    exit( "No direct script access allowed" );
}


