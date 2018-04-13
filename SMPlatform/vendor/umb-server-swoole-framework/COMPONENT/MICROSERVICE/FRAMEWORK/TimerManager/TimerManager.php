<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: TimerManager.php
 * Create: 2018/3/30
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\FRAMEWORK\TimerManager;

use UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\SERVICE\BASE\MicroService;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\SinglePatternTrait;

/**
 * 定时器服务中心
 * Class TimerManager
 * @package UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\FRAMEWORK\TimerManager
 */
class TimerManager extends MicroService
{
    use SinglePatternTrait; //加载单例模式
}