<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: HttpClientConfig.php
 * Create: 2018/3/26
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\CORE\CLIENT\CONFIG;

/**
 * http(s)客户端配置类
 * Class HttpClientConfig
 * @package UmbServer\SwooleFramework\COMPONENT\CORE\CLIENT\CONFIG
 */
class HttpClientConfig extends ClientConfig
{
    public $host; //用户host
    public $listen_port; //监听端口
    public $is_ssl     = false; //是否https
    public $is_http2   = false; //是否http2
    public $timeout    = 5; //超时
    public $keep_alive = true; //是否长连接
}