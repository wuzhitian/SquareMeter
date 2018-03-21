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

/**
 * http_request封装类
 * Class Request
 * @package UmbServer\SwooleFramework\LIBRARY\HTTP
 */
class Request
{
    private $_swoole_http_request;

    public $server;
    public $request_uri;
    public $params;
}