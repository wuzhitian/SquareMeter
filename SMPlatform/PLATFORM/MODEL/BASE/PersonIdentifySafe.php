<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: PersonIdentifySafe.php
 * Create: 2018/3/17
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\PLATFORM\MODEL\BASE;

use UmbServer\SwooleFramework\LIBRARY\INSTANCE\SafeInstance;

/**
 * 个人实名认证
 * Class PersonIdentifySafe
 * @package SMPlatform\PLATFORM\MODEL\BASE
 */
class PersonIdentifySafe extends SafeInstance implements UserIdentify
{

}