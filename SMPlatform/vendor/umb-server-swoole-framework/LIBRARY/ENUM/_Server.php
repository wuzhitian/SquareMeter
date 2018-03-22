<?php
/**
 * Project: UmbServerSwooleFramework
 * File: _Server.php
 * Create: 2018/3/20
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\ENUM;

/**
 * 服务器枚举类
 * Class _Server
 * @package UmbServer\SwooleFramework\LIBRARY\ENUM
 */
class _Server
{
    const HTTP_API_SERVER       = 'http_api_server';
    const HTTP_WEB_SERVER       = 'http_web_server';
    const HTTP_WEBSOCKET_SERVER = 'http_websocket_server';
    const TCP_SERVER            = 'tcp_server';
}