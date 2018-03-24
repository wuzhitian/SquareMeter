<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: _HttpResponseStatus.php
 * Create: 2018/3/24
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\ENUM;

/**
 * http响应状态码枚举类
 * Class _HttpResponseStatus
 * @package UmbServer\SwooleFramework\LIBRARY\ENUM
 */
class _HttpResponseStatus
{
    const SUCCESS   = 200;
    const NOT_FOUND = 404;
    const REFUSE    = 403;
}