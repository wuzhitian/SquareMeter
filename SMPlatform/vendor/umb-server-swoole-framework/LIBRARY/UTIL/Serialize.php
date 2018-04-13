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

use UmbServer\SwooleFramework\LIBRARY\ENUM\_Serialize;
use UmbServer\SwooleFramework\LIBRARY\ERROR\UtilError;

use swoole_serialize;

/**
 * 序列化工具类
 * Class Serialize
 * @package UmbServer\SwooleFramework\LIBRARY\UTIL
 */
abstract
class Serialize
{
    /**
     * 序列化
     * @param $un_pack_data
     * @param string $type
     * @return string
     * @throws UtilError
     */
    public static
    function encode( $un_pack_data, $type = _Serialize::JSON ): string
    {
        switch ( $type ) {
            case _Serialize::UMB:
                $res = self::umbEncode( $un_pack_data );
                break;
            case _Serialize::JSON:
            default:
                $res = self::jsonEncode( $un_pack_data );
        }
        return $res;
    }
    
    /**
     * 反序列化
     * @param string $pack_data
     * @param string $type
     * @return mixed|\stdClass
     */
    public static
    function decode( string $pack_data, $type = _Serialize::JSON )
    {
        switch ( $type ) {
            case _Serialize::UMB:
                $res = self::umbDecode( $pack_data );
                break;
            case _Serialize::JSON:
            default:
                $res = self::jsonDecode( $pack_data );
        }
        return $res;
    }
    
    /**
     * 是否为umbEncode的字符串
     * @param string $pack_data
     * @return bool
     */
    private static
    function isUmbEncodeData( string $pack_data ): bool
    {
        $SOF_length = strlen( _Serialize::UMB_SERIALIZE_SOF );
        $EOF_length = strlen( _Serialize::UMB_SERIALIZE_EOF );
        $SOF        = substr( $pack_data, 0, $SOF_length );
        $EOF        = substr( $pack_data, -$EOF_length );
        $res        = $SOF === _Serialize::UMB_SERIALIZE_SOF && $EOF === _Serialize::UMB_SERIALIZE_EOF;
        return $res;
    }
    
    /**
     * umb序列化
     * @param $un_pack_data
     * @return string
     * @throws UtilError
     */
    public static
    function umbEncode( $un_pack_data ): string
    {
        $pack_res = swoole_serialize::pack( $un_pack_data );
        if ( $pack_res === false ) {
            throw new UtilError( UtilError::UN_SUPPORT_ENCODE_DATA );
        }
        $res = _Serialize::UMB_SERIALIZE_SOF . $pack_res . _Serialize::UMB_SERIALIZE_EOF;
        return $res;
    }
    
    /**
     * umb反序列化
     * @param string $pack_data
     * @return mixed
     * @throws UtilError
     */
    public static
    function umbDecode( string $pack_data )
    {
        $pack_length = strlen( $pack_data );
        $SOF_length  = strlen( _Serialize::UMB_SERIALIZE_SOF );
        $EOF_length  = strlen( _Serialize::UMB_SERIALIZE_EOF );
        $data_length = $pack_length - $SOF_length - $EOF_length;
        $data        = substr( $pack_data, $SOF_length, $data_length );
        $res         = swoole_serialize::unpack( $data );
        if ( !self::isUmbEncodeData( $pack_data ) || $res === false ) {
            throw new UtilError( UtilError::UN_SUPPORT_DECODE_DATA );
        }
        return $res;
    }
    
    /**
     * json序列化
     * @param $data
     * @return string
     */
    public static
    function jsonEncode( $data ): string
    {
        $res = json_encode( $data, JSON_UNESCAPED_UNICODE ); // 解决中文乱码问题
        return $res;
    }
    
    /**
     * json反序列化
     * @param string $data
     * @return \stdClass
     */
    public static
    function jsonDecode( string $data ): \stdClass
    {
        $res = json_decode( $data );
        return $res;
    }
}