<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: DepartmentTokenWallet.php
 * Create: 2018/4/9
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\PLATFORM\MODEL\DATA;

use UmbServer\SwooleFramework\LIBRARY\INSTANCE\SafeInstance;

/**
 * 平台部门token钱包类，公有
 * Class DepartmentTokenWallet
 * @package SMPlatform\PLATFORM\MODEL\DATA
 */
class DepartmentTokenWallet extends SafeInstance
{
    const TABLE_NAME = 'UserTokenWallet';
    
    const SCHEMA = [
        'department_id'  => STRING_TYPE,
        'token_id'       => STRING_TYPE,
        'frozen_amount'  => DOUBLE_TYPE,
        'balance_amount' => DOUBLE_TYPE,
        'description'    => TEXT_TYPE,
    ];
    
    public $department_id; //部门id
    public $token_id; //token id
    public $frozen_amount; //冻结金额
    public $balance_amount; //余额
    public $description; //描述
}