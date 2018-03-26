<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: _HttpRequestVerb.php
 * Create: 2018/3/26
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\ENUM;

/**
 * http_request_verb类型枚举类
 * Class _HttpRequestVerb
 * @package UmbServer\SwooleFramework\LIBRARY\ENUM
 */
class _HttpRequestVerb
{
    const GET         = 'GET';
    const POST        = 'POST';
    const UPLOAD_FILE = 'UPLOAD_FILE';
}