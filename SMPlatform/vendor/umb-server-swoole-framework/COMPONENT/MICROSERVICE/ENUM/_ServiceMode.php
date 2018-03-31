<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: _ServiceMode.php
 * Create: 2018/3/31
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\ENUM;

/**
 * 微服务类型枚举类
 * Class _ServiceMode
 * @package UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\ENUM
 */
class _ServiceMode
{
    const TCP_RPC_SERVICE       = 'tcp_rpc_service'; //tcp rpc服务
    const HTTP_API_SERVICE      = 'http_api_service'; //http(s) api服务
    const HTTP_RESOURCE_SERVICE = 'http_resource_service'; //http(s) resource服务
}