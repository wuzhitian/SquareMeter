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

/**
 * Class MySQL
 * @package UmbServer\SwooleFramework\LIBRARY\DB
 */
class MySQL implements DB
{
    private $_pdo_object; //内置pdo连接对象
    private $_config;

    public
    function constructor()
    {
        // TODO: Implement constructor() method.
    }

    public
    function connect()
    {
        // TODO: Implement connect() method.
    }

    public
    function disconnect()
    {
        // TODO: Implement disconnect() method.
    }

    public
    function isConnected(): bool
    {
        // TODO: Implement isConnected() method.
    }

    /**
     * 封装sql语句到execute方法，作为最后的执行方法
     * @param $sql
     * @return mixed
     */
    private
    function execute( $sql )
    {
        $this->connect();
        $statement = $this->_connect_object->prepare( $sql );
        $success   = $statement->execute();
        if ( !$success ) {
            $this->connect();
            $statement = $this->_connect_object->prepare( $sql );
            $success   = $statement->execute();
        }
        $res                   = $success;
        $this->_connect_object = null;
        return $res;
    }

    private
    function setConfig()
    {

    }

    private
    function setPdoObject()
    {
        $this->_pdo_object =
    }

    public
    function query()
    {

    }

    public
    function select()
    {

    }

    public
    function insert()
    {

    }

    public
    function getNextIntId()
    {

    }

    public
    function getTable()
    {

    }

    public
    function fetchById()
    {

    }

    public
    function deleteById()
    {
        // TODO: Implement deleteById() method.
    }

    public
    function updateById()
    {
        // TODO: Implement updateById() method.
    }

    public
    function softDeleteById()
    {
        // TODO: Implement softDeleteById() method.
    }
}