<?php declare( strict_types = 1 );
/**
 * Project: SMBCMiddletier
 * File: SMBCMiddletierError.php
 * Create: 2018/4/15
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMBCMiddletier\ERROR;

use UmbServer\SwooleFramework\LIBRARY\ERROR\Error;

/**
 * SMBC中间件异常类
 * Class SMBCMiddletierError
 * @package SMBCMiddletier\ERROR
 */
class SMBCMiddletierError extends Error
{
    const PREFIX_CODE = '81';
    const ERROR_TYPE  = 'SMBCMiddletierError';

    const FORBIDDEN_OPERATION
        = [
            'code'    => 1,
            'message' => [
                'CN' => '被禁止的操作',
                'EN' => 'forbidden operation',
            ],
        ];
}