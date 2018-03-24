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

use UmbServer\SwooleFramework\COMPONENT\SERVER\CONFIG\HttpServerConfig;
use UmbServer\SwooleFramework\COMPONENT\SERVER\HttpServer;
use UmbServer\SwooleFramework\LIBRARY\ENUM\_Config;
use UmbServer\SwooleFramework\LIBRARY\ENUM\_HttpServer;
use UmbServer\SwooleFramework\LIBRARY\HTTP\REQUEST\Request;
use UmbServer\SwooleFramework\LIBRARY\HTTP\REQUEST\RequestTarget;
use UmbServer\SwooleFramework\LIBRARY\HTTP\HANDLER\RequestHandler;
use UmbServer\SwooleFramework\LIBRARY\HTTP\RESPONSE\Response;

use swoole_http_server;
use swoole_http_request;
use swoole_http_response;

/**
 * http(s)api服务器基础类
 * Class HttpApiServer
 * @package UmbServer\SwooleFramework\COMPONENT\BASE\SERVER
 */
class HttpApiServer implements HttpServer
{
    const DEFAULT_CONFIG
        = [
            'name'        => 'HttpApiServer',
            'type'        => _HttpServer::API,
            'listen_ip'   => '0.0.0.0',
            'listen_port' => 9527,
            'is_ssl'      => false,
            'is_http2'    => false,
        ]; //默认配置

    private $_server; //swoole_http_server对象
    private $_config; //配置

    private $_extra_data; //附加数据

    private $_request         = NULL; //当次请求的对象暂存
    private $_request_target  = NULL; //当次请求解析后的目标对象暂存
    private $_request_handler = NULL; //当次请求的处理器对象暂存
    private $_response        = NULL; //当次响应的对象暂存

    /**
     * 设置配置
     * @param array $config
     * @param string $config_file_type
     */
    public
    function setConfig( $config = self::DEFAULT_CONFIG, $config_file_type = _Config::ARRAY )
    {
        $this->_config = new HttpServerConfig();
        $this->getConfig()->setByConfig( $config, $config_file_type );
    }

    /**
     * 获取config
     * @return HttpServerConfig
     */
    public
    function getConfig(): HttpServerConfig
    {
        return $this->_config;
    }

    /**
     * 初始化服务器
     */
    public
    function initial()
    {
        $this->setServer(); //生成server对象
        $this->setHttps(); //根据is_ssl和is_http2来设置相关的set
        $this->set(); //根据config中的set来完成set事务
        $this->bindCallback(); //绑定回调事件
    }

    /**
     * 获取当次请求
     * @return Request
     */
    public
    function getRequest(): Request
    {
        return $this->_request;
    }

    /**
     * 获取当次响应
     * @return Response
     */
    public
    function getResponse(): Response
    {
        return $this->_response;
    }

    /**
     * 获取当次请求处理器对象
     * @return RequestHandler
     */
    public
    function getRequestHandler(): RequestHandler
    {
        return $this->_request_handler;
    }

    /**
     * 获取解析后的请求目标对象
     * @return RequestTarget
     */
    public
    function getRequestTarget(): RequestTarget
    {
        return $this->_request_target;
    }

    /**
     * 设置当次请求
     * @param swoole_http_request $request
     */
    private
    function setRequest( swoole_http_request $request )
    {
        $this->_request = new Request( $request, $this );
    }

    /**
     * 设置当次响应
     * @param swoole_http_response $response
     */
    private
    function setResponse( swoole_http_response $response )
    {
        $this->_response = new Response( $response, $this );
    }

    /**
     * 设置解析后当次请求的目标
     * @param RequestTarget $request_target
     */
    public
    function setRequestTarget( RequestTarget $request_target )
    {
        $this->_request_target = $request_target;
    }

    /**
     * 设置请求处理器
     */
    private
    function setRequestHandler()
    {
        $this->_request_handler = new RequestHandler( $this );
    }

    /**
     * 获取内置server对象
     * @return \swoole_http_server
     */
    private
    function getServer(): swoole_http_server
    {
        return $this->_server;
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

    /**
     * 根据配置中is_ssl设置服务器对象
     */
    private
    function setServer()
    {
        if ( $this->getConfig()->is_ssl === true ) {
            $this->setHttpsServer();
        } else {
            $this->setHttpServer();
        }
    }

    /**
     * 生成http服务器对象
     */
    private
    function setHttpServer()
    {
        $this->_server = new swoole_http_server( $this->getConfig()->listen_ip, $this->getConfig()->listen_port, SWOOLE_BASE, SWOOLE_SOCK_TCP );
    }

    /**
     * 生成https服务器对象
     */
    private
    function setHttpsServer()
    {
        $this->_server = new swoole_http_server( $this->getConfig()->listen_ip, $this->getConfig()->listen_port, SWOOLE_BASE, SWOOLE_SOCK_TCP | SWOOLE_SSL );
    }

    /**
     * 设置https
     */
    private
    function setHttps()
    {
        if ( $this->getConfig()->is_ssl === true ) {
            $this->setSSLFile();
            $this->setHttp2();
        }
    }

    /**
     * 设置ssl文件
     */
    private
    function setSSLFile()
    {
        $this->getConfig()->set[ 'ssl_cert_file' ] = $this->getConfig()->ssl_cert_file;
        $this->getConfig()->set[ 'ssl_key_file' ]  = $this->getConfig()->ssl_key_file;
    }

    /**
     * 设置http2
     */
    private
    function setHttp2()
    {
        if ( $this->getConfig()->is_http2 === true ) {
            $this->getConfig()->set[ 'open_http2_protocol' ] = true;
        }
    }

    /**
     * 执行设置
     */
    private
    function set()
    {
        $this->getServer()->set( $this->getConfig()->set );
    }

    /**
     * 绑定回调事件
     */
    private
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
        echo "onStart:: " . $this->getConfig()->name . " Server started successfully.\n";
    }

    /**
     * server主进程关闭后的回调
     */
    public
    function onShutdown()
    {
        echo "onShutdown:: " . $this->getConfig()->name . " Server stopped successfully.\n";
    }

    /**
     * 收到请求后的回调
     * @param swoole_http_request $request
     * @param swoole_http_response $response
     * @return bool
     */
    public
    function onRequest( swoole_http_request $request, swoole_http_response $response )
    {
        $this->setRequest( $request );
        $this->setResponse( $response );
        $is_refuse = $this->refuseNotAllowedRequest(); //拦截不允许的请求
        if ( $is_refuse === true ) {
            return false;
        };
        $this->getRequest()->parse(); //解析请求
        $this->setRequestHandler(); //设置请求处理器
        $this->getRequestHandler()->handle(); //处理请求
        $this->getResponse()->response(); //响应请求
        $this->clean(); //清理请求缓存对象
        return true;
    }

    /**
     * 拒绝不允许访问的请求
     * @return bool
     */
    private
    function refuseNotAllowedRequest()
    {
        $res = $this->refuseFavicon();

        // TODO 加入配置文件的支持，拦截掉一些扫描请求，加入黑/白名单机制

        return $res;
    }

    /**
     * api服务器拒绝部分浏览器自动发起的favicon请求
     * @return bool
     */
    private
    function refuseFavicon()
    {
        $res = false;
        if ( $this->getRequest()->server[ 'request_uri' ] === '/favicon.ico' ) {
            $this->getResponse()->refuse();
            $res = true;
        }
        return $res;
    }

    /**
     * 清理request和response相关缓存对象
     */
    private
    function clean()
    {
        $this->_request         = NULL;
        $this->_request_target  = NULL;
        $this->_request_handler = NULL;
        $this->_response        = NULL;
    }

    /**
     * 启动server
     */
    public
    function start()
    {
        $this->getServer()->start();
    }
}