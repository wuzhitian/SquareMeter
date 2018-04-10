<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: BusinessHost.php
 * Create: 2018/3/30
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\MIDDLETIER\MODEL\DATA;

use UmbServer\SwooleFramework\COMPONENT\CLIENT\HttpClient;
use UmbServer\SwooleFramework\COMPONENT\CORE\CLIENT\CONFIG\HttpClientConfig;
use UmbServer\SwooleFramework\LIBRARY\COMMON_MODEL\Host;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\InstanceTrait;

/**
 * SMBC业务主机类
 * Class SMBCBusinessHost
 * @package SMPlatform\MIDDLETIER\MODEL\DATA
 */
class SMBCBusinessHost extends Host
{
    use InstanceTrait;

    const TABLE_NAME = 'SUMBBusinessHost'; //表名

    const SCHEMA
        = [
            'name'                     => STRING_TYPE,
            'ip'                       => STRING_TYPE,
            'domain'                   => STRING_TYPE,
            'node_server_listen_port'  => INT_TYPE,
            'response_time_span'       => INT_TYPE,
            'last_heartbeat_timestamp' => TIMESTAMP_TYPE,
            'is_active'                => BOOL_TYPE,
        ];

    public $node_server_listen_port; //node server监听端口号
    public $response_time_span; //响应时长ms
    public $last_heartbeat_timestamp; //最后一次心跳检测时间戳
    public $is_active; //是否为活动状态

    /**
     * 是否为活动状态
     * @return bool
     */
    public
    function isActive(): bool
    {
        return $this->is_active;
    }

    /**
     * 获取http_client
     * @return HttpClient
     */
    private
    function getHttpClient(): HttpClient
    {
        $http_client  = new HttpClient();
        $config       = new HttpClientConfig();
        $config->host = $this->ip;
        $config->port = $this->node_server_listen_port;
        $http_client->setConfig( $config );
    }

    public
    function heartBeat()
    {

    }
}