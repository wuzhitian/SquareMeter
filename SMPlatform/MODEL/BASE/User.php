<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: User.php
 * Create: 2018/3/8
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\MODEL\BASE;

use UmbServer\SwooleFramework\LIBRARY\INSTANCE\Instance;


/**
 * 用户基类
 * Class User
 * @package SMPlatform\MODEL\BASE
 */
class User extends Instance
{
    public $id; //用户id
    public $type; //用户类型
    public $role_array = []; //用户角色
}