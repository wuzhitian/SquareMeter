<?php
/**
 * Project: UmbServerSwooleLibrary
 * File: ServiceManager.php
 * Create: 2018/3/9
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleLibrary\FRAMEWORK\CORE\MANAGER;

/**
 * Class ServiceManager
 * @package UmbServer\SwooleLibrary\MODEL\CORE\MANAGER
 */
class ServiceManager
{
    private static $_instance;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function getInstance(): self
    {
        if ( !( self::$_instance instanceof self ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    function launch()
    {

    }

    function pause()
    {

    }

    function stop()
    {

    }
}