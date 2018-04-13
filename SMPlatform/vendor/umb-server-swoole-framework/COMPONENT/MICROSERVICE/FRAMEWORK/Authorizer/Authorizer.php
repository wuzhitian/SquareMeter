<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: Authorizer.php
 * Create: 2018/4/9
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\FRAMEWORK\Authorizer;

use UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\SERVICE\BASE\MicroService;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\SinglePatternTrait;

/**
 * 授权服务类
 * Class Authorizer
 * @package UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\FRAMEWORK\Authorizer
 */
class Authorizer extends MicroService
{
    use SinglePatternTrait; //加载单例模式
}