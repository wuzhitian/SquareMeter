<?php declare( strict_types = 1 );
/**
 * Project: SMBCMiddletier
 * File: SMBCBusinessHost.php
 * Create: 2018/3/30
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMBCMiddletier\MODEL\DATA;

use UmbServer\SwooleFramework\COMPONENT\CORE\CLIENT\HttpApiClient\HttpApiClient;
use UmbServer\SwooleFramework\LIBRARY\COMMON_MODEL\Host;
use UmbServer\SwooleFramework\LIBRARY\ENUM\_Config;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\InstanceTrait;
use UmbServer\SwooleFramework\LIBRARY\UTIL\Time;

/**
 * SMBC业务主机类
 * Class SMBCBusinessHost
 * @package SMBCMiddletier\MODEL\DATA
 */
class SMBCBusinessHost extends Host
{
    use InstanceTrait;

    const TABLE_NAME = 'SMBCBusinessHost'; //表名

    const SCHEMA
        = [
            'name'                         => STRING_TYPE,
            'ip'                           => STRING_TYPE,
            'domain'                       => STRING_TYPE,
            'node_server_listen_port'      => INT_TYPE,
            'response_time_span'           => INT_TYPE,
            'last_heartbeat_timestamp'     => TIMESTAMP_TYPE,
            'last_access_timestamp'        => TIMESTAMP_TYPE,
            'last_access_smbc_operator_id' => STRING_TYPE,
            'is_free'                      => BOOL_TYPE,
        ];

    public $node_server_listen_port; //node server监听端口号
    public $response_time_span; //响应时长ms
    public $last_heartbeat_timestamp; //最后一次心跳检测时间戳
    public $last_access_timestamp; //最后一次访问的时间戳
    public $last_access_smbc_operator_id; //最后一次请求的用户id
    public $is_free = true; //是否忙碌

    /**
     * 设置最后一次请求
     * @param SMBCAccount $operator
     */
    public
    function setLastAccess( SMBCAccount $operator )
    {
        $this->last_access_smbc_operator_id = $operator->id;
        $this->last_heartbeat_timestamp     = Time::getNow();
//        $this->update( false );
    }

    /**
     * 置忙闲
     * @param bool $is_free
     */
    public
    function setIsFree( bool $is_free = true )
    {
        $this->is_free = $is_free;
    }

    /**
     * 获取业务机的api访问客户端
     * @return HttpApiClient
     */
    public
    function getHttpApiClient(): HttpApiClient
    {
        $config          = new \stdClass();
        $config->host    = $this->getHostAccessString();
        $config->port    = $this->node_server_listen_port;
        $http_api_client = new HttpApiClient();
        $http_api_client->loadConfig( $config, _Config::OBJECT );
        return $http_api_client;
    }

    /**
     * 重写get
     * @param string $request_uri
     * @param null $params
     * @param bool $is_ssl
     * @param null $header
     * @param int $timeout
     * @return \stdClass
     */
    public
    function get( string $request_uri, $params = NULL, bool $is_ssl = false, $header = NULL, int $timeout = 30 )
    {
        $this->setIsFree( false );
        $res = parent::_get( $request_uri, $this->node_server_listen_port, $params, $is_ssl, $header, $timeout ); // TODO: Change the autogenerated stub
        $this->setIsFree( true );
        return $res;
    }

    /**
     * 重写post
     * @param string $request_uri
     * @param null $params
     * @param bool $is_ssl
     * @param null $header
     * @param int $timeout
     * @return \stdClass
     */
    public
    function post( string $request_uri, $params = NULL, bool $is_ssl = false, $header = NULL, int $timeout = 30 )
    {
        $this->setIsFree( false );
        $res = parent::_post( $request_uri, $this->node_server_listen_port, $params, $is_ssl, $header, $timeout ); // TODO: Change the autogenerated stub
        $this->setIsFree( true );
        return $res;
    }

    /**
     * 重写jsonPost
     * @param string $request_uri
     * @param null $params
     * @param bool $is_ssl
     * @param null $header
     * @param int $timeout
     * @return \stdClass
     */
    public
    function jsonPost( string $request_uri, $params = NULL, bool $is_ssl = false, $header = NULL, int $timeout = 30 )
    {
        $this->setIsFree( false );
        $res = parent::_jsonPost( $request_uri, $this->node_server_listen_port, $params, $is_ssl, $header, $timeout ); // TODO: Change the autogenerated stub
        $this->setIsFree( true );
        return $res;
    }
}