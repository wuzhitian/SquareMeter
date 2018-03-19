<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: Serialize.php
 * Create: 2018/3/19
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\UTIL;

use swoole_serialize;
use UmbServer\SwooleFramework\LIBRARY\ERROR\UtilError;

/**
 * 序列化工具类
 * Class Serialize
 * @package UmbServer\SwooleFramework\LIBRARY\UTIL
 */
abstract
class Serialize
{
    const UMB_SERIALIZE_SOF = 'UMB_SERIALIZE_START::'; //umb序列化起始符
    const UMB_SERIALIZE_EOF = '::UMB_SERIALIZE_END'; //umb序列化结束符

    /**
     * 是否为umbEncode的字符串
     * @param string $pack_data
     * @return bool
     */
    private static
    function isUmbEncodeData( string $pack_data ): bool
    {
        $sof_length = strlen( self::UMB_SERIALIZE_SOF );
        $eof_length = strlen( self::UMB_SERIALIZE_EOF );
        $sign_part  = substr(substr( $pack_data, 0, $sof_length ), );
        $res        = $sign_part === self::UMB_PACK_SIGN;
        return $res;
    }

    /**
     * umb序列化
     * @param mixed $un_pack_data
     * @return string
     * @throws UtilError
     */
    public static
    function umbEncode( mixed $un_pack_data ): string
    {
        $pack_res = swoole_serialize::pack( $un_pack_data );
        if ( $pack_res === false ) {
            throw new UtilError( UtilError::UN_SUPPORT_ENCODE_DATA );
        }
        $res = self::UMB_PACK_SIGN . $pack_res;
        return $res;
    }

    /**
     * umb反序列化
     * @param string $pack_data
     * @return mixed
     * @throws UtilError
     */
    public static
    function umbDecode( string $pack_data ): mixed
    {
        $sign_length = strlen( self::UMB_PACK_SIGN );
        $pack_data   = substr( $pack_data, $sign_length );
        $res         = swoole_serialize::unpack( $pack_data );
        if ( !self::isUmbEncodeData( $pack_data ) || $res === false ) {
            throw new UtilError( UtilError::UN_SUPPORT_DECODE_DATA );
        }
        return $res;
    }

    /**
     * json序列化
     * @param mixed $data
     * @return string
     */
    public static
    function jsonEncode( mixed $data ): string
    {
        $res = json_encode( $data, JSON_UNESCAPED_UNICODE ); // 解决中文乱码问题
        return $res;
    }

    /**
     * json反序列化
     * @param string $data
     * @return object
     */
    public static
    function jsonDecode( string $data ): object
    {
        $res = json_decode( $data );
        return $res;
    }
}