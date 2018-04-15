<?php declare( strict_types = 1 );
/**
 * Project: SMBCMiddletier
 * File: SMBCBusinessHostDispatcher.php
 * Create: 2018/4/15
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMBCMiddletier\SERVICE\SMBCBusinessHostDispatcher;

use EOSS\COMPONENT\CORE\BCBusinessHostDispatcher\BCBusinessHostDispatcher;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\SinglePatternTrait;

/**
 * SMBC业务主机分发器
 * Class SMBCBusinessHostDispatcher
 * @package SMBCMiddletier\SERVICE\SMBCBusinessHostDispatcher
 */
class SMBCBusinessHostDispatcher extends BCBusinessHostDispatcher
{
    use SinglePatternTrait; //加载单例模式
}