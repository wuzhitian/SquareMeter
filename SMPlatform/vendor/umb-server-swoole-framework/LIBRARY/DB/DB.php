<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: DB.php
 * create: 2018/3/9
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\DB;

use UmbServer\SwooleFramework\LIBRARY\ENUM\_Config;

/**
 * 数据库接口类
 * Interface DB
 * @package UmbServer\SwooleFramework\LIBRARY\DB
 */
interface DB
{
    public
    function setConfig( $config, string $config_type = _Config::OBJECT );
}