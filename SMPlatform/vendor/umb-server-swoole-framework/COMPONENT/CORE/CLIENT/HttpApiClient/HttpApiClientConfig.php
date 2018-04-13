<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: HttpApiClientConfig.php
 * Create: 2018/4/12
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\CORE\CLIENT\HttpApiClient;

use UmbServer\SwooleFramework\COMPONENT\CORE\CLIENT\BASE\ClientConfig;

/**
 * http(s) api client配置
 * Class HttpApiClientConfig
 * @package UmbServer\SwooleFramework\COMPONENT\CORE\CLIENT\HttpApiClient
 */
class HttpApiClientConfig extends ClientConfig
{
    public $host; //host
    public $port; //port
    public $is_ssl = false; //是否https
    public $timeout = 30; //请求超时时长
    public $keep_alive = true; //是否开启长连接
}