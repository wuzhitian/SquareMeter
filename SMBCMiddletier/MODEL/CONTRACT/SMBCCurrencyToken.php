<?php declare( strict_types = 1 );
/**
 * Project: SMBCMiddletier
 * File: SMBCCurrencyToken.php
 * Create: 2018/4/10
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMBCMiddletier\MODEL\CONTRACT;

use SMBCMiddletier\MODEL\DATA\SMBCAccount;
use SMBCMiddletier\MODEL\DATA\SMBCContract;
use UmbServer\SwooleFramework\LIBRARY\STRUCTURE\Amount;

/**
 * 货币Token合约
 * Class SMBCCurrencyToken
 * @package SMBCMiddletier\MODEL\CONTRACT
 */
class SMBCCurrencyToken extends SMBCContract implements SMBCToken
{
    /**
     * 发行
     * @param Amount $issue_amount
     * @return bool
     */
    public
    function issue( Amount $issue_amount ): bool
    {
        $res = $this->transaction();
        return $res;
    }

    /**
     * 增发
     * @param Amount $increase_amount
     * @return bool
     */
    public
    function increase( Amount $increase_amount ): bool
    {
        $res = $this->transaction();
        return $res;
    }

    /**
     * 减持
     * @param Amount $decrease_amount
     * @return bool
     */
    public
    function decrease( Amount $decrease_amount ): bool
    {
        $res = $this->transfer( $this->getOwner()->address, $this->address, $decrease_amount );
        return $res;
    }

    /**
     * 转账
     * @param string $operator_account_address
     * @param string $target_account_address
     * @param Amount $transfer_amount
     * @return bool
     */
    public
    function transfer( string $operator_account_address, string $target_account_address, Amount $transfer_amount ): bool
    {
        $res = $this->transaction();
        return $res;
    }

    /**
     * 获取账户余额
     * @param SMBCAccount $account
     * @return Amount
     */
    public
    function getBalanceByAccount( SMBCAccount $account ): Amount
    {
        $res = new Amount();
        return $res;
    }

    /**
     * 获取发行总量
     * @return Amount
     */
    public
    function getIssueAmount(): Amount
    {
        $res = new Amount();
        return $res;
    }

    /**
     * 获取参与者账户数组
     * @return array
     */
    public
    function getHoldersAccountArray(): array
    {
        $res = [];
        return $res;
    }

    /**
     * 获取小数点偏移位
     * @return int
     */
    private
    function getDecimalBit(): int
    {
        $res = $this->construct_params->decimal_bit;
        return $res;
    }
}