<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: SMBCMiddletierApi.php
 * Create: 2018/4/12
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMBCMiddletier\PUBLISH\API\SMBCMiddletierApi;

use UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\SERVICE\BASE\MicroServicePublisher;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\SinglePatternTrait;

/**
 * SMBC中间件Api发布器
 * Class SMBCMiddletierApi
 * @package SMBCMiddletier\PUBLISH\API\SMBCMiddletierApi
 */
class SMBCMiddletierApi extends MicroServicePublisher
{
    use SinglePatternTrait; //加载单例模式
}