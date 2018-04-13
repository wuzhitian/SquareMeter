<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: HttpApiClientRequest.php
 * Create: 2018/4/13
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\CORE\CLIENT\HttpApiClient;

use UmbServer\SwooleFramework\COMPONENT\CORE\CLIENT\BASE\HttpClientRequest;

/**
 * http_api_client请求体
 * Class HttpApiClientRequest
 * @package UmbServer\SwooleFramework\COMPONENT\CORE\CLIENT\HttpApiClient
 */
class HttpApiClientRequest extends HttpClientRequest
{
    public $verb; //get or post
    public $params; //参数
    public $request_uri; //request_uri
}