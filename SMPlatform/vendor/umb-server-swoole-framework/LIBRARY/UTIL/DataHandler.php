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

use UmbServer\SwooleFramework\LIBRARY\DATA\Data;
use UmbServer\SwooleFramework\LIBRARY\DATA\DBData;

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
        switch ( $type ) {
            case INT_TYPE:
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
}