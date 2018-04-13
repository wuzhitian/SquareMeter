<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: Monitor.php
 * Create: 2018/3/30
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\FRAMEWORK\Monitor;

use UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\SERVICE\BASE\MicroService;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\SinglePatternTrait;

/**
 * 监视器
 * Class Monitor
 * @package UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\FRAMEWORK\Monitor
 */
class Monitor extends MicroService
{
    use SinglePatternTrait; //加载单例模式
}