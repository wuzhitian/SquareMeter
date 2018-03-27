<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: LocalDataCenter.php
 * Create: 2018/3/27
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\DATA;

use UmbServer\SwooleFramework\LIBRARY\DB\MySQL;
use UmbServer\SwooleFramework\LIBRARY\DB\Redis;
use UmbServer\SwooleFramework\LIBRARY\ENUM\_Config;
use UmbServer\SwooleFramework\LIBRARY\ENUM\_DB;
use UmbServer\SwooleFramework\LIBRARY\ENUM\_ID;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\Instance;
use UmbServer\SwooleFramework\LIBRARY\UTIL\ConfigLoader;
use UmbServer\SwooleFramework\LIBRARY\UTIL\Generator;

/**
 * 本地实例管理中心
 * Class LocalDataCenter
 * @package UmbServer\SwooleFramework\LIBRARY\DATA
 */
class LocalDataCenter
{
    private $_config;

    private $_redis;
    private $_mysql;

    //构建单例
    /************************************************************/
    private static $_instance;

    private
    function __construct()
    {
    }

    private
    function __clone()
    {
    }

    public static
    function getInstance(): self
    {
        if ( !( self::$_instance instanceof self ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /************************************************************/

    /**
     * 设置配置
     * @param $config
     * @param string $config_type
     */
    public
    function setConfig( $config, $config_type = _Config::JSON )
    {
        $config               = ConfigLoader::parse( $config, $config_type );
        $this->_config        = new DataCenterConfig();
        $this->_config->mysql = $config->mysql;
        $this->_config->redis = $config->redis;
    }

    /**
     * 获取配置
     * @return DataCenterConfig
     */
    private
    function getConfig(): DataCenterConfig
    {
        return $this->_config;
    }

    /**
     * 初始化数据中心
     */
    public
    function initial()
    {
        $this->initialRedis();
        $this->initialMySQL();
    }

    /**
     * 初始化Redis
     */
    private
    function initialRedis()
    {
        $this->_redis = new Redis();
        $redis_config = $this->getConfig()->redis;
        $this->_redis->setConfig( $redis_config, _Config::OBJECT );
    }

    /**
     * 初始化MySQL
     */
    private
    function initialMySQL()
    {
        $this->_mysql = new MySQL();
        $mysql_config = $this->getConfig()->mysql;
        $this->_mysql->setConfig( $mysql_config, _Config::OBJECT );
    }

    /**
     * 获得redis对象
     * @return Redis
     */
    private
    function getRedis(): Redis
    {
        return $this->_redis;
    }

    /**
     * 获得mysql对象
     * @return MySQL
     */
    private
    function getMySQL(): MySQL
    {
        return $this->_mysql;
    }

    /**
     * 获取持久层数据库对象
     * @param Instance $instance
     * @return MySQL
     */
    private
    function getPersistenceDB( Instance $instance )
    {
        $persistence_db = get_class( $instance )::PERSISTENCE;
        switch ( $persistence_db ) {
            case _DB::MYSQL:
            default:
                $res = $this->getMySQL();
        }
        return $res;
    }

    /**
     * 获取缓存层数据库对象
     * @param Instance $instance
     * @return Redis
     */
    private
    function getCacheDB( Instance $instance )
    {
        $cache_db = get_class( $instance )::PERSISTENCE;
        switch ( $cache_db ) {
            case _DB::REDIS:
            default:
                $res = $this->getRedis();
        }
        return $res;
    }

    /**
     * 创建实例至数据库，只考虑持久层
     * @param Instance $instance
     * @return Instance
     */
    public
    function createInstance( Instance $instance ): Instance
    {
        $persistence_db = $this->getPersistenceDB( $instance );
        $table_name     = $instance->getTableName();
        //处理id问题
        switch ( $instance->getIdRule() ) {
            case _ID::UUID:
                $instance->id = Generator::uuid();
                break;
            case _ID::AUTO_INCREASE:
            default:
                $instance->id = $persistence_db->getNextIntId( $table_name );
        }
        $persistence_db->insert( $table_name, $instance->id );
        $persistence_db->updateById( $table_name, $instance->id, (array)$instance->getDataBySchema() );
        $res = $instance;
        return $res;
    }

    /**
     * 更新实例，先考虑持久层，再考虑缓存层
     * @param Instance $instance
     * @return bool
     */
    public
    function updateInstance( Instance $instance ): bool
    {
        $persistence_db = $this->getPersistenceDB( $instance );
        $cache_db       = $this->getCacheDB( $instance );
        $table_name     = $instance->getTableName();
        try {
            $persistence_db->updateById( $table_name, $instance->id, (array)$instance->getDataBySchema( ) );
            $cache_db->updateById( $table_name, $instance->id, (array)$instance->getDataBySchema() );
            $res = true;
        }
        catch ( \Exception $e ) {
            $res = false;
        }
        return $res;
    }

    /**
     * 读取实例，先考虑缓存层，不存在则考虑持久层，并向缓存层存储
     * @param Instance $instance
     * @return Instance
     */
    public
    function readInstance( Instance $instance ): Instance
    {
        $persistence_db = $this->getPersistenceDB( $instance );
        $cache_db       = $this->getCacheDB( $instance );
        $table_name     = $instance->getTableName();
        try {
            $query_res = $cache_db->fetchById( $table_name, $instance->id );
        }
        catch ( \Exception $e ) {
            $query_res = $persistence_db->fetchById( $table_name, $instance->id );
            $cache_db->cache( $table_name, $instance, 30 * 60 * 1000 );
        }
        $instance_class = get_class( $instance );
        $res            = new $instance_class();
        $res->setData( $query_res );
        return $res;
    }

    /**
     * 删除实例，先处理持久层，再处理缓存层
     * @param Instance $instance
     * @return bool
     */
    public
    function deleteInstance( Instance $instance ): bool
    {
        $persistence_db = $this->getPersistenceDB( $instance );
        $cache_db       = $this->getCacheDB( $instance );
        $table_name     = $instance->getTableName();
        try {
            $persistence_db->deleteById( $table_name, $instance->id );
            $cache_db->deleteById( $table_name, $instance->id );
            $res = true;
        }
        catch ( \Exception $e ) {
            $res = false;
        }
        return $res;
    }
}