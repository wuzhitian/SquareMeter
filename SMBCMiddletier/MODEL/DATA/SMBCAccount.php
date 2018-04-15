<?php declare( strict_types = 1 );
/**
 * Project: SMBCMiddletier
 * File: SMBCAccount.php
 * Create: 2018/4/8
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMBCMiddletier\MODEL\DATA;

use EOSS\COMPONENT\MODEL\DATA\BCAccountSafe;
use SMBCMiddletier\MODEL\CONTRACT\SMBCToken;
use UmbServer\SwooleFramework\LIBRARY\STRUCTURE\Amount;

/**
 * SMBC账户类
 * Class SMBCAccount
 * @package SMBCMiddletier\MODEL\DATA
 */
class SMBCAccount extends BCAccountSafe
{
    /**
     * 通过Token获取余额
     * @param SMBCToken $token
     * @return Amount
     */
    public
    function getBalanceByToken( SMBCToken $token ): Amount
    {
        $res = $token->getBalanceByAccount( $this );
        return $res;
    }

    /**
     * 转账
     * @param SMBCToken $token
     * @param SMBCAccount $target_account
     * @param Amount $transfer_amount
     * @return bool
     */
    public
    function transfer( SMBCToken $token, SMBCAccount $target_account, Amount $transfer_amount ): bool
    {
        $res = $token->transfer( $this->address, $target_account->address, $transfer_amount );
        return $res;
    }
}