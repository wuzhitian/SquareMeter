<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: Investor.php
 * Create: 2018/3/15
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\PLATFORM\MODEL;

use SMPlatform\PLATFORM\MODEL\BASE\User;
use SMPlatform\PLATFORM\MODEL\ENUM\_User;

/**
 * 投资者用户类
 * Class Investor
 * @package SMPlatform\PLATFORM\MODEL
 */
class Investor extends User
{
    public $type = _User::PERSON; //投资者用户类型默认为个人
}