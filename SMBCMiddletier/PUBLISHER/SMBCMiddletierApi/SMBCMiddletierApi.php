<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: SMBCMiddletierApi.php
 * Create: 2018/4/12
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMBCMiddletier\PUBLISHER\SMBCMiddletierApi;

use UmbServer\SwooleFramework\COMPONENT\MICRO_SERVICE\BASE\MicroServicePublisher;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\SinglePatternTrait;

/**
 * SMBC中间件Api发布器
 * Class SMBCMiddletierApi
 * @package SMBCMiddletier\PUBLISHER\SMBCMiddletierApi
 */
class SMBCMiddletierApi extends MicroServicePublisher
{
    use SinglePatternTrait; //加载单例模式
}