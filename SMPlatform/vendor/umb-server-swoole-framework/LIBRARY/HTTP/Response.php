<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: Response.php
 * Create: 2018/3/20
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\HTTP;

use swoole_http_response;
use UmbServer\SwooleFramework\LIBRARY\ENUM\_HttpResponse;

/**
 * http_response封装类
 * Class Response
 * @package UmbServer\SwooleFramework\LIBRARY\HTTP
 */
class Response
{
    private $_swoole_http_response; //内置swoole_http_response对象

    public $success; //请求是否成功
    public $error; //错误信息
    public $data; //返回数据
    public $instance; //影响实例

    /**
     * 构造
     * Response constructor.
     * @param swoole_http_response $response
     */
    public
    function __construct( swoole_http_response $response )
    {
        $this->setSwooleResponse( $response );
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
        echo 'resources not found.' . PHP_EOL;
        $this->status( 404 );
        $this->end();
    }

    /**
     * 拒绝请求
     */
    public
    function refuse()
    {
        echo 'request refused.' . PHP_EOL;
        $this->status( 403 );
        $this->setHeader( _HttpResponse::html );
        $this->send( file_get_contents( __DIR__ . '/403.html' ) );
        $this->end();
    }

    public
    function response( $res )
    {

    }

    /**
     * 设置content-type
     * @param string $type
     */
    public
    function setHeader( $type = _HttpResponse::html )
    {
        $this->getSwooleResponse()->header( 'Access-Control-Allow-Origin', '*' );
        switch ( $type ) {
            case _HttpResponse::php:
            case _HttpResponse::html:
                $this->getSwooleResponse()->header( 'Content-Type', 'text/html' );
                break;
            case _HttpResponse::css:
                $this->getSwooleResponse()->header( 'Content-Type', 'text/css' );
                break;
            case _HttpResponse::js:
                $this->getSwooleResponse()->header( 'Content-Type', 'text/javascript' );
                break;

            case _HttpResponse::API:
            default:
        }
    }

    /**
     * 设置response状态码
     * @param $code
     */
    private
    function status( $code )
    {
        $this->getSwooleResponse()->status( $code );
    }

    /**
     * 设置response结束并发送
     */
    private
    function end()
    {
        $this->getSwooleResponse()->end();
    }

    /**
     * 发送data
     * @param $data
     */
    private
    function send( $data )
    {
        $this->getSwooleResponse()->write( $data );
    }
}