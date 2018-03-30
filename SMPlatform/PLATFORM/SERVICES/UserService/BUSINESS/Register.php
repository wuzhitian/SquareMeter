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

/**
 * 注册业务类
 * Class Register
 * @package SMPlatform\PLATFORM\SERVICES\AccountService\BUSINESS
 */
abstract class Register
{
    /**
     * 注册个人投资者账户
     * @param string $cellphone
     * @param string $password
     */
    public function registerPersonalInvestor( string $cellphone, string $password )
    {
    
    }
    
    public function registerCompanyInvestor( string $company_name, string $password )
    {
    
    }
}