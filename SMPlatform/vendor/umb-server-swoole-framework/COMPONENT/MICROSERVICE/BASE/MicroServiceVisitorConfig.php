<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: MicroServiceVisitorConfig.php
 * Create: 2018/4/12
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\SERVICE\BASE;

use UmbServer\SwooleFramework\LIBRARY\COMMON_MODEL\Config;

/**
 * 微服务访问器配置类
 * Class MicroServiceVisitorConfig
 * @package UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\SERVICE\BASE
 */
class MicroServiceVisitorConfig extends Config
{
    public $host; //主机访问字符串
    public $port; //端口号
    public $is_ssl = false; //是否https
    public $timeout = 30; //请求超时时长
    public $keep_alive = true; //是否开启长连接
}