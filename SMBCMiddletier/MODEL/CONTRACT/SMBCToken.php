<?php declare( strict_types = 1 );
/**
 * Project: SMBCMiddletier
 * File: SMBCToken.php
 * Create: 2018/4/15
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMBCMiddletier\MODEL\CONTRACT;

use SMBCMiddletier\MODEL\DATA\SMBCAccount;
use UmbServer\SwooleFramework\LIBRARY\STRUCTURE\Amount;

/**
 * SMBCToken类型合约接口类
 * Interface SMBCToken
 * @package SMBCMiddletier\MODEL\CONTRACT
 */
interface SMBCToken
{
    /**
     * 发行
     * @param Amount $issue_amount
     * @return bool
     */
    public
    function issue( Amount $issue_amount ): bool;

    /**
     * 增发
     * @param Amount $increase_amount
     * @return bool
     */
    public
    function increase( Amount $increase_amount ): bool;

    /**
     * 减持
     * @param Amount $decrease_amount
     * @return bool
     */
    public
    function decrease( Amount $decrease_amount ): bool;

    /**
     * 转账
     * @param string $operator_account_address
     * @param string $target_account_address
     * @param Amount $transfer_amount
     * @return bool
     */
    public
    function transfer( string $operator_account_address, string $target_account_address, Amount $transfer_amount ): bool;

    /**
     * 获取账户余额
     * @param SMBCAccount $account
     * @return Amount
     */
    public
    function getBalanceByAccount( SMBCAccount $account ): Amount;

    /**
     * 获取发行总量
     * @return Amount
     */
    public
    function getIssueAmount(): Amount;

    /**
     * 获取参与者账户数组
     * @return array
     */
    public
    function getHoldersAccountArray(): array;
}