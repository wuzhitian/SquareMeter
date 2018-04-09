<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: SystemLogController.php
 * Create: 2018/3/30
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\CORE_SERVICES\LogCenter\api\v1;

use UmbServer\SwooleFramework\LIBRARY\HTTP\CONTROLLER\AuthController;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\InstanceControllerTrait;

/**
 * SystemLog控制器
 * Class SystemLogController
 * @package UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\CORE_SERVICES\LogCenter\api\v1
 */
class SystemLogController extends AuthController
{
    const AUTH_MODE       = 1;
    const AUTH_USER_CLASS = 2;
    
    use InstanceControllerTrait; //加载实例控制器功能
}