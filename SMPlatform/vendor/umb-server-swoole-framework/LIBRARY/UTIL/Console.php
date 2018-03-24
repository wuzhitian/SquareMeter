<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: Console.php
 * Create: 2018/3/24
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\UTIL;

/** 
 * 控制台工具类
 * Class Console
 * @package UmbServer\SwooleFramework\LIBRARY\UTIL
 */
abstract
class Console
{
    /**
     * 输出content
     * @param $content
     */
    public static
    function log( $content )
    {
        if ( is_string( $content ) ) {
            echo $content . PHP_EOL;
        } else {
            var_dump( $content );
        }
    }
}