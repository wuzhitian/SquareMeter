<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: UtilError.php
 * Create: 2018/3/19
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\ERROR;

/**
 * 工具异常类
 * Class UtilError
 * @package UmbServer\SwooleFramework\LIBRARY\ERROR
 */
class UtilError extends Error
{
    const UN_SUPPORT_ENCODE_DATA
        = [
            'message' => [
                'CN' => '该数据不支持被序列化',
                'EN' => 'Data is no support to be encode',
            ],
        ];

    const UN_SUPPORT_DECODE_DATA
        = [
            'message' => [
                'CN' => '该数据不支持被反序列化',
                'EN' => 'Data is no support to be decode',
            ],
        ];
}