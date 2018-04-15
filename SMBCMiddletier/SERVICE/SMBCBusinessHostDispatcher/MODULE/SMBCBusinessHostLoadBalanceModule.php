<?php declare( strict_types = 1 );
/**
 * Project: SMBCMiddletier
 * File: SMBCBusinessHostLoadBalanceModule.php
 * Create: 2018/4/15
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMBCMiddletier\SERVICE\SMBCBusinessHostDispatcher;

use SMBCMiddletier\MODEL\DATA\SMBCBusinessHost;
use UmbServer\SwooleFramework\LIBRARY\ENUM\_LoadBalanceStrategy;

/**
 * 业务服负载均衡模块
 * Class SMBCBusinessHostLoadBalanceModule
 * @package SMBCMiddletier\SERVICE\SMBCBusinessHostDispatcher
 */
abstract
class SMBCBusinessHostLoadBalanceModule
{
    /**
     * 选择合适的业务机
     * @return SMBCBusinessHost
     */
    public static
    function getPropertyBusinessHost(): SMBCBusinessHost
    {
        $load_balance_strategy    = SMBCBusinessHostDispatcher::getInstance()->getConfig()->extra->load_balance_strategy;
        $smbc_business_host_array = SMBCBusinessHost::getList();
        switch ( $load_balance_strategy ) {
            case _LoadBalanceStrategy::CUSTOMIZE:
            default:
                $property_smbc_business_host = $smbc_business_host_array[ 0 ];
                foreach ( $smbc_business_host_array as $index => $smbc_business_host ) {
                    if ( $smbc_business_host->response_time_span < $property_smbc_business_host->response_time_span ) {
                        $property_smbc_business_host = $smbc_business_host_array;
                    }
                }
        }
    }
}