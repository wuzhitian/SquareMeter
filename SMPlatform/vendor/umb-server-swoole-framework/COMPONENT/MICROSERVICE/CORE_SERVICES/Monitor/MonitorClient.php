<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: MonitorClient.php
 * Create: 2018/3/30
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\CORE_SERVICES\Monitor;

use UmbServer\SwooleFramework\COMPONENT\CLIENT\TCPClient;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\SinglePatternTrait;

/**
 * 监视器客户端
 * Class MonitorClient
 * @package UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\CORE_SERVICES\Monitor
 */
class MonitorClient extends TCPClient
{
    use SinglePatternTrait; //加载单例模式
}