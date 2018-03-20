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
class _DB extends \SplEnum
{
    const MySQL       = 'mysql';
    const Redis       = 'redis';
    const SwooleTable = 'swoole_table';
}