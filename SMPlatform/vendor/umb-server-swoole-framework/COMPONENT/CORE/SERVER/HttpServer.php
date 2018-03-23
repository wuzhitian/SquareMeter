<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: HttpServer.php
 * Create: 2018/3/23
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\SERVER;

use swoole_http_request;
use swoole_http_response;
use UmbServer\SwooleFramework\COMPONENT\SERVER\CONFIG\HttpServerConfig;

/**
 * http服务器接口类
 * Interface HttpServer
 * @package UmbServer\SwooleFramework\COMPONENT\SERVER
 */
interface HttpServer extends Server
{
    /**
     * 设置
     * @param $config
     * @param $config_file_type
     * @return mixed
     */
    public
    function setConfig( $config, $config_file_type );

    /**
     * 获取http_server配置
     * @return HttpServerConfig
     */
    public
    function getConfig(): HttpServerConfig;

    /**
     * 初始化
     * @return mixed
     */
    public
    function initial();

    /**
     * 设置额外数据
     * @param null $extra_data
     * @return mixed
     */
    public
    function setExtraData( $extra_data = NULL );

    /**
     * 获取额外数据
     * @return mixed
     */
    public
    function getExtraData();

    /**
     * 收到http_request以后的回调
     * @param swoole_http_request $request
     * @param swoole_http_response $response
     * @return mixed
     */
    public
    function onRequest( swoole_http_request $request, swoole_http_response $response );

    /**
     * 启动server
     * @return mixed
     */
    public
    function start();
}