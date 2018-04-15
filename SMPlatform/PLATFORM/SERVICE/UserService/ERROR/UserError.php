<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: UserError.php
 * Create: 2018/3/30
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\PLATFORM\SERVICES\UserService\ERROR;

use UmbServer\SwooleFramework\LIBRARY\ERROR\Error;

/**
 * User错误类
 * Class UserError
 * @package SMPlatform\PLATFORM\SERVICES\UserService\ERROR
 */
class UserError extends Error
{
    const PREFIX_CODE = '61';
    const ERROR_TYPE  = 'UserError';
    
    const PASSWORD_TOO_SHORT = [
        'code'    => 0,
        'message' => [
            'CN' => '密码过短',
            'EN' => 'Password too short',
        ],
    ];
    
    const PASSWORD_TOO_LONG = [
        'code'    => 1,
        'message' => [
            'CN' => '密码过长',
            'EN' => 'Password too long',
        ],
    ];
    
    const PASSWORD_NEED_FIGURE = [
        'code'    => 2,
        'message' => [
            'CN' => '密码中必须包含数字',
            'EN' => 'Password must include figure',
        ],
    ];
    
    const PASSWORD_NEED_UPPERCASE = [
        'code'    => 3,
        'message' => [
            'CN' => '密码中必须包含大写字符',
            'EN' => 'Password must include uppercase',
        ],
    ];
    
    const PASSWORD_NEED_LOWERCASE = [
        'code'    => 4,
        'message' => [
            'CN' => '密码中必须包含小写字符',
            'EN' => 'Password must include lowercase',
        ],
    ];
    
    const PASSWORD_NEED_SPECIAL_CHARACTER = [
        'code'    => 5,
        'message' => [
            'CN' => '密码中必须包含特殊字符',
            'EN' => 'Password must include special character',
        ],
    ];
}