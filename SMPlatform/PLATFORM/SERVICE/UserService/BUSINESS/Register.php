<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: AccountOperator.php
 * Create: 2018/3/30
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\PLATFORM\SERVICES\AccountService\BUSINESS;

use SMPlatform\PLATFORM\MODEL\DATA\User;
use SMPlatform\PLATFORM\MODEL\DATA\UserTokenWallet;
use SMPlatform\PLATFORM\MODEL\ENUM\_User;

/**
 * 注册业务类
 * Class Register
 * @package SMPlatform\PLATFORM\SERVICES\AccountService\BUSINESS
 */
abstract
class Register
{
    /**
     * 注册个人用户
     * @param string $cellphone
     * @param string $validate_code
     * @param string $pay_password
     */
    public
    function registerPersonalUser( string $cellphone, string $validate_code, string $pay_password )
    {
        //检查验证码
        ThirtPartyVisitor:
        //申请链上SMBC账户
        $smbc_account = SMBC::applyAccount();
        //注册User
        $user       = new User();
        $user->type = _User::PERSONAL;
        //注册钱包
        $user_token_wallet = new UserTokenWallet();
        $user_token_wallet->create( false );
        $user->smbc_account_id = $smbc_account->id;

    }

    /**
     * 注册公司用户
     * @param string $company_name
     * @param string $password
     */
    public
    function registerCompanyUser( string $company_name, string $password )
    {

    }
}