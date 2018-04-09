<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: UserIdentity.php
 * Create: 2018/4/9
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\PLATFORM\MODEL\DATA;

use UmbServer\SwooleFramework\LIBRARY\ENUM\_Serialize;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\SafeInstance;

/**
 * 用户认证加密类
 * Class UserIdentity
 * @package SMPlatform\PLATFORM\MODEL\DATA
 */
class UserIdentity extends SafeInstance
{
    const TABLE_NAME = 'UserIdentity';
    
    const SCHEMA = [
        'user_id'     => STRING_TYPE,
        'encode_type' => STRING_TYPE,
        'encode_data' => TEXT_TYPE,
    ];
    
    public $user_id; //用户id
    public $encode_type = _Serialize::UMB; //序列化方式
    public $encode_data; //认证序列化数据
}