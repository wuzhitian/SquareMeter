<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: Request.php
 * Create: 2018/3/20
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\HTTP;

use swoole_http_request;
use UmbServer\SwooleFramework\LIBRARY\ENUM\_HttpRequestType;

/**
 * http_request封装类
 * Class Request
 * @package UmbServer\SwooleFramework\LIBRARY\HTTP
 */
class Request
{
    private $_swoole_http_request; //内置swoole_http_request对象

    public $request_timestamp;
    public $verb;

    public $header;
    public $server;
    public $request;
    public $cookie;
    public $get;
    public $files;
    public $post;
    public $tmpfiles;

    /**
     * 构造
     * Request constructor.
     * @param swoole_http_request $request
     */
    public
    function __construct( swoole_http_request $request )
    {
        $this->setSwooleRequest( $request );
        $this->verb              = $this->getSwooleRequest()->server[ 'request_method' ];
        $this->request_uri       = $this->getSwooleRequest()->server[ 'request_uri' ];
        $this->get               = $this->getSwooleRequest()->get;
        $this->post              = $this->getSwooleRequest()->post;
        $this->request_timestamp = (int)$this->getSwooleRequest()->server[ 'request_time_float' ] * 1000;
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
     * 判断http_request类型
     */
    public
    function getRequestType()
    {

    }

    /**
     * 解析http_request的uri
     * @param string $type
     */
    public
    function parseRequestUri( $type = _HttpRequestType::API )
    {
        switch ( $type ) {
            case _HttpRequestType::API:
            case _HttpRequestType::PROXY:
            case _HttpRequestType::RESOURCE:
            default:
        }
    }
}