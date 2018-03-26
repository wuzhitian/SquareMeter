<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: Algorithm.php
 * Create: 2018/3/20
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\UTIL;

/**
 * 算法工具类
 * Class Algorithm
 * @package UmbServer\SwooleFramework\LIBRARY\UTIL
 */
abstract
class Algorithm
{
    /**
     * sha384 hmac加密
     * @param $data
     * @param $secret
     * @return string
     */
    public static
    function hmacSha384( $data, $secret )
    {
        $res = bin2hex( mhash( MHASH_SHA384, $data, $secret ) );
        return $res;
    }

    /**
     * sha256 hmac加密
     * @param $data
     * @param $secret
     * @return string
     */
    public static
    function hmacSha256( $data, $secret )
    {
        $res = bin2hex( mhash( MHASH_SHA256, $data, $secret ) );
        return $res;
    }

    /**
     * md5
     * @param string $data
     * @return string
     */
    public static
    function md5( string $data ): string
    {
        $res = md5( $data );
        return $res;
    }
}