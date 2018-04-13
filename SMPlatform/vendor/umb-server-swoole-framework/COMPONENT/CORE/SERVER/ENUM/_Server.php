<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: _Server.php
 * Create: 2018/3/20
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\CORE\SERVER\ENUM;

/**
 * 服务器枚举类
 * Class _Server
 * @package UmbServer\SwooleFramework\COMPONENT\CORE\SERVER\ENUM
 */
class _Server
{
    
    const TCP_ASYNC_TASK_SERVER       = 'tcp_async_task_server'; //tcp异步任务服务器
    const WEBSOCKET_ASYNC_TASK_SERVER = 'websocket_async_task_server'; //websocket异步任务服务器
    const WEBSOCKET_DATASOURCE_SERVER = 'websocket_datasource_server'; //websocket data source服务器
    const HTTP_SIMPLE_API_SERVER      = 'http_simple_api_server'; //http(s) simple api服务器
    const HTTP_API_SERVER             = 'http_api_server'; //http(s) api服务器
    const HTTP_RESOURCE_SERVER        = 'http_resource_server'; //http(s) resource服务器
}