<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: _Client.php
 * Create: 2018/4/12
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\CORE\CLIENT\ENUM;

/**
 * 客户端枚举类
 * Class _Client
 * @package UmbServer\SwooleFramework\COMPONENT\CORE\CLIENT\ENUM
 */
class _Client
{
    const HTTP_API_CLIENT             = 'http_api_client';
    const HTTP_RESOURCE_CLIENT        = 'http_resource_client';
    const TCP_ASYNC_TASK_CLIENT       = 'tcp_async_task_client';
    const WEBSOCKET_ASYNC_TASK_CLIENT = 'websocket_async_task_client';
    const WEBSOCKET_DATASOURCE_CLIENT = 'websocket_datasource_client';
}