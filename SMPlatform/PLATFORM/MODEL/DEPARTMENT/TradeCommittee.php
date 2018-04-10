<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: TradeCommittee.php
 * Create: 2018/4/10
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\PLATFORM\MODEL\DEPARTMENT;

use SMPlatform\PLATFORM\MODEL\DATA\Department;
use SMPlatform\PLATFORM\MODEL\DATA\Token;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\SinglePatternTrait;
use UmbServer\SwooleFramework\LIBRARY\STRUCTURE\Amount;

/**
 * 交易基础委员会类
 * Class TradeCommittee
 * @package SMPlatform\PLATFORM\MODEL\DEPARTMENT
 */
class TradeCommittee extends Department
{
    use SinglePatternTrait; //加载单例模式
    
    /**
     * 交易误差转移
     * @param Token $token
     * @param Amount $deviation_amount
     */
    public
    function tradeDeviationTransfer( Token $token, Amount $deviation_amount )
    {
    
    }
}