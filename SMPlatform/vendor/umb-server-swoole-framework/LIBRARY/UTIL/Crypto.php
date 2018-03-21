<?php
/**
 * Project: UmbServerSwooleFramework
 * File: Crypto.php
 * Create: 2018/3/20
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\UTIL;

/**
 * 加解密工具类
 * Class Crypto
 * @package UmbServer\SwooleFramework\LIBRARY\UTIL
 */
abstract class Crypto
{
    /**
     * 加密算法
     * @param $data
     * @param $key
     * @return string
     */
    public static function enCrypt( $data, $key )
    {
        $key = md5( $key );
        $char = '';
        $str = '';
        $x = 0;
        $len = strlen( $data );
        $l = strlen( $key );
        for ( $i = 0; $i < $len; $i++ ) {
            if ( $x == $l ) {
                $x = 0;
            }
            $char .= $key{$x};
            $x++;
        }
        for ( $i = 0; $i < $len; $i++ ) {
            $str .= chr( ord( $data{$i} ) + ( ord( $char{$i} ) ) % 256 );
        }
        return base64_encode( $str );
    }

    /**
     * 解密算法
     * @param $data
     * @param $key
     * @return string
     */
    public static function deCrypt( $data, $key )
    {
        $key = md5( $key );
        $char = '';
        $str = '';
        $x = 0;
        $data = base64_decode( $data );
        echo 'Decode: ' . $data . PHP_EOL;
        echo 'Length:' . strlen( $data ) . PHP_EOL;
        $len = strlen( $data );
        $l = strlen( $key );
        for ( $i = 0; $i < $len; $i++ ) {
            if ( $x == $l ) {
                $x = 0;
            }
            $char .= substr( $key, $x, 1 );
            $x++;
        }
        for ( $i = 0; $i < $len; $i++ ) {
            if ( ord( substr( $data, $i, 1 ) ) < ord( substr( $char, $i, 1 ) ) ) {
                $str .= chr( ( ord( substr( $data, $i, 1 ) ) + 256 ) - ord( substr( $char, $i, 1 ) ) );
            } else {
                $str .= chr( ord( substr( $data, $i, 1 ) ) - ord( substr( $char, $i, 1 ) ) );
            }
        }
        return $str;
    }
}