<?php
/**
 * Project: UmbServerSwooleFramework
 * File: Time.php
 * Create: 2018/3/19
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\UTIL;

/**
 * 时间工具类
 * Class Time
 * @package UmbServer\SwooleFramework\LIBRARY\UTIL
 */
abstract class Time
{
    /**
     * 获取当前UNIX时间戳
     * @param string $format
     * @return int
     */
    public static function getNow( $format = 'ms' )
    {
        $res = (int)( microtime( true ) * 1000 );
        if ( $format == 's' ) {
            $res = (int)( $res / 1000 );
        }
        return $res;
    }

    /**
     * TZ时间转UNIX时间戳
     * @param $tz_timestamp
     * @param string $format
     * @return int
     */
    public static function tzToTimestamp( $tz_timestamp, $format = 'ms' )
    {
        $date = explode( 'T', $tz_timestamp )[ 0 ];
        $sec = explode( 'Z', explode( 'T', $tz_timestamp )[ 1 ] )[ 0 ];
        $micro_sec = explode( '.', $sec )[ 1 ];
        $res = (int)( strtotime( $date . $sec ) * 1000 + $micro_sec ) + 28800000;
        if ( $format == 's' ) {
            $res = (int)( $res / 1000 );
        }
        return $res;
    }
}