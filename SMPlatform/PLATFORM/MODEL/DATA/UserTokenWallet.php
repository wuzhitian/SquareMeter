<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: UserTokenWallet.php
 * Create: 2018/4/9
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\PLATFORM\MODEL\DATA;

use UmbServer\SwooleFramework\LIBRARY\INSTANCE\InstanceTrait;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\SafeInstance;

/**
 * 平方米用户token钱包类，私有
 * Class UserTokenWallet
 * @package SMPlatform\PLATFORM\MODEL\DATA
 */
class UserTokenWallet extends SafeInstance
{
    use InstanceTrait;
    
    const TABLE_NAME = 'UserTokenWallet';
    
    const SCHEMA = [
        'is_active'      => BOOL_TYPE,
        'user_wallet_id' => STRING_TYPE,
        'token_id'       => STRING_TYPE,
        'frozen_amount'  => AMOUNT_TYPE,
        'balance_amount' => AMOUNT_TYPE,
    ];
    
    public $is_active; //是否启动
    public $user_wallet_id; //用户钱包id
    public $token_id; //token id
    public $frozen_amount; //冻结金额
    public $balance_amount; //余额
}