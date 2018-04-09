<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: Dispatcher.php
 * Create: 2018/3/12
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\CORE_SERVICES\Dispatcher;

use UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\MODEL\Service;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\SinglePatternTrait;

/**
 * 服务分发类
 * Class Dispatcher
 * @package UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\CORE_SERVICES\Dispatcher
 */
class Dispatcher extends Service
{
    use SinglePatternTrait; //加载单例模式
}