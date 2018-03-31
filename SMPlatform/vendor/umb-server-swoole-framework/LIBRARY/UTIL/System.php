<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: System.php
 * Create: 2018/3/31
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\UTIL;

/**
 * 系统工具类
 * Class System
 * @package UmbServer\SwooleFramework\LIBRARY\UTIL
 */
abstract class System
{
    /**
     * 执行系统指令
     * @param string $command
     */
    private static function exec( string $command )
    {
        system( $command );
    }
    
    /**
     * 清屏
     */
    public static function clearScreen()
    {
        $command = 'clear';
        self::exec( $command );
    }
}