<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: SMBCAccountManager.php
 * Create: 2018/4/11
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMBCMiddletier\SERVICES\SMBCAccountManager;

use EOSS\COMPONENT\CORE\BCAccountManager\BCAccountManager;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\SinglePatternTrait;

/**
 * SMBC链上账户管理器类
 * Class SMBCAccountManager
 * @package SMBCMiddletier\SERVICES\SMBCAccountManager
 */
class SMBCAccountManager extends BCAccountManager
{
    use SinglePatternTrait; //加载单例模式
}