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

    const TABLE_NAME = 'User'; //表名

    const SCHEMA
        = [
            'type'                  => STRING_TYPE,
            'smbc_account_id'       => STRING_TYPE,
            'cellphone'             => STRING_TYPE,
            'privilege_group_id'    => STRING_TYPE,
            'user_identity_id'      => STRING_TYPE,
            'token_wallet_id_array' => ARRAY_TYPE,
        ];

    public $type; //personal | company
    public $smbc_account_id; //关联的smbc账户id，用以访问区块链
    public $cellphone; //手机号
    public $privilege_group_id; //权限组id
    public $user_identity_id; //user认证id
    public $token_wallet_id_array; //平方米钱包id数组

    /**
     * 初始化User
     */
    public
    function initial()
    {
        $this->initialTokenWallet();
    }

    /**
     * 初始化用户钱包
     */
    private
    function initialTokenWallet()
    {

    }

}