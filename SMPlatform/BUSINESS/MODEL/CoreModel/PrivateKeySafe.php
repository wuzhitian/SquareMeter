<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: PrivateKeySafe.php
 * Create: 2018/3/15
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\BUSINESS\MODEL\CoreModel;

use UmbServer\SwooleFramework\LIBRARY\CORE\INSTANCE\Instance;

/**
 * 用户私钥保险柜
 * Class PrivateKeySafe
 * @package SMPlatform\BUSINESS\MODEL\CoreModel
 */
class PrivateKeySafe extends Instance
{
    const TYPE_MAP
        = [
            'id'                    => INT_TYPE,
            'avatar_picture_id'     => INT_TYPE,
            'create_timestamp'      => INT_TYPE,
            'last_update_timestamp' => INT_TYPE,
            'last_login_timestamp'  => INT_TYPE,
            'is_login'              => BOOL_TYPE,
            'user_id'               => STRING_TYPE,
            'api_secret'            => STRING_TYPE,
            'nickname'              => STRING_TYPE,
            'username'              => STRING_TYPE,
            'password'              => STRING_TYPE,
            'cellphone'             => STRING_TYPE,
            'email'                 => STRING_TYPE,
            'post'                  => STRING_TYPE,
            'privilege_id_array'    => STRING_TYPE,
        ];

    public $id;
}