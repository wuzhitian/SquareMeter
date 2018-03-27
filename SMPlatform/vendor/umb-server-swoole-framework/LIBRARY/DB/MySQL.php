<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: MySQL.php
 * Create: 2018/3/9
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\DB;

use UmbServer\SwooleFramework\LIBRARY\ENUM\_Config;
use UmbServer\SwooleFramework\LIBRARY\UTIL\ConfigLoader;
use UmbServer\SwooleFramework\LIBRARY\UTIL\Console;
use UmbServer\SwooleFramework\LIBRARY\UTIL\DataHandler;

/**
 * Class MySQL
 * @package UmbServer\SwooleFramework\LIBRARY\DB
 */
class MySQL implements DB
{
    private $_config;
    private $_PDO          = NULL; //内置pdo连接对象
    private $_is_connected = false;

    /**
     * 设置配置
     * @param $config
     * @param string $config_type
     */
    public
    function setConfig( $config, string $config_type = _Config::OBJECT )
    {
        $config                  = ConfigLoader::parse( $config, $config_type );
        $this->_config           = new MySQLConfig();
        $this->_config->host     = $config->host;
        $this->_config->port     = $config->port;
        $this->_config->username = $config->username;
        $this->_config->password = $config->password;
        $this->_config->database = $config->database;
    }

    /**
     * 获取mysql配置
     * @return MySQLConfig
     */
    private
    function getConfig(): MySQLConfig
    {
        return $this->_config;
    }

    /**
     * 连接
     * @return bool
     */
    public
    function connect()
    {
        if ( $this->isConnected() ) {
            return false;
        }
        $dsn = 'mysql:dbname=' . $this->getConfig()->database . ';host=' . $this->getConfig()->host . ';port=' . $this->getConfig()->port;
        try {
            $this->disconnect();
            $this->_PDO          = new \PDO( $dsn, $this->getConfig()->username, $this->getConfig()->password, [
                \PDO::ATTR_PERSISTENT         => true,
                \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8';",
            ] );
            $this->_is_connected = true;
        }
        catch ( \PDOException $e ) {
            Console::log( "MySQL connection failed!" );
            Console::log( $e->getMessage() );
        }
        return true;
    }

    /**
     * 断开连接
     */
    public
    function disconnect()
    {
        $this->_PDO          = NULL;
        $this->_is_connected = false;
    }

    /**
     * 是否连接中
     * @return bool
     */
    public
    function isConnected(): bool
    {
        return $this->_is_connected;
    }

    /**
     * 获取PDO对象
     * @return \PDO
     */
    private
    function getPDO(): \PDO
    {
        return $this->_PDO;
    }

    /**
     * 封装sql语句到execute方法，作为最后的执行方法
     * @param $sql
     * @return mixed
     */
    private
    function execute( $sql )
    {
        $this->disconnect();
        $this->connect();
        $statement = $this->getPDO()->prepare( $sql );
        $success   = $statement->execute();
        if ( !$success ) {
            $this->connect();
            $statement = $this->getPDO()->prepare( $sql );
            $success   = $statement->execute();
        }
        $res = $success;
        return $res;
    }

    /**
     * 封装sql语句到select方法，作为最后的查询方法
     * @param $sql
     * @return mixed
     */
    private
    function select( $sql )
    {
        $this->disconnect();
        $this->connect();
        $statement = $this->getPDO()->prepare( $sql );
        $success   = $statement->execute();
        if ( !$success ) {
            $this->connect();
            $statement = $this->getPDO()->prepare( $sql );
            $success   = $statement->execute();
        }
        $res = $statement->fetchAll( \PDO::FETCH_ASSOC );
        return $res;
    }

    /**
     * fetch基本方法
     * @param $sql
     * @return mixed
     */
    public
    function fetch( $sql )
    {
        $res = $this->select( $sql )[ 0 ];
        return $res;
    }

    /**
     * insert基本方法
     * @param string $table_name
     * @param $id
     * @return bool|string
     */
    public
    function insert( string $table_name, $id )
    {
        $sql     = 'INSERT INTO ' . $table_name . ' (id) VALUES (' . DataHandler::quotation( $id ) . ')';
        $success = $this->execute( $sql );
        if ( $success ) {
            $res = $this->getPDO()->lastInsertId();
        } else {
            $res = false;
        }
        return $res;
    }

    /**
     * 获取指定表下一个整型id
     * @param string $table_name
     * @return int
     */
    public
    function getNextIntId( string $table_name )
    {
        $sql = 'SELECT max(id) as `next_id` FROM ' . $table_name;
        $res = $this->fetch( $sql )[ 'next_id' ] + 1;
        return $res;
    }

    /**
     * 获取表
     * @param string $table_name
     * @return mixed
     */
    public
    function getTable( string $table_name )
    {
        $sql = 'SELECT * FROM ' . $table_name;
        $res = $this->select( $sql );
        return $res;
    }

    /**
     * 根据id查询数据
     * @param string $table_name
     * @param $id
     * @return mixed
     */
    public
    function fetchById( string $table_name, $id )
    {
        $sql = 'SELECT * FROM ' . $table_name . ' WHERE id=' . DataHandler::quotation( $id );
        $res = $this->fetch( $sql );
        return $res;
    }

    /**
     * 根据id删除数据
     * @param string $table_name
     * @param $id
     * @return mixed
     */
    public
    function deleteById( string $table_name, $id )
    {
        $sql = 'DELETE FROM ' . $table_name . ' WHERE id=' . DataHandler::quotation( $id );
        $res = $this->execute( $sql );
        return $res;
    }

    /**
     * 根据id更新数据
     * @param string $table_name
     * @param $id
     * @param array $data_array
     * @return bool|mixed
     */
    public
    function updateById( string $table_name, $id, array $data_array )
    {
        if ( empty( $data_array ) ) {
            return false;
        }
        $head = 'UPDATE ' . $table_name . ' SET ';
        $body = '';
        foreach ( $data_array as $key => $value ) {
            if ( $key == 'id' || $value === NULL || !isset( $value ) ) { //跳过id不执行，id不能改变，如果$value为NULL也不考虑
                continue;
            }
            $body .= $key . '=' . DataHandler::quotation( $value ) . ',';
        }
        $body = substr( $body, 0, -1 ); //去掉最后一个逗号
        $rear = ' WHERE id=' . DataHandler::quotation( $id );
        $sql  = $head . $body . $rear;
        Console::log( $sql );
        $res = $this->execute( $sql );
        return $res;
    }
}