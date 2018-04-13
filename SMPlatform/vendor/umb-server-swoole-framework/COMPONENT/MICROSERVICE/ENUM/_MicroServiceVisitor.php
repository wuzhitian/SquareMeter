<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: _MicroServiceVisitor.php
 * Create: 2018/4/12
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\ENUM;

/**
 * 微服务访问器枚举类
 * Class _MicroServiceVisitor
 * @package UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\ENUM
 */
class _MicroServiceVisitor
{
    const HTTP_API_SERVICE_VISITOR = 'http_api_service_visitor';
    const TCP_ASYNC_TASK_SERVICE_VISITOR = 'tcp_async_task_service_visitor';
}