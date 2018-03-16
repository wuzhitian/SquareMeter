<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: _Config.php
 * Create: 2018/3/15
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\ENUM;

/**
 * Config类型的枚举类
 * Class _Config
 * @package UmbServer\SwooleFramework\MODEL\ENUM
 */
abstract
class _Config extends \SplEnum
{
    const JSON     = 'json';
    const ARRAY    = 'array';
    const OBJECT   = 'object';
    const XML_FILE = 'xml_file';
    const YML_FILE = 'yml_file';
    const INI_FILE = 'ini_file';
}