<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: RegisteredFrameworkService.php
 * Create: 2018/4/13
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\MODEL\DATA;

use UmbServer\SwooleFramework\LIBRARY\INSTANCE\Instance;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\InstanceTrait;

/**
 * 注册的框架服务类
 * Class RegisteredFrameworkService
 * @package UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\MODEL\DATA
 */
class RegisteredFrameworkService extends Instance
{
    use InstanceTrait;

    const HEALTH_RESPONSE_TIME_SPAN = 100; //ms

    const TABLE_NAME = 'RegisteredFrameworkService'; //表名

    const SCHEMA
        = [
            '$type'                    => STRING_TYPE,
            'registered_host_id'       => STRING_TYPE,
            'launch_config'            => OBJECT_TYPE,
            'access_count'             => INT_TYPE,
            'last_heartbeat_timestamp' => TIMESTAMP_TYPE,
            'is_free'                  => BOOL_TYPE,
            'is_health'                => BOOL_TYPE,
            'response_time_span'       => TIMESTAMP_TYPE,
        ];

    public $type; //服务名
    public $registered_host_id; //注册主机id
    public $launch_config; //启动配置
    public $access_count; //访问计数
    public $last_heartbeat_timestamp; //最后一次心跳检测时间戳
    public $is_free   = true; //是否空闲
    public $is_health = false; //是否健康
    public $response_time_span; //响应时长

    /**
     * 访问
     */
    public
    function access()
    {
        $this->access_count++;
        $this->update( false );
    }

    /**
     * 获取注册主机对象
     * @return RegisteredHost
     */
    private
    function getRegisteredHost(): RegisteredHost
    {
        $res = RegisteredHost::getById( $this->registered_host_id );
        return $res;
    }

    /**
     * 心跳
     * @param int $response_time_span
     */
    public
    function heartbeat( int $response_time_span )
    {
        $this->last_heartbeat_timestamp = Time::getNow();
        $this->response_time_span       = $response_time_span;
        $this->is_health                = $response_time_span < self::HEALTH_RESPONSE_TIME_SPAN;
        $this->update( false );
    }

    /**
     * 获取hos_access_string
     * @return string
     */
    public
    function getHostAccessString(): string
    {
        $res = $this->getRegisteredHost()->getHostAccessString();
        return $res;
    }
}