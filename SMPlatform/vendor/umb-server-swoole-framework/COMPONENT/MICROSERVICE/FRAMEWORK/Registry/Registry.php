<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: Registry.php
 * Create: 2018/3/12
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\FRAMEWORK\Registry;

use UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\SERVICE\BASE\MicroService;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\SinglePatternTrait;

/**
 * 微服务注册中心类
 * Class Registry
 * @package UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\FRAMEWORK\Registry;
 */
class Registry extends MicroService
{
    use SinglePatternTrait; //加载单例模式
}