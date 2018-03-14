<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: ConfigLoader.php
 * Create: 2018/3/14
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\TOOL;

use UmbServer\SwooleFramework\LIBRARY\FILESYSTEM\FORMAT\{
    XMLFile,
    YMLFile,
    INIFile,
};

/**
 * 配置文件加载工具类
 * Class ConfigLoader
 * @package UmbServer\SwooleFramework\LIBRARY\UTIL
 */
abstract class ConfigLoader
{
    public function parse()
    {

    }

    public function parseByJson( $json_data )
    {

    }

    public function parseByArray( array $array_data )
    {

    }

    public function parseByObject( \stdClass $object_data )
    {

    }

    public function parseByXMLFile(XMLFile $xml_file){

    }

    public function parseByYMLFile(YMLFile $yml_file){

    }

    public function parseByINIFile(INIFile $ini_file){

    }
}