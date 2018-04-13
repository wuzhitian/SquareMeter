<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: HttpServerConfig.php
 * Create: 2018/3/15
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\CORE\SERVER\CONFIG;

use UmbServer\SwooleFramework\COMPONENT\CORE\SERVER\BASE\ServerConfig;
use UmbServer\SwooleFramework\COMPONENT\CORE\SERVER\ENUM\_Server;

/**
 * http(s)api服务器配置类
 * Class HttpServerConfig
 * @package UmbServer\SwooleFramework\COMPONENT\CORE\SERVER\CONFIG
 */
class HttpApiServerConfig extends ServerConfig
{
    public $type = _Server::HTTP_API_SERVER; //server类型
    public $is_ssl = false; //是否https
    public $is_http2 = false; //是否http2
    public $ssl_cert_file = NULL; //cert文件地址
    public $ssl_key_file = NULL; //key文件地址
    public $controller_namespace = NULL; //控制器命名空间
}