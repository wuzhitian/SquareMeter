<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: UserBankCard.php
 * Create: 2018/4/9
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\PLATFORM\MODEL\DATA;

use SMPlatform\PLATFORM\MODEL\ENUM\_User;
use SMPlatform\PLATFORM\MODEL\ENUM\_UserBankCard;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\InstanceTrait;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\SafeInstance;

/**
 * 用户银行卡类
 * Class UserBankCard
 * @package SMPlatform\PLATFORM\MODEL\DATA
 */
class UserBankCard extends SafeInstance
{
    use InstanceTrait;

    const TABLE_NAME = 'UserBankCard';

    const SCHEMA
        = [
            'user_id'   => STRING_TYPE,
            'type'      => STRING_TYPE,
            'bank'      => STRING_TYPE,
            'number'    => STRING_TYPE,
            'is_active' => BOOL_TYPE,
        ];

    public $user_id; //用户id
    public $type = _UserBankCard::DEPOSIT_CARD; //默认为储蓄卡
    public $bank; //银行
    public $number; //银行卡号
    public $is_active; //是否启用

    /**
     * 是否为公司账户
     * @return bool
     */
    public
    function isPublicAccount(): bool
    {
        $res  = false;
        $user = User::getById( $this->user_id );
        if ( $user->type === _User::COMPANY ) {
            $res = true;
        }
        return $res;
    }
}