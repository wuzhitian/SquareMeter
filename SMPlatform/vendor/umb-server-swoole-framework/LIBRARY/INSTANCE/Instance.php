<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: Instance.php
 * Create: 2018/3/9
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\INSTANCE;

use UmbServer\SwooleFramework\COMPONENT\CORE\SERVER\HttpApiServer;
use UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\VISITOR\DataCenterVisitor;
use UmbServer\SwooleFramework\LIBRARY\DATA\LocalDataCenter;
use UmbServer\SwooleFramework\LIBRARY\ENUM\_ID;
use UmbServer\SwooleFramework\LIBRARY\ENUM\_InstanceBaseOperator;
use UmbServer\SwooleFramework\LIBRARY\ENUM\_InstanceMode;
use UmbServer\SwooleFramework\LIBRARY\ENUM\_DB;
use UmbServer\SwooleFramework\LIBRARY\UTIL\DataHandler;
use UmbServer\SwooleFramework\LIBRARY\UTIL\Time;
use UmbServer\SwooleFramework\MICROSERVICE\DataCenter;

/**
 * 实例基础类
 * Class Instance
 * @package UmbServer\SwooleFramework\MODEL\INSTANCE
 */
class Instance
{
    public $id; //所有实例都必须有id，可以是指定的、序号或是uuid
    public $create_timestamp;
    public $update_timestamp;

    const MODE              = _InstanceMode::LOCAL; //实例是否为本地实例，远程实例由DataCenter管理
    const DATA_CENTER_CLASS = DataCenter::class; //远程数据中心默认值

    const DEFAULT_SCHEMA
                      = [
            'id'               => STRING_TYPE,
            'create_timestamp' => TIMESTAMP_TYPE,
            'update_timestamp' => TIMESTAMP_TYPE,

        ]; //默认字段数据图谱
    const CACHE       = _DB::REDIS; //缓存方式，目前只可以选用null或redis或swoole_table
    const PERSISTENCE = _DB::MYSQL; //持久化方式，目前只可以选用null或mysql

    /**
     * 根据操作类型向request_handler的受影响实例池赋值
     * @param $operator
     */
    private
    function pushToInfluenceInstance( $operator )
    {
        HttpApiServer::getInstance()->getRequestHandler()->addInfluenceInstance( $operator, $this );
    }

    /**
     * 获取schema对象
     * @return object
     */
    private
    function getSchema(): object
    {
        $schema         = get_class( $this )::SCHEMA;
        $default_schema = self::DEFAULT_SCHEMA;
        //将default_schema中在schema里没有重写的字段类型赋值
        foreach ( $default_schema as $key => $type ) {
            if ( !array_key_exists( $key, $schema ) ) {
                $schema[ $key ] = $type;
            }
        }
        $res = $schema;
        return (object)$res;
    }

    /**
     * 获取id规则，(string)uuid | (int)auto_increase
     * @return string
     */
    public
    function getIdRule(): string
    {
        $type = $this->getSchema()->id;
        switch ( $type ) {
            case STRING_TYPE:
                $res = _ID::UUID;
                break;
            case INT_TYPE:
            default:
                $res = _ID::AUTO_INCREASE;
        }
        return $res;
    }

    /**
     * 根据schema获取数据对象
     * @return object
     */
    public
    function getDataBySchema(): object
    {
        $data_array = [];
        foreach ( $this->getSchema() as $key => $type ) {
            $value              = $this->$key;
            $data_array[ $key ] = DataHandler::typeConversion( $type, $value );
        }
        $res = (object)$data_array;
        return $res;
    }

    /**
     * 根据schema中要求的类型，给本实例属性重新赋值
     */
    private
    function checkDataBySchema()
    {
        foreach ( $this->getSchema() as $key => $type ) {
            $pre_value  = $this->$key;
            $value      = DataHandler::typeConversion( $type, $pre_value );
            $this->$key = $value;
        }
    }

    /**
     * 根据key获取schema中的type
     * @param $key
     * @return mixed
     */
    private
    function getTypeByKey( $key )
    {
        $res = $this->getSchema()->$key;
        return $res;
    }

    /**
     * 创建实例
     * 判断MODE，如果是Local，就在本地实例池创建，如果不是就在remoteDataCenter创建
     * 根据CACHE和PERSISTENCE决定缓存和持久化方式，通过remoteDataCenter实现
     * @param bool $is_push
     * @return Instance
     */
    public
    function create( $is_push = true )
    {
        $this->create_timestamp = Time::getNow();
        switch ( get_class( $this )::MODE ) {
            case _InstanceMode::LOCAL:
                $res = $this->localCreate();
                break;
            case _InstanceMode::REMOTE:
            default:
                $res = $this->remoteCreate();
        }
        if ( $is_push === true ) {
            $this->pushToInfluenceInstance( _InstanceBaseOperator::CREATE );
        }
        return $res;
    }

    /**
     * 读取实例
     * @param bool $is_push
     * @return Instance
     */
    public
    function read( $is_push = true )
    {
        switch ( get_class( $this )::MODE ) {
            case _InstanceMode::LOCAL:
                $res = $this->localRead();
                break;
            case _InstanceMode::REMOTE:
            default:
                $res = $this->remoteRead();
        }
        if ( $is_push === true ) {
            $this->pushToInfluenceInstance( _InstanceBaseOperator::READ );
        }
        return $res;
    }

    /**
     * 更新实例
     * @param bool $is_push
     * @return bool
     */
    public
    function update( $is_push = true )
    {
        $this->update_timestamp = Time::getNow();
        switch ( get_class( $this )::MODE ) {
            case _InstanceMode::LOCAL:
                $res = $this->localUpdate();
                break;
            case _InstanceMode::REMOTE:
            default:
                $res = $this->remoteUpdate();
        }
        if ( $is_push === true ) {
            $this->pushToInfluenceInstance( _InstanceBaseOperator::UPDATE );
        }
        return $res;
    }

    /**
     * 删除实例
     * @param bool $is_push
     * @return bool
     */
    public
    function delete( $is_push = true )
    {
        switch ( get_class( $this )::MODE ) {
            case _InstanceMode::LOCAL:
                $res = $this->localDelete();
                break;
            case _InstanceMode::REMOTE:
            default:
                $res = $this->remoteDelete();
        }
        if ( $is_push === true ) {
            $this->pushToInfluenceInstance( _InstanceBaseOperator::DELETE );
        }
        return $res;
    }

    /**
     * 本地实例创建
     * @return Instance
     */
    private
    function localCreate()
    {
        $res = LocalDataCenter::getInstance()->createInstance( $this );
        return $res;
    }

    /**
     * 远程实例创建
     * @return Instance
     */
    private
    function remoteCreate()
    {
        //远程实例的id问题交给data_center处理
        //远程实例的缓存层与持久层问题交给data_center处理
        $res = DataCenterVisitor::getInstance()->createInstance( $this );
        return $res;
    }

    /**
     * 本地读取实例
     * @return Instance
     */
    private
    function localRead()
    {
        $res = LocalDataCenter::getInstance()->readInstance( $this );
        return $res;
    }

    /**
     * 远程实例读取
     * @return Instance
     */
    private
    function remoteRead()
    {
        $res = DataCenterVisitor::getInstance()->readInstance( $this );
        return $res;
    }

    /**
     * 本地实例更新
     * @return bool
     */
    private
    function localUpdate()
    {
        $res = LocalDataCenter::getInstance()->updateInstance( $this );
        return $res;
    }

    /**
     * 远程实例更新
     * @return bool
     */
    private
    function remoteUpdate()
    {
        $res = DataCenterVisitor::getInstance()->updateInstance( $this );
        return $res;
    }

    /**
     * 本地实例删除
     * @return bool
     */
    private
    function localDelete()
    {
        $res = LocalDataCenter::getInstance()->deleteInstance( $this );
        return $res;
    }

    /**
     * 远程实例删除
     * @return bool
     */
    private
    function remoteDelete()
    {
        $res = DataCenterVisitor::getInstance()->deleteInstance( $this );
        return $res;
    }

    /**
     * 获取表名
     * @return string
     */
    public
    function getTableName(): string
    {
        $res = DataHandler::lastSegment( '\\', get_class( $this ) );
        return $res;
    }

    /**
     * 获取客户端实例池类名
     * @return string
     */
    public
    function getClientInstancePoolClassName(): string
    {
        $res = DataHandler::lastSegment( '\\', get_class( $this ) );
        return $res;
    }

    /**
     * 执行属性赋值
     * @param $data
     * @return object
     */
    public
    function setData( $data )
    {
        $data = (object)$data;
        foreach ( $data as $key => $value ) {
            if ( property_exists( get_class( $this ), $key ) ) {
                $this->$key = $value;
            }
        }
        $this->checkDataBySchema();
        $res = $this->getData();
        return $res;
    }

    /**
     * 获取实例数据，is_auth用于标记是否有auth授权
     * @param bool $is_auth
     * @return object
     */
    public
    function getData( $is_auth = false ): object
    {
        $res = $this->getDataBySchema();
        return $res;
    }
}