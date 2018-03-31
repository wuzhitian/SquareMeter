<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: TimerCenter.php
 * Create: 2018/3/30
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\CORE_SERVICES\TimerCenter;

use UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\MODEL\Service;

/**
 * 定时器服务中心
 * Class TimerCenter
 * @package UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\CORE_SERVICES\TimerCenter
 */
class TimerCenter extends Service
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