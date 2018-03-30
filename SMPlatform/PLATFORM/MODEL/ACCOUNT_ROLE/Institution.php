<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: Institution.php
 * Create: 2018/3/8
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\PLATFORM\MODEL\ACCOUNT_ROLE;

use SMPlatform\PLATFORM\MODEL\BASE\User;
use SMPlatform\PLATFORM\MODEL\ENUM\_User;

/**
 * 机构用户类
 * Class Institution
 * @package SMPlatform\PLATFORM\MODEL\ACCOUNT_ROLE
 */
class Institution extends User
{
    public $type = _User::COMPANY; //机构用户类型默认为公司
}