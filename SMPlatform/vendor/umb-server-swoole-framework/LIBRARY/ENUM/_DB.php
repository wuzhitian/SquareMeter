<?php
/**
 * Project: UmbServerSwooleFramework
 * File: _DB.php
 * Create: 2018/3/12
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\ENUM;

/**
 * DB类型的枚举类
 * Class _DataBase
 * @package UmbServer\SwooleFramework\LIBRARY\ENUM
 */
abstract
class _DB
{
    const MYSQL        = 'mysql';
    const REDIS        = 'redis';
    const SWOOLE_TABLE = 'swoole_table';
    const NONE         = 'none';
}