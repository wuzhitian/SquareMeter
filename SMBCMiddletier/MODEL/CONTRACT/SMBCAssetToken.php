<?php declare( strict_types = 1 );
/**
 * Project: SMBCMiddletier
 * File: SMBCAssetToken.php
 * Create: 2018/4/10
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMBCMiddletier\MODEL\CONTRACT;

use SMBCMiddletier\ERROR\SMBCMiddletierError;
use SMBCMiddletier\MODEL\DATA\SMBCAccount;
use SMBCMiddletier\MODEL\DATA\SMBCContract;
use UmbServer\SwooleFramework\LIBRARY\STRUCTURE\Amount;

/**
 * 资产Token合约类
 * Class SMBCAssetToken
 * @package SMBCMiddletier\MODEL\CONTRACT
 */
class SMBCAssetToken extends SMBCContract implements SMBCToken
{
    /**
     * 发行
     * @param Amount $issue_amount
     * @return bool
     * @throws SMBCMiddletierError
     */
    public
    function issue( Amount $issue_amount ): bool
    {
        //forbidden
        return false;
    }

    /**
     * 增发
     * @param Amount $increase_amount
     * @return bool
     * @throws SMBCMiddletierError
     */
    public
    function increase( Amount $increase_amount ): bool
    {
        //forbidden
        return false;
    }

    /**
     * 减持
     * @param Amount $decrease_amount
     * @return bool
     * @throws SMBCMiddletierError
     */
    public
    function decrease( Amount $decrease_amount ): bool
    {
        //forbidden
        return false;
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
     * 根据账户获取余额
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