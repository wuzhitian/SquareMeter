<?php
/**
 * Project: UmbServerSwooleFramework
 * File: Generator.php
 * Create: 2018/3/12
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\TOOL;

/**
 * Class Generator
 * @package UmbServer\SwooleFramework\LIBRARY\UTIL
 */
abstract class Generator
{
    /**
     * @return string
     */
    public static function uuid()
    {
        $char = strtoupper( md5( uniqid( mt_rand(), true ) ) );
        $hyphen = chr( 45 );
        $res = substr( $char, 0, 8 ) . $hyphen . substr( $char, 8, 4 ) . $hyphen . substr( $char, 12, 4 ) . $hyphen . substr( $char, 16, 4 ) . $hyphen . substr( $char, 20, 12 );
        return $res;
    }

    /**
     * @param $length
     * @return string
     */
    public static function randomNumber( $length )
    {
        $random_number = '';
        for ( $i = 0; $i < $length; $i++ ) {
            $bit = mt_rand( 0, 9 );
            $random_number .= (string)$bit;
        }
        return $random_number;
    }
}