<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: IREToken.php
 * Create: 2018/4/10
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\MIDDLETIER\MODEL\CONTRACT;

use EOSS\COMPONENT\CORE\BASE\Contract;
use EOSS\COMPONENT\MODEL\DATA\BCAccountSafe;
use UmbServer\SwooleFramework\LIBRARY\STRUCTURE\Amount;

/**
 * 产业地产资产合约类
 * Class IREToken
 * @package SMPlatform\MIDDLETIER\MODEL\CONTRACT
 */
class IREToken extends Contract
{
    public $decimal_bit; //小数点位数

    private
    function transfer( BCAccountSafe $account_a, BCAccountSafe $account_b, Amount $amount )
    {
    }

    private
    function getBalance( BCAccountSafe $account ): Amount
    {
        $response = new SMBCNodeResponse();
        $response->setData();
        $res = $response->data;
        return $res;
    }

    private
    function getHolders(): array
    {

    }
}