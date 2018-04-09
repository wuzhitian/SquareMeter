<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: Logger.php
 * Create: 2018/3/30
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\CORE_SERVICES\Logger;

use UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\MODEL\Service;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\SinglePatternTrait;

/**
 * 日志中心类
 * Class Logger
 * @package UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\CORE_SERVICES\Logger
 */
class Logger extends Service
{
    use SinglePatternTrait; //加载单例模式
}