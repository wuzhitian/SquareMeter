<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: DataHandlerHandler.php
 * Create: 2018/3/19
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\UTIL;

use UmbServer\SwooleFramework\LIBRARY\ENUM\_Serialize;

/**
 * 数据处理工具类
 * Class DataHandler
 * @package UmbServer\SwooleFramework\LIBRARY\UTIL
 */
abstract
class DataHandler
{
    /**
     * 根绝类型转换数值
     * @param $type
     * @param $value
     * @return mixed
     */
    public static
    function typeConversion( $type, $value )
    {
        if ( is_null( $value ) ) {
            return NULL;
        }
        switch ( $type ) {
            case INT_TYPE:
            case TIMESTAMP_TYPE:
                $res = (int)$value;
                break;
            case BOOL_TYPE:
                $res = (bool)$value;
                break;
            case FLOAT_TYPE:
                $res = (float)$value;
                break;
            case DOUBLE_TYPE:
                $res = (double)$value;
                break;
            case ARRAY_TYPE:
                $res = (array)$value;
                break;
            case OBJECT_TYPE:
                $res = (object)$value;
                break;
            case MD5_TYPE:
                $res = Serialize::encode( $value, _Serialize::JSON );
                $res = Algorithm::md5( $res );
                break;
            case STRING_TYPE:
            case TEXT_TYPE:
            default:
                $res = (string)$value;
        }
        return $res;
    }

    /**
     * 为string类型的字符串前后添加符号，默认为双引号
     * @param $string
     * @param string $quotation
     * @return int|string
     */
    public static
    function quotation( $string, $quotation = '"' )
    {
        $string_format = $string;
        if ( isset( $string ) && is_string( $string ) ) {
            $string        = str_replace( '"', '\"', $string );
            $string_format = $quotation . $string . $quotation;
        }
        if ( is_bool( $string ) ) {
            $string_format = $string ? 1 : 0;
        }
        return $string_format;
    }

    /**
     * 获取指定分割符的最后一个片段
     * @param string $delimiter
     * @param string $string
     * @return mixed
     */
    public static
    function getLastSegment( string $delimiter, string $string )
    {
        $res = end( explode( $delimiter, $string ) );
        return $res;
    }

    /**
     * 获取小数位数
     * @param float $value
     * @return int
     */
    public static
    function getDecimalBit( float $value ): int
    {
        $count = 0;
        $temp  = explode( '.', (string)$value );
        if ( sizeof( $temp ) > 0 ) {
            $decimal = end( $temp );
            $count   = strlen( $decimal );
        }
        return $count;
    }

    /**
     * url编码
     * @param string $url
     * @return string
     */
    public static
    function urlEncode( string $url ): string
    {
        $res = urlencode( $url );
        return $res;
    }

    /**
     * url解码
     * @param string $url_encode
     * @return string
     */
    public static
    function urlDecode( string $url_encode ): string
    {
        $res = urldecode( $url_encode );
        return $res;
    }
}