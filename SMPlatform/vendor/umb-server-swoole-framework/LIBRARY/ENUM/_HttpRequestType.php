<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: _HttpRequestType.php
 * Create: 2018/3/22
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\ENUM;

/**
 * http_request枚举类型
 * Class _HttpRequestType
 * @package UmbServer\SwooleFramework\LIBRARY\ENUM
 */
class _HttpRequestType
{
    const API      = 'api';
    const RESOURCE = 'resource';
    const PROXY    = 'proxy';
}