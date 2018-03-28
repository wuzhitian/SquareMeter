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
            $string = str_replace( '"', '\"', $string );
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
    function lastSegment( string $delimiter, string $string )
    {
        $explode_array = array_reverse( explode( $delimiter, $string ) );
        $res = $explode_array[ 0 ];
        return $res;
    }
}