<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: Dispatcher.php
 * Create: 2018/3/12
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\MICROSERVICE;

use UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\MODEL\Service;

/**
 * 服务治理
 * Class Dispatcher
 * @package UmbServer\SwooleFramework\MICROSERVICE
 */
class Dispatcher extends Service
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