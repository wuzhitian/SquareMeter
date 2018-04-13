<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: AutoTestService.php
 * Create: 2018/4/2
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\PLATFORM\SERVICES\AutoTestService;

use UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\ENUM\_Micro_Service;
use UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\MODEL\Service;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\SinglePatternTrait;

/**
 * 自动化测试平台服务
 * Class AutoTestService
 * @package SMPlatform\PLATFORM\SERVICES\AutoTestService
 */
class AutoTestService extends Service
{
    use SinglePatternTrait; //加载为单例

    const SERVICE_MODE = _Micro_Service::HTTP_API_SERVICE; //声明为api服务
}