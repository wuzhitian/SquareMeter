<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: HttpApiServer.php
 * Create: 2018/3/12
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\CORE\SERVER;

use UmbServer\SwooleFramework\CORE\BASE\AOP;
use UmbServer\SwooleFramework\LIBRARY\TOOL\ConfigLoader;
use UmbServer\SwooleFramework\LIBRARY\ENUM\_Config;

/**
 * http(s)的api服务器
 * Class HttpApiServer
 * @package UmbServer\SwooleFramework\COMPONENT\CORE\SERVER
 */
class HttpApiServer
{
    const DEFAULT_CONFIG
        = [
            'name'        => 'HttpApiServer',
            'listen_ip'   => '127.0.0.1',
            'listen_port' => 9527,
            'is_ssl'      => false,
        ]; //默认配置

    private $_server; //swoole_http_server对象
    private $_config; //配置

    private $extra_data; //附加数据

    private $_this_request; //当次请求的对象暂存
    private $_this_response; //当次响应的对象暂存

    /**
     * 设置配置
     * @param array $config
     * @param string $config_file_type
     */
    public
    function setConfig( $config = self::DEFAULT_CONFIG, $config_file_type = _Config::ARRAY )
    {
        $this->_config = ConfigLoader::parse( $config, $config_file_type );
    }

    /**
     * 初始化服务器
     */
    public
    function initial()
    {
        $this->bindCallback();
        if ( $this->getConfig() )
            $this->_server = new \swoole_http_server( $this->_config[ 'listen_ip' ], $this->_config[ 'listen_port' ], SWOOLE_BASE, SWOOLE_SOCK_TCP );

    }

    /**
     * 获取当次请求
     * @return mixed
     */
    private
    function getThisRequest()
    {
        return $this->_this_request;
    }

    /**
     * 获取当次响应
     * @return mixed
     */
    private
    function getThisResponse()
    {
        return $this->_this_response;
    }

    /**
     * 设置当次请求
     * @param $this_request
     */
    private
    function setThisRequest( $this_request )
    {
        $this->_this_request = $this_request;
    }

    /**
     * 设置当次响应
     * @param $this_response
     */
    private
    function setThisResponse( $this_response )
    {
        $this->_this_response = $this_response;
    }

    /**
     * 获取内置server对象
     * @return \swoole_http_server
     */
    private
    function getServer()
    {
        return $this->_server;
    }

    /**
     * 获取config
     * @return object
     */
    private
    function getConfig(): object
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
        return $this->extra_data;
    }

    /**
     * 设置额外的数据
     * @param null $extra_data
     */
    public
    function setExtraData( $extra_data = NULL )
    {
        $this->extra_data = $extra_data;
    }

    /**
     * http2
     */
    public
    function setHttp2()
    {
        $this->set[ 'open_http2_protocol' ] = true;
    }

    /**
     * @param $cert_file_path
     * @param $key_file_path
     */
    public
    function setSSLFile( $cert_file_path, $key_file_path )
    {
        $this->set[ 'ssl_cert_file' ] = $cert_file_path;
        $this->set[ 'ssl_key_file' ]  = $key_file_path;
    }

    public
    function set()
    {
        $this->getServer()->set( $this->set );
    }

    /**
     * 绑定回调
     */
    public
    function bindCallback()
    {
        $this->getServer()->on( 'Start', [ $this, 'onStart' ] );
        $this->getServer()->on( 'Shutdown', [ $this, 'onShutdown' ] );
        $this->getServer()->on( 'Request', [ $this, 'onRequest' ] );
        $this->getServer()->on( 'WorkerStart', [ $this, 'onWorkerStart' ] );
    }

    /**
     * worker进程启动后的回调
     */
    public
    function onWorkerStart()
    {

    }

    /**
     * server主进程启动后的回调
     */
    public
    function onStart()
    {
        echo "onStart:: $this->_config[ 'name' ] Server started successfully.\n";
    }

    /**
     * server主进程关闭后的回调
     */
    public
    function onShutdown()
    {
        echo "onShutdown:: $this->_config[ 'name' ] Server stopped successfully.\n";
    }

    /**
     * 收到请求后的回调
     * @param $request
     * @param $response
     * @return bool
     */
    public
    function onRequest( $request, $response )
    {
        $this->setThisRequest( $request );
        $this->setThisResponse( $response );

        //拒绝不允许的请求
        $this->refuseNotAllowedRequest();

        // 把请求的path字符串拆分为数组，用array_filter去空
        $path_array = explode( '/', $request->server[ 'request_uri' ] );

        // 如果没有写控制器名称，默认为index
        $controller_name = $path_array[ sizeof( $path_array ) - 2 ] ?? 'index';
        $function_name   = $path_array[ sizeof( $path_array ) - 1 ];

        // 遍历controller和function的路径深度，组成$path
        $path = '';
        foreach ( $path_array as $key => $dir ) {
            if ( $key > sizeof( $path_array ) - 3 ) {
                break;
            }
            $path .= ( $dir . '/' );
        }

        $file_path = $this->config[ 'root' ] . $path . $controller_name . '.php';

        var_dump( $file_path );
        // 控制器不存在
        if ( !file_exists( $file_path ) ) {
            $this->notFound();
            return false;
        }

        // 加载控制器类controller
        include_once( $file_path );
        // var_dump($file_path);
        $controller = new AOP( new $controller_name, $request );
        $res        = $controller->$function_name();
        $response->header( 'Access-Control-Allow-Origin', '*' );
        $response->end( $res );
        return true;
    }

    /**
     * 启动server
     */
    public
    function start()
    {
        $this->getServer()->start();
    }

    /**
     * 拒绝不允许访问的请求
     */
    private
    function refuseNotAllowedRequest()
    {
        $this->refuseFavicon();

        // TODO 加入配置文件的支持，拦截掉一些扫描请求，加入黑/白名单机制
    }

    /**
     * api服务器拒绝部分浏览器自动发起的favicon请求
     */
    private
    function refuseFavicon()
    {
        if ( $this->getThisResponse()->server[ 'request_uri' ] == '/favicon.ico' ) {
            $this->refuseRequest();
        }
    }

    /**
     * 资源没找到，返回404
     */
    private
    function notFound()
    {
        $this->getThisResponse()->statue( 404 );
        $this->getThisResponse()->end();
    }

    /**
     * 拒绝请求
     * @param $response
     */
    private
    function refuseRequest()
    {
        $this->getThisResponse()->statue( 403 );
        $this->getThisResponse()->end();
    }

}