<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: _User.php
 * create: 2018/3/17
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\PLATFORM\MODEL\ENUM;

/**
 * 用户类型枚举类
 * Class _User
 * @package SMPlatform\PLATFORM\MODEL\ENUM
 */
class _User extends \SplEnum
{
    const PERSON  = 'person';
    const COMPANY = 'company';
}