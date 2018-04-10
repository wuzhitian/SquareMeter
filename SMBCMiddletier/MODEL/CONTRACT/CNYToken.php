<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: CNYToken.php
 * Create: 2018/4/10
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\MIDDLETIER\MODEL\CONTRACT;

use EOSS\COMPONENT\CORE\BASE\Contract;
use EOSS\COMPONENT\MODEL\BASE\SMBCNodeResponse;
use EOSS\COMPONENT\MODEL\DATA\BCAccountSafe;
use SMPlatform\MIDDLETIER\MODEL\DATA\SMBCAccount;
use SMPlatform\PLATFORM\MODEL\ENUM\_DigitalEstateIssueMode;
use UmbServer\SwooleFramework\LIBRARY\STRUCTURE\Amount;

/**
 * CNYT合约
 * Class CNYToken
 * @package SMPlatform\MIDDLETIER\MODEL\CONTRACT
 */
class CNYToken extends Contract
{
    public $decimal_bit = 6; //小数点位数

    public $owner;

    public $issue_mode = _DigitalEstateIssueMode::DYNAMIC;

    public
    function issue()
    {
        //TODO 发行
    }

    public
    function increase( Amount $increase_amount )
    {
        $this->mint( $increase_amount->getRealValue() * pow( 10, $this->decimal_bit ) );
    }

    public
    function decrease( SMBCAccount $account, Amount $decrease_amount )
    {
        $this->transfer( $account, $this, $decrease_amount );
    }

    private
    function mint( Amount $mint_amount )
    {

    }

    private
    function transfer( BCAccountSafe $account_a, BCAccountSafe $account_b, Amount $CNYT_amount )
    {

    }

    private
    function getBalance( BCAccountSafe $account )
    {
        $response = new SMBCNodeResponse();
        $response->setData();
        $res = $response->data;
        return $res;
    }

    private
    function getOwnerAccount(): SMBCAccount
    {

    }
}