<?php declare( strict_types = 1 );
/**
 * Project: EOSS
 * File: BCTaskCenter.php
 * Create: 2018/3/31
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace EOSS\COMPONENT\CORE\BCTaskCenter;

use UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\MODEL\Service;

/**
 * 区块链上任务系统
 * Class BCTaskCenter
 * @package EOSS\COMPONENT\CORE\BCTaskCenter
 */
class BCTaskCenter extends Service
{
    //构建单例
    /************************************************************/
    private static $_instance;
    
    private
    function __construct()
    {
    }
    
    private
    function __clone()
    {
    }
    
    public static
    function getInstance(): self
    {
        if ( !( self::$_instance instanceof self ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    /************************************************************/
}