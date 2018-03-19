<?php
/**
 * Project: UmbServerSwooleFramework
 * File: Generator.php
 * Create: 2018/3/12
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\UTIL;

/**
 * 生成器工具类
 * Class Generator
 * @package UmbServer\SwooleFramework\LIBRARY\UTIL
 */
abstract class Generator
{
    /**
     * 生成uuid
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
     * 生成定长随机数
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

    /**
     * 生成随机的文件名
     * @param int $bit_count
     * @return bool|string
     */
    public static function randomFileName( $bit_count = 16 )
    {
        $char = md5( uniqid( mt_rand(), true ) );
        $res = substr( $char, 0, $bit_count );
        return $res;
    }


    /**
     * token生成器，token为16位字符串
     * @return string
     */
    public static function token()
    {
        $char = md5( uniqid( mt_rand(), true ) );
        $res = substr( $char, 0, 16 );
        return $res;
    }

    /**
     * apiSecret生成器，36位字符串
     * @return string
     */
    public static function apiSecret()
    {
        $char = md5( uniqid( mt_rand(), true ) );
        $res = substr( $char, 0, 32 );
        return $res;
    }

    /**
     * 生成验证码，默认为6位数字
     * @param int $bit_count
     * @return string
     */
    public static function validateCode( $bit_count = 6 )
    {
        $res = self::randomNumber( $bit_count );
        return $res;
    }
}