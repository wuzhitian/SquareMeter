<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: HttpApiServerConfig.php
 * Create: 2018/3/15
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\SERVER\CONFIG;

/**
 * http(s)api服务器配置类
 * Class HttpApiServerConfig
 * @package UmbServer\SwooleFramework\COMPONENT\SERVER\CONFIG
 */
class HttpApiServerConfig extends ServerConfig
{
    public $is_ssl        = false;
    public $is_http2      = false;
    public $ssl_cert_file;
    public $ssl_key_file;
}