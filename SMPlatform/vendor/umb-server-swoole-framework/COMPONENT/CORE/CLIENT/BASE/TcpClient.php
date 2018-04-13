<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: TcpClient.php
 * Create: 2018/4/12
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\CORE\CLIENT\BASE;

/**
 * tcp客户端接口类
 * Interface TcpClient
 * @package UmbServer\SwooleFramework\COMPONENT\CORE\CLIENT\BASE
 */
interface TcpClient extends Client
{
    private $_client; //swoole_http_client对象
    private $_config; //配置
    
    private $_extra_data; //附加数据
    
    /**
     * 根据配置设置客户端对象
     */
    private
    function setClient()
    {
        $this->_client = new swoole_http_client( $this->getConfig()->host, $this->getConfig()->listen_port, $this->getConfig()->is_ssl );
    }
    
    /**
     * 获取
     * @return swoole_http_client
     */
    private
    function getClient(): swoole_http_client
    {
        return $this->_client;
    }
    
    /**
     * 初始化客户端
     */
    public
    function initial()
    {
        $this->setClient();
        $this->set();
    }
    
    /**
     * 执行设置
     */
    private
    function set()
    {
        $set = [
            'timeout'    => $this->getConfig()->timeout,
            'keep_alive' => $this->getConfig()->keep_alive,
        ];
        $this->getClient()->set( $set );
    }
    
    /**
     * 设置配置
     * @param array $config
     * @param string $config_file_type
     */
    public
    function setConfig( $config, $config_file_type = _Config::ARRAY )
    {
        $this->_config = new HttpClientConfig();
        $this->getConfig()->setByConfig( $config, $config_file_type );
    }
    
    /**
     * 获取config
     * @return HttpClientConfig
     */
    public
    function getConfig(): HttpClientConfig
    {
        return $this->_config;
    }
    
    /**
     * 获取extra_data
     * @return mixed
     */
    public
    function getExtraData()
    {
        return $this->_extra_data;
    }
    
    /**
     * 设置额外的数据
     * @param null $extra_data
     */
    public
    function setExtraData( $extra_data = NULL )
    {
        $this->_extra_data = $extra_data;
    }
    
    public
    function request( string $request_uri, string $verb, string $method, object $params, callable $callback )
    {
        switch ( $verb ) {
            case _HttpRequestVerb::POST:
                $this->getClient()->post( $request_uri, $params, $callback );
                break;
            case _HttpRequestVerb::GET:
            default:
                $request_string = DataHandler::urlEncode( $request_uri, $params );
                $this->getClient()->get( $request_string, $callback );
        }
    }
    
    public
    function connect(): bool
    {
        // TODO: Implement connect() method.
    }
    
    public
    function disconnect(): bool
    {
        // TODO: Implement disconnect() method.
    }
}