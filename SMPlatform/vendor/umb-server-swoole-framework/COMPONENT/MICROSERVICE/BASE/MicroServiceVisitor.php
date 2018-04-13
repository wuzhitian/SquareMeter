<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: MicroServiceVisitor.php
 * Create: 2018/3/26
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\BASE;

use UmbServer\SwooleFramework\COMPONENT\CORE\CLIENT\BASE\HttpClientRequest;
use UmbServer\SwooleFramework\COMPONENT\CORE\CLIENT\ENUM\_Client;
use UmbServer\SwooleFramework\COMPONENT\CORE\CLIENT\HttpApiClient\HttpApiClient;
use UmbServer\SwooleFramework\COMPONENT\CORE\CLIENT\HttpApiClient\HttpApiClientConfig;
use UmbServer\SwooleFramework\COMPONENT\CORE\CLIENT\HttpApiClient\HttpApiClientRequest;
use UmbServer\SwooleFramework\COMPONENT\CORE\CLIENT\TcpAsyncTaskClient\TcpAsyncTaskClient;
use UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\ENUM\_MicroServiceVisitor;
use UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\SERVICE\BASE\MicroServiceVisitorConfig;
use UmbServer\SwooleFramework\LIBRARY\ENUM\_Config;
use UmbServer\SwooleFramework\LIBRARY\ENUM\_HttpRequestVerb;
use UmbServer\SwooleFramework\LIBRARY\UTIL\ConfigLoader;

/**
 * 微服务框架组件访问器
 * Class MicroServiceVisitor
 * @package UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\BASE
 */
class MicroServiceVisitor
{
    private $_config; //配置
    private $_client; //内置客户端对象
    private $_is_tcp_connected = false; //tcp是否连接
    private $_type = _MicroServiceVisitor::HTTP_API_SERVICE_VISITOR; //访问器类型
    
    /**
     * 设置配置
     * @param $config
     */
    public
    function setConfig( $config )
    {
        $this->_config = $config;
    }
    
    /**
     * 获取配置
     * @return MicroServiceVisitorConfig
     */
    private
    function getConfig(): MicroServiceVisitorConfig
    {
        return $this->_config;
    }
    
    /**
     * 获取TcpAsyncTask客户端
     * @return TcpAsyncTaskClient
     */
    private
    function getTcpAsyncTaskClient(): TcpAsyncTaskClient
    {
        return $this->_client;
    }
    
    /**
     * 获取HttpApi客户端
     * @return HttpApiClient
     */
    private
    function getHttpApiClient(): HttpApiClient
    {
        return $this->_client;
    }
    
    /**
     * 获取visitor类型
     * @return string
     */
    protected
    function getType(): string
    {
        return $this->_type;
    }
    
    /**
     * 初始化
     */
    public
    function initial()
    {
        $this->initialClient();
    }
    
    /**
     * 初始化客户端
     */
    private
    function initialClient()
    {
        switch ( $this->getType() ) {
            case _MicroServiceVisitor::TCP_ASYNC_TASK_SERVICE_VISITOR:
                $this->initialTcpAsyncTaskClient();
                break;
            case _MicroServiceVisitor::HTTP_API_SERVICE_VISITOR:
            default:
                $this->initialHttpApiClient();
        }
    }
    
    /**
     * 初始化TcpAsyncTaskClient
     */
    private
    function initialTcpAsyncTaskClient()
    {
        $this->_client = new TcpAsyncTaskClient();
    }
    
    /**
     * 初始化HttpApiClient
     */
    private
    function initialHttpApiClient()
    {
        $config        = new HttpApiClientConfig( $this->getConfig()->getConfigData(), _Config::OBJECT );
        $this->_client = new HttpApiClient();
        $this->_client->setConfig( $config );
        $this->_client->initial();
    }
    
    /**
     * 是否连接
     * @return bool
     */
    private
    function isTcpConnected(): bool
    {
        return $this->_is_tcp_connected;
    }
    
    /**
     * 发送http_api_client请求
     * @param HttpApiClientRequest $http_client_request
     */
    private
    function httpApiRequest( HttpApiClientRequest $http_api_client_request, callable $callback )
    {
        $verb = $http_api_client_request->verb;
        switch ( $verb ) {
            case _HttpRequestVerb::GET:
                $this->getHttpApiClient()->get( $http_api_client_request->request_uri, $http_api_client_request->params, $callback );
                break;
            case _HttpRequestVerb::POST:
            default:
                $this->getHttpApiClient()->post( $http_api_client_request->request_uri, $http_api_client_request->params, $callback );
        }
    }
    
    /**
     * 请求
     * @param $request
     * @param $callback
     */
    public
    function request( $request, $callback )
    {
        switch ( $this->getType() ) {
            case _MicroServiceVisitor::HTTP_API_SERVICE_VISITOR:
                $this->httpApiRequest( $request, $callback );
                break;
            case _MicroServiceVisitor::TCP_ASYNC_TASK_SERVICE_VISITOR:
            default:
        }
    }
}