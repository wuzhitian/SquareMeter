<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: ConfigLoader.php
 * Create: 2018/3/14
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\UTIL;

use UmbServer\SwooleFramework\LIBRARY\FILESYSTEM\FORMAT\{
    XMLFile,
    YMLFile,
    INIFile,
};
use UmbServer\SwooleFramework\LIBRARY\ENUM\_Config;

/**
 * 配置文件加载工具类
 * Class ConfigLoader
 * @package UmbServer\SwooleFramework\MODEL\UTIL
 */
abstract
class ConfigLoader
{
    /**
     * 根据配置数据的类型，解析配置，返回stdClass
     * @param $config
     * @param string $data_type
     * @return object
     */
    public static
    function parse( $config, $data_type = _Config::JSON ): object
    {
        switch ( $data_type ) {
            case _Config::ARRAY:
                $res = self::parseByArray( $config );
                break;
            case _Config::OBJECT:
                $res = self::parseByObject( $config );
                break;
            case _Config::XML_FILE:
                $res = self::parseByXMLFile( $config );
                break;
            case _Config::YML_FILE:
                $res = self::parseByYMLFile( $config );
                break;
            case _Config::INI_FILE:
                $res = self::parseByINIFile( $config );
                break;
            case _Config::JSON:
            default:
                $res = self::parseByJson( $config );
                break;
        }
        return $res;
    }

    /**
     * 解析json的配置对象
     * @param $json_data
     * @return object
     */
    private static
    function parseByJson( $json_data ): object
    {
        $res = json_decode( $json_data );
        return $res;
    }

    /**
     * 解析array的配置对象
     * @param array $array_data
     * @return object
     */
    private static
    function parseByArray( array $array_data ): object
    {
        return (object)$array_data;
    }

    /**
     * 解析object的配置对象
     * @param object $object_data
     * @return object
     */
    private static
    function parseByObject( object $object_data ): object
    {
        $res = (object)get_object_vars( $object_data );
        return $res;
    }

    /**
     * 解析xml文件
     * @param XMLFile $xml_file
     * @return object
     */
    private static
    function parseByXMLFile( XMLFile $xml_file ): object
    {
        $res = (object)$xml_file;
        return $res;
    }

    /**
     * 解析yml文件
     * @param YMLFile $yml_file
     * @return object
     */
    private static
    function parseByYMLFile( YMLFile $yml_file ): object
    {
        $res = (object)$yml_file;
        return $res;
    }

    /**
     * 解析ini文件
     * @param INIFile $ini_file
     * @return object
     */
    private static
    function parseByINIFile( INIFile $ini_file ): object
    {
        $res = (object)$ini_file;
        return $res;
    }
}