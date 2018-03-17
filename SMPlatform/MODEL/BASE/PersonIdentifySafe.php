<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: PersonIdentifySafe.php
 * Create: 2018/3/17
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\MODEL\BASE;

use UmbServer\SwooleFramework\LIBRARY\CORE\INSTANCE\SafeInstance;

/**
 * 个人实名认证
 * Class PersonIdentifySafe
 * @package SMPlatform\MODEL\BASE
 */
class PersonIdentifySafe extends SafeInstance implements UserIdentify
{

}