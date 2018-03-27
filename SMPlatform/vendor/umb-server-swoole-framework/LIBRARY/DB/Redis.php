<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleLibrary
 * File: Redis.php
 * Create: 2018/3/9
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\DB;

use UmbServer\SwooleFramework\LIBRARY\ENUM\_Config;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\Instance;
use UmbServer\SwooleFramework\LIBRARY\UTIL\ConfigLoader;

/**
 * Class Redis
 * @package UmbServer\SwooleFramework\LIBRARY\DB
 */
class Redis implements DB
{
    private $_config;

    /**
     * 设置配置
     * @param $config
     * @param string $config_type
     */
    public
    function setConfig( $config, string $config_type = _Config::OBJECT )
    {
        $this->_config = ConfigLoader::parse( $config, $config_type );
    }

    public
    function cache( string $table_name, Instance $instance, int $life_cycle = 30 * 60 * 1000 )
    {

    }

    public
    function fetchById( string $table_name, $id )
    {

    }

    public
    function isExistById( string $table_name, $id )
    {

    }

    public
    function deleteById( string $table_name, $id )
    {

    }

    public
    function updateById( string $table_name, $id, array $data_array )
    {

    }
}