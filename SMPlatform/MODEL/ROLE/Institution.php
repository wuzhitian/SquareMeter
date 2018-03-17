<?php
/**
 * Project: SMPlatform
 * File: Institution.php
 * Create: 2018/3/8
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\MODEL;

use SMPlatform\MODEL\BASE\User;
use SMPlatform\MODEL\ENUM\_User;

/**
 * 机构用户类
 * Class Institution
 * @package SMPlatform\MODEL\BASE
 */
class Institution extends User
{
    public $type = _User::COMPANY; //机构用户类型默认为公司
}