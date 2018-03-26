<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: Visitor.php
 * Create: 2018/3/26
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\VISITOR;

use UmbServer\SwooleFramework\COMPONENT\CLIENT\Client;
use UmbServer\SwooleFramework\COMPONENT\CLIENT\HttpClient;
use UmbServer\SwooleFramework\COMPONENT\CLIENT\TCPClient;
use UmbServer\SwooleFramework\LIBRARY\ENUM\_Config;
use UmbServer\SwooleFramework\LIBRARY\ENUM\_VisitorConnectMode;
use UmbServer\SwooleFramework\LIBRARY\UTIL\ConfigLoader;

/**
 * 微服务框架组件访问器
 * Class Visitor
 * @package UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\VISITOR
 */
class Visitor
{
    private $_config; //配置
    private $_client; //内置客户端对象

    private $_connect_mode  = _VisitorConnectMode::HTTP; //连接模式
    private $_is_keep_alive = false; //是否为长连接
    private $_host; //主机
    private $_port; //端口号
    private $_is_ssl        = false; //是否https

    private $_is_connected = false;

    /**
     * 设置配置
     * @param $config
     * @param string $config_file_type
     */
    public
    function setConfig( $config, $config_file_type = _Config::JSON )
    {
        $this->_config = ConfigLoader::parse( $config, $config_file_type );
        if ( isset( $this->getConfig()->connect_mode ) ) {
            $this->_connect_mode = $this->getConfig()->connect_mode;
        }
        if ( isset( $this->getConfig()->is_keep_alive ) ) {
            $this->_is_keep_alive = $this->getConfig()->is_keep_alive;
        }
        $this->_host   = $this->getConfig()->host;
        $this->_port   = $this->getConfig()->port;
        $this->_is_ssl = $this->getConfig()->is_ssl;
    }

    /**
     * 获取内置客户端对象
     * @return Client
     */
    private
    function getClient(): Client
    {
        return $this->_client;
    }

    /**
     * 初始化内置客户端
     */
    public
    function initial()
    {
        switch ( $this->_connect_mode ) {
            case _VisitorConnectMode::TCP:
                $client = new TCPClient();
                break;
            case _VisitorConnectMode::HTTP:
            default:
                $client = new HttpClient();
        }
        $this->resetClient();
        $this->_client = $client;
    }

    /**
     * 获取配置
     * @return mixed
     */
    private
    function getConfig()
    {
        return $this->_config;
    }

    /**
     * 连接
     */
    public
    function connect(): bool
    {
        $res = $this->getClient()->connect();
        return $res;
    }

    private
    function disconnect(): bool
    {
        $res = $this->getClient()->disconnect();
        return $res;
    }

    /**
     * 重置客户端
     */
    private
    function resetClient()
    {
        $this->_client = NULL;
    }

    /**
     * 初始化http客户端
     */
    private
    function initialHttpClient()
    {

    }

    /**
     * 初始化tcp客户端
     */
    private
    function initialTCPClient()
    {
        if ( $this->isConnected() ) {
            $this->disConnect();
            $this->resetClient();
        }
        $this->_client     = new TCPClient();
        $tcp_client_config = [

        ];
        $this->_client->setConfig( $tcp_client_config, _Config::ARRAY );
        $this->_client->initial();
    }

    /**
     * 是否连接
     * @return bool
     */
    private
    function isConnected(): bool
    {
        return $this->_is_connected;
    }

    /**
     * 发送请求
     * @param string $request_uri
     * @param string $encode_params
     */
    private
    function request( string $request_uri, string $encode_params )
    {

    }
}