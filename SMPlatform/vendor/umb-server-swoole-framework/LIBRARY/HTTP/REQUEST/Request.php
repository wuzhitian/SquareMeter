<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: Request.php
 * Create: 2018/3/20
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\HTTP\REQUEST;

use swoole_http_request;
use UmbServer\SwooleFramework\COMPONENT\SERVER\HttpServer;
use UmbServer\SwooleFramework\LIBRARY\ENUM\_HttpServer;

/**
 * http_request封装类
 * Class Request
 * @package UmbServer\SwooleFramework\LIBRARY\HTTP\REQUEST
 */
class Request
{
    private $_swoole_http_request; //内置swoole_http_request对象
    private $_http_server; //内置http_server对象，api或者web
    private $_request_target; //经过解析后的request目标，api或者web

    public $request_type;
    public $is_handle   = false;
    public $is_response = false;
    public $request_timestamp;
    public $response_timestamp;

    public $requester; //请求发起者
    public $responder; //请求响应者

    public $header;
    public $server;
    public $request;
    public $cookie;
    public $get;
    public $post;
    public $tmpfiles;

    /**
     * 构造
     * Request constructor.
     * @param swoole_http_request $request
     * @param HttpServer $http_server
     */
    public
    function __construct( swoole_http_request $request, HttpServer $http_server )
    {
        $this->setSwooleRequest( $request );
        $this->_http_server      = $http_server;
        $this->verb              = $this->getSwooleRequest()->server[ 'request_method' ];
        $this->request_uri       = $this->getSwooleRequest()->server[ 'request_uri' ];
        $this->get               = $this->getSwooleRequest()->get;
        $this->post              = $this->getSwooleRequest()->post;
        $this->request_timestamp = (int)$this->getSwooleRequest()->server[ 'request_time_float' ] * 1000;
        $this->request_type      = $this->getHttpServer()->getConfig()->type;
    }

    /**
     * 获取内置http_server对象
     * @return HttpServer
     */
    private
    function getHttpServer(): HttpServer
    {
        return $this->_http_server;
    }

    /**
     * 设置swoole_http_request对象
     * @param swoole_http_request $request
     */
    private
    function setSwooleRequest( swoole_http_request $request )
    {
        $this->_swoole_http_request = $request;
    }

    /**
     * 获取swoole_http_request对象
     * @return swoole_http_request
     */
    private
    function getSwooleRequest(): swoole_http_request
    {
        return $this->_swoole_http_request;
    }

    /**
     * 根据request类型进行请求解析
     */
    public
    function parse()
    {
        switch ( $this->request_type ) {
            case _HttpServer::API:
                $this->parseApiRequestUri();
                break;
            case _HttpServer::RESOURCE:
            default:
                $this->parseResourceRequestUri();
        }
        $this->getHttpServer()->setRequestTarget( $this->getRequestTarget() );
    }

    /**
     * 设置请求目标
     * @param RequestTarget $request_target
     */
    private
    function setRequestTarget( RequestTarget $request_target )
    {
        $this->_request_target = $request_target;
    }

    /**
     * 获取请求目标
     * @return RequestTarget
     */
    private
    function getRequestTarget(): RequestTarget
    {
        return $this->_request_target;
    }

    /**
     * 解析api_http_request的uri，并生成request_target
     */
    private
    function parseApiRequestUri()
    {
        $api_target                  = new ApiTarget();
        $path_array                  = explode( '/', $this->request_uri );
        $api_target->request_uri     = $this->request_uri;
        $api_target->controller_name = $path_array[ sizeof( $path_array ) - 2 ] ?? 'index';
        $api_target->method_name     = $path_array[ sizeof( $path_array ) - 1 ];
        $relative_path               = '';
        foreach ( $path_array as $key => $dir ) {
            if ( $key > sizeof( $path_array ) - 3 ) {
                break;
            }
            $relative_path .= ( $dir . '/' );
        }
        $api_target->controller_file_path = $this->getHttpServer()->getConfig()->root . $this->getHttpServer()->getConfig()->path . $relative_path . $api_target->controller_name . '.php';
        $api_target->controller_namespace = $this->getHttpServer()->getConfig()->controller_namespace;
        $this->setRequestTarget( $api_target );
    }

    /**
     * 解析resource_http_request的uri
     */
    private
    function parseResourceRequestUri()
    {
        $this->request_target = new ResourceTarget();
    }
}