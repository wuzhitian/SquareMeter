<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: HttpApiClient.php
 * Create: 2018/4/12
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\CORE\CLIENT\HttpApiClient;

use UmbServer\SwooleFramework\COMPONENT\CORE\CLIENT\BASE\HttpClient;
use UmbServer\SwooleFramework\LIBRARY\FILESYSTEM\File;
use UmbServer\SwooleFramework\LIBRARY\UTIL\DataHandler;

use swoole_http_client;

/**
 * http(s) api客户端类
 * Class HttpApiClient
 * @package UmbServer\SwooleFramework\COMPONENT\CORE\CLIENT\HttpApiClient
 */
class HttpApiClient implements HttpClient
{
    private $_config; //配置
    private $_swoole_http_client; //内置swoole_http_client对象
    
    /**
     * 设置配置
     * @param HttpApiClientConfig $config
     */
    public
    function setConfig( HttpApiClientConfig $config )
    {
        $this->_config = $config;
    }
    
    /**
     * 获取配置
     * @return HttpApiClientConfig
     */
    private
    function getConfig(): HttpApiClientConfig
    {
        return $this->_config;
    }
    
    /**
     * 获取client对象
     * @return swoole_http_client
     */
    private
    function getSwooleHttpClient(): swoole_http_client
    {
        return $this->_swoole_http_client;
    }
    
    /**
     * 初始化
     */
    public
    function initial()
    {
        $this->initialSwooleHttpClient();
    }
    
    /**
     * 初始化SwooleHttpClient
     */
    public
    function initialSwooleHttpClient()
    {
        $this->_swoole_http_client = new swoole_http_client( $this->getConfig()->host, $this->getConfig()->port, $this->getConfig()->is_ssl );
        $this->_swoole_http_client->set( [
            'timeout'    => $this->getConfig()->timeout,
            'keep_alive' => $this->getConfig()->keep_alive,
        ] );
    }
    
    /**
     * 设置headers
     * @param array $headers
     */
    public
    function setHeaders( array $headers )
    {
        $this->getSwooleHttpClient()->setHeaders( $headers );
    }
    
    /**
     * 附加post文件
     * @param File $file
     */
    public
    function addFile( File $file )
    {
        $this->getSwooleHttpClient()->addFile( $file );
    }
    
    /**
     * get请求
     * @param string $request_uri
     * @param $params
     * @param callable $callback
     */
    public
    function get( string $request_uri, $params, callable $callback )
    {
        $params      = (array)$params;
        $request_url = DataHandler::urlEncode( $request_uri . http_build_query( $params ) );
        $this->getSwooleHttpClient()->get( $request_url, $callback );
    }
    
    /**
     * post请求
     * @param string $request_uri
     * @param $params
     * @param callable $callback
     */
    public
    function post( string $request_uri, $params, callable $callback )
    {
        $params = (array)$params;
        $this->getSwooleHttpClient()->post( $request_uri, $params, $callback );
    }
}