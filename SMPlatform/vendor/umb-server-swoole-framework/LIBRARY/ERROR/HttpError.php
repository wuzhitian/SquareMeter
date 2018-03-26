<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: HttpError.php
 * Create: 2018/3/24
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\ERROR;

/**
 * http错误类
 * Class HttpError
 * @package UmbServer\SwooleFramework\LIBRARY\ERROR
 */
class HttpError extends Error
{
    const PREFIX_CODE = '08';
    const ERROR_TYPE  = 'HttpError';

    const UNKNOWN_ERROR
        = [
            'code'    => 0,
            'message' => [
                'CN' => '发生了未知错误',
                'EN' => 'Unknown error',
            ],
        ];

    const REQUEST_REFUSE
        = [
            'code'    => 1,
            'message' => [
                'CN' => '请求被拒绝',
                'EN' => 'Request refused',
            ],
        ];

    const CONTROLLER_NOT_FOUND
        = [
            'code'    => 2,
            'message' => [
                'CN' => '控制器不存在',
                'EN' => 'Controller not found',
            ],
        ];

    const METHOD_NOT_FOUND
        = [
            'code'    => 3,
            'message' => [
                'CN' => '方法不存在',
                'EN' => 'Method not found',
            ],
        ];

    const NECESSARY_PARAMETER_MISSING
        = [
            'code'    => 4,
            'message' => [
                'CN' => '必要参数缺少',
                'EN' => 'Necessary parameter missing',
            ],
        ];

    const API_AUTH_FAILED
        = [
            'code'    => 8,
            'message' => [
                'CN' => 'api验证失败',
                'EN' => 'Api auth failed',
            ],
        ];
}