<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: Authorizer.php
 * Create: 2018/4/9
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\CORE_SERVICES\Authorizer;

use UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\MODEL\Service;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\SinglePatternTrait;

/**
 * 授权服务类
 * Class Authorizer
 * @package UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\CORE_SERVICES\Authorizer
 */
class Authorizer extends Service
{
    use SinglePatternTrait; //加载单例模式
}