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

use UmbServer\SwooleFramework\LIBRARY\ENUM\_Serialize;
use UmbServer\SwooleFramework\LIBRARY\FILESYSTEM\FORMAT\{
    JsonFile, XMLFile, YMLFile, INIFile
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
     * @param string $config_type
     * @return \stdClass
     */
    public static
    function parse( $config, string $config_type = _Config::JSON ): \stdClass
    {
        switch ( $config_type ) {
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
            case _Config::JSON_FILE:
                $json_file = new JsonFile();
                $json_file->setByPath( $config );
                $res = self::parseByJsonFile( $json_file );
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
     * @return \stdClass
     */
    private static
    function parseByJson( $json_data ): \stdClass
    {
        $res = json_decode( $json_data );
        return $res;
    }
    
    /**
     * 解析array的配置对象
     * @param array $array_data
     * @return \stdClass
     */
    private static
    function parseByArray( array $array_data ): \stdClass
    {
        return (object)$array_data;
    }
    
    /**
     * 解析object的配置对象
     * @param \stdClass $object_data
     * @return \stdClass
     */
    private static
    function parseByObject( \stdClass $object_data ): \stdClass
    {
        $res = (object)get_object_vars( $object_data );
        return $res;
    }
    
    /**
     * 解析xml文件
     * @param XMLFile $xml_file
     * @return \stdClass
     */
    private static
    function parseByXMLFile( XMLFile $xml_file ): \stdClass
    {
        $res = (object)$xml_file;
        return $res;
    }
    
    /**
     * 解析yml文件
     * @param YMLFile $yml_file
     * @return \stdClass
     */
    private static
    function parseByYMLFile( YMLFile $yml_file ): \stdClass
    {
        $res = (object)$yml_file;
        return $res;
    }
    
    /**
     * 解析ini文件
     * @param INIFile $ini_file
     * @return \stdClass
     */
    private static
    function parseByINIFile( INIFile $ini_file ): \stdClass
    {
        $res = (object)$ini_file;
        return $res;
    }
    
    /**
     * 解析json文件
     * @param INIFile $json_file
     * @return \stdClass
     */
    private static
    function parseByJsonFile( JsonFile $json_file ): \stdClass
    {
        $json_encode = $json_file->getContent();
        $res         = Serialize::decode( $json_encode, _Serialize::JSON );
        return $res;
    }
}