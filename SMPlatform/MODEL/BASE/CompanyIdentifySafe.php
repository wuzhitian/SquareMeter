<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: CompanyIdentifySafe.php
 * Create: 2018/3/17
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\MODEL\BASE;

use UmbServer\SwooleFramework\LIBRARY\CORE\INSTANCE\SafeInstance;

/**
 * 企业实名认证
 * Class CompanyIdentifySafe
 * @package SMPlatform\MODEL\BASE
 */
class CompanyIdentifySafe extends SafeInstance implements UserIdentify
{

}