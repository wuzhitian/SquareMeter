<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: _MicroService.php
 * Create: 2018/4/12
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\ENUM;

/**
 * 微服务枚举类
 * Class _MicroService
 * @package UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\ENUM
 */
class _MicroService
{
    const HTTP_API_SERVICE             = 'http_api_service';
    const HTTP_RESOURCE_SERVICE        = 'http_resource_service';
    const TCP_ASYNC_TASK_SERVICE       = 'tcp_async_task_service';
    const WEBSOCKET_ASYNC_TASK_SERVICE = 'websocket_async_task_service';
    const WEBSOCKET_DATASOURCE_SERVICE = 'websocket_datasource_service';
}