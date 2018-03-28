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
use UmbServer\SwooleFramework\LIBRARY\ENUM\_Serialize;
use UmbServer\SwooleFramework\LIBRARY\ERROR\Error;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\Instance;
use UmbServer\SwooleFramework\LIBRARY\UTIL\ConfigLoader;
use UmbServer\SwooleFramework\LIBRARY\UTIL\Console;
use UmbServer\SwooleFramework\LIBRARY\UTIL\Serialize;

/**
 * Class Redis
 * @package UmbServer\SwooleFramework\LIBRARY\DB
 */
class Redis implements DB
{
    private $_config;
    private $_connect_object; //php内置redis连接对象
    private $_is_connected = false;
    
    /**
     * 设置配置
     * @param $config
     * @param string $config_type
     */
    public
    function setConfig( $config, string $config_type = _Config::OBJECT )
    {
        $config = ConfigLoader::parse( $config, $config_type );
        $this->_config = new RedisConfig();
        $this->_config->host = $config->host;
        $this->_config->port = $config->port;
        $this->_config->password = $config->password;
        $this->_config->database_index = $config->database_index;
    }
    
    /**
     * 获取redis配置
     * @return RedisConfig
     */
    private function getConfig(): RedisConfig
    {
        return $this->_config;
    }
    
    /**
     * 获取redis连接对象
     * @return \Redis
     */
    private function getConnectObject(): \Redis
    {
        return $this->_connect_object;
    }
    
    /**
     * 连接
     * @return bool
     */
    public function connect(): bool
    {
        if ( $this->isConnected() ) {
            return false;
        }
        try {
            $this->_connect_object = new \Redis();
            $this->getConnectObject()->connect( $this->getConfig()->host, $this->getConfig()->port );
            $this->getConnectObject()->auth( $this->getConfig()->password );
            $this->getConnectObject()->select( $this->getConfig()->database_index );
            $this->_is_connected = true;
        } catch ( \RedisException $e ) {
            Console::log( "Redis connection failed!" );
            Console::log( $e->getMessage() );
        }
        return true;
    }
    
    /**
     * 断开连接
     * @return bool
     */
    public function disconnect(): bool
    {
        if ( $this->isConnected() === true ) {
            $this->getConnectObject()->close();
        }
        $this->_connect_object = NULL;
        $this->_is_connected = false;
        return true;
    }
    
    /**
     * 是否连接中
     * @return bool
     */
    public function isConnected(): bool
    {
        return $this->_is_connected;
    }
    
    /**
     * insert基本方法
     * @param string $table_name
     * @param Instance $instance
     * @return bool
     * @throws \UmbServer\SwooleFramework\LIBRARY\ERROR\UtilError
     */
    public
    function insert( string $table_name, Instance $instance ): bool
    {
        $this->connect();
        $data_array = (array)$instance->getDataBySchema();
        Console::log( 'redis serialize' );
        Console::log( $data_array );
        $encode_data = Serialize::encode( $data_array, _Serialize::UMB );
        $create_res = $this->getConnectObject()->hSetNx( $table_name, $instance->id, $encode_data );
        $res = (bool)$create_res;
        $this->disconnect();
        return $res;
    }
    
    /**
     * 获取指定表下一个整型id
     * @param string $table_name
     * @return int
     */
    public function getNextIntId( string $table_name ): int
    {
        $this->connect();
        $length = $this->getConnectObject()->hLen( $table_name );
        $res = $length + 1;
        $this->disconnect();
        return $res;
    }
    
    /**
     * 获取表
     * @param string $table_name
     * @return array
     */
    public function getTable( string $table_name ): array
    {
        $this->connect();
        $res = $this->getConnectObject()->hGetAll( $table_name );
        $this->disconnect();
        return $res;
    }
    
    /**
     * 根据id查询数据
     * @param string $table_name
     * @param $id
     * @return array
     * @throws Error
     * @throws \UmbServer\SwooleFramework\LIBRARY\ERROR\UtilError
     */
    public
    function fetchById( string $table_name, $id ): array
    {
        $this->connect();
        $is_exist = $this->getConnectObject()->hExists( $table_name, $id );
        if ( !$is_exist ) {
            throw new Error( Error::UNKNOWN_ERROR );
        }
        $encode_data = $this->getConnectObject()->hGet( $table_name, $id );
        $res = (array)Serialize::decode( $encode_data, _Serialize::UMB );
        Console::log( $res );
        $this->disconnect();
        return $res;
    }
    
    /**
     * 在table中指定id是否存在
     * @param string $table_name
     * @param $id
     * @return bool
     */
    public
    function isExistById( string $table_name, $id ): bool
    {
        $this->connect();
        $res = (bool)$this->getConnectObject()->hExists( $table_name, $id );
        $this->disconnect();
        return $res;
    }
    
    /**
     * 根据id删除数据
     * @param string $table_name
     * @param $id
     * @return bool
     */
    public
    function deleteById( string $table_name, $id ): bool
    {
        $this->connect();
        $delete_res = $this->getConnectObject()->hDel( $table_name, $id );
        if ( $delete_res > 0 ) {
            $res = $id;
        } else {
            $res = false;
        }
        $this->disconnect();
        return $res;
    }
    
    /**
     * 根据id更新数据
     * @param string $table_name
     * @param $id
     * @param Instance $instance
     * @return bool
     * @throws \UmbServer\SwooleFramework\LIBRARY\ERROR\UtilError
     */
    public
    function updateById( string $table_name, $id, Instance $instance ): bool
    {
        $this->connect();
        $data_array = (array)$instance->getDataBySchema();
        Console::log( 'redis serialize' );
        Console::log( $data_array );
        $encode_data = Serialize::encode( $data_array, _Serialize::UMB );
        $update_res = $this->getConnectObject()->hSet( $table_name, $id, $encode_data );
        if ( $update_res > 0 ) {
            $res = true;
        } else {
            $res = false;
        }
        $this->disconnect();
        return $res;
    }
}