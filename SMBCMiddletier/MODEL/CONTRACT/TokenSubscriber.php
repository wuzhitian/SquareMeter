<?php declare( strict_types = 1 );
/**
 * Project: SMBCMiddletier
 * File: TokenSubscriber.php
 * Create: 2018/4/15
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMBCMiddletier\MODEL\CONTRACT;

use SMBCMiddletier\MODEL\DATA\SMBCAccount;
use SMBCMiddletier\MODEL\DATA\SMBCContract;
use UmbServer\SwooleFramework\LIBRARY\STRUCTURE\Amount;
use UmbServer\SwooleFramework\LIBRARY\STRUCTURE\FrontRearArray;

/**
 * Token认购合约类
 * Class TokenSubscriber
 * @package SMBCMiddletier\MODEL\CONTRACT
 */
class TokenSubscriber extends SMBCContract
{
    /**
     * 获取总份额
     * @return int
     */
    public
    function getTotalLotIssueAmount(): int
    {
        $res = $this->call();
        return $res;
    }

    /**
     * 开始认购
     * @return bool
     */
    public
    function startSubscribe(): bool
    {
        $res = $this->transaction();
        return $res;
    }

    /**
     * 获取已销售的份额
     * @return int
     */
    public
    function getSoldLotAmount(): int
    {
        $res = $this->call();
        return $res;
    }

    /**
     * 获取用户可购买剩余份额
     * @return int
     */
    public
    function getAccountRestLotAmountLimit(): int
    {
        $res = $this->call();
        return $res;
    }

    /**
     * 根据账户获取用户购买的份额索引号首尾数组
     * [[a1,an],[b1,bm],...]
     * @param SMBCAccount $account
     * @return FrontRearArray
     */
    public
    function getLotIndexFrontRearArrayByAccount( SMBCAccount $account ): FrontRearArray
    {
        $res = new FrontRearArray();
        return $res;
    }

    /**
     * 结束认购
     * @return bool
     */
    public
    function stopSubscribe(): bool
    {
        $res = $this->transaction();
        return $res;
    }

    /**
     * 中止认购
     * @return bool
     */
    public
    function abortSubscribe(): bool
    {
        $res = $this->transaction();
        return $res;
    }

    /**
     * 开始摇号
     * @return bool
     */
    public
    function lottery(): bool
    {
        $res = $this->transaction();
        return $res;
    }

    /**
     * 获取用户中奖份额
     * @param SMBCAccount $account
     * @return int
     */
    public
    function getPrizeLotAmountByAccount( SMBCAccount $account ): int
    {
        $res = $this->call();
        return $res;
    }

    /**
     * 获取用户需要退回的入口token数额
     * @param SMBCAccount $account
     * @return Amount
     */
    public
    function getRefundInsideTokenAmountByAccount( SMBCAccount $account ): Amount
    {
        $res = new Amount();
        return $res;
    }

    /**
     * 获取中奖结果特征数组
     * @return array
     */
    public
    function getPrizeLotFeatureArray(): array
    {
        $res = $this->call();
        return $res;
    }
}