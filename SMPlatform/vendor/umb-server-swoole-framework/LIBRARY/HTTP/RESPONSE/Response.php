<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: Response.php
 * Create: 2018/3/20
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\HTTP\RESPONSE;

use swoole_http_response;
use UmbServer\SwooleFramework\COMPONENT\SERVER\HttpServer;
use UmbServer\SwooleFramework\LIBRARY\ENUM\_ContentType;
use UmbServer\SwooleFramework\LIBRARY\ENUM\_HttpResponseStatus;
use UmbServer\SwooleFramework\LIBRARY\UTIL\Console;

/**
 * http_response封装类
 * Class Response
 * @package UmbServer\SwooleFramework\LIBRARY\HTTP\RESPONSE
 */
class Response
{
    private $_swoole_http_response; //内置swoole_http_response对象
    private $_http_server; //内置http_server对象，api或者web

    public $status_code = _HttpResponseStatus::SUCCESS;
    public $header = [ 'Access-Control-Allow-Origin' => '*' ];
    public $content = NULL;

    /**
     * 构造
     * Response constructor.
     * @param swoole_http_response $response
     */
    public
    function __construct( swoole_http_response $response, HttpServer $http_server )
    {
        $this->setSwooleResponse( $response );
        $this->_http_server = $http_server;
    }

    /**
     * 设置swoole_http_response对象
     * @param swoole_http_response $response
     */
    private
    function setSwooleResponse( swoole_http_response $response )
    {
        $this->_swoole_http_response = $response;
    }

    /**
     * 获取swoole_http_response对象
     * @return swoole_http_response
     */
    private
    function getSwooleResponse(): swoole_http_response
    {
        return $this->_swoole_http_response;
    }

    /**
     * 资源没找到，返回404
     */
    public
    function notFound()
    {
        Console::log( 'resources not found.' );
        $status_code = _HttpResponseStatus::NOT_FOUND;
        $this->setStatus( $status_code );
        $this->setContent( file_get_contents( __DIR__ . '/../TEMPLATE/' . $status_code . '.html' ), _ContentType::html );
        $this->response();
    }

    /**
     * 拒绝请求
     */
    public
    function refuse()
    {
        Console::log( 'request refused.' );
        $status_code = _HttpResponseStatus::REFUSE;
        $this->setStatus( $status_code );
        $this->setContent( file_get_contents( __DIR__ . '/../TEMPLATE/' . $status_code . '.html' ), _ContentType::html );
        $this->response();
    }

    /**
     * 响应请求
     */
    public
    function response()
    {
        $this->prepareHeader();
        $this->prepareStatus();
        $this->send();
    }

    /**
     * 添加header信息
     * @param string $key
     * @param string $value
     */
    public
    function addHeader( string $key, string $value )
    {
        $this->header[ $key ] = $value;
    }

    /**
     * 设置内容，并根据内容添加header的content_type
     * @param string $content
     * @param string $content_type
     */
    public
    function setContent( string $content, string $content_type = _ContentType::html )
    {
        $this->content = $content;
        switch ( $content_type ) {
            case _ContentType::php:
            case _ContentType::html:
                $this->addHeader( 'Content-Type', 'text/html' );
                break;
            case _ContentType::css:
                $this->addHeader( 'Content-Type', 'text/css' );
                break;
            case _ContentType::js:
                $this->addHeader( 'Content-Type', 'text/javascript' );
                break;
            case _ContentType::API:
            default:
        }
    }

    /**
     * 设置response状态码
     * @param int $status_code
     */
    public
    function setStatus( int $status_code = _HttpResponseStatus::SUCCESS )
    {
        $this->status_code = $status_code;
    }

    /**
     * 向swoole_http_response注入header
     */
    private
    function prepareHeader()
    {
        foreach ( $this->header as $key => $value ) {
            $this->getSwooleResponse()->header( $key, $value );
        }
    }

    /**
     * 向swoole_http_response注入status
     */
    private
    function prepareStatus()
    {
        $this->getSwooleResponse()->status( $this->status_code );
    }

    /**
     * 向swoole_http_response注入content，并发送response
     */
    private
    function send()
    {
        if ( !is_null( $this->content ) ) {
            $this->getSwooleResponse()->end( $this->content );
        }
    }
}