<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: DataCenterConfig.php
 * Create: 2018/3/27
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\DATA;

use UmbServer\SwooleFramework\LIBRARY\DB\MySQLConfig;
use UmbServer\SwooleFramework\LIBRARY\DB\RedisConfig;

/**
 * 数据中心配置类
 * Class DataCenterConfig
 * @package UmbServer\SwooleFramework\LIBRARY\DATA
 */
class DataCenterConfig
{
    public $redis; //redis配置
    public $mysql; //mysql配置
}