<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: User.php
 * Create: 2018/4/8
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\PLATFORM\MODEL\DATA;

use UmbServer\SwooleFramework\LIBRARY\INSTANCE\Instance;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\InstanceTrait;

/**
 * 平台用户类
 * Class User
 * @package SMPlatform\PLATFORM\MODEL\DATA
 */
class User extends Instance
{
    use InstanceTrait;
    
    const TABLE_NAME = 'PlatformUser'; //表名
    
    public $type; //personal | company
    public $smbc_account_id; //关联的smbc账户id，用以访问区块链
    public $cellphone; //手机号
    public $privilege_group_id; //权限组id
    public $user_identity_id; //user认证id
}