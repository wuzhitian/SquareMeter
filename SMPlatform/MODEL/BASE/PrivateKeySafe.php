<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: PrivateKeySafe.php
 * Create: 2018/3/15
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\MODEL\BASE;

use UmbServer\SwooleFramework\LIBRARY\CORE\INSTANCE\SafeInstance;

/**
 * 用户私钥加密类
 * Class PrivateKeySafe
 * @package SMPlatform\MODEL\BASE
 */
class PrivateKeySafe extends SafeInstance
{
    const TYPE_MAP
        = [
            'user_id' => STRING_TYPE,
            'private_key' => STRING_TYPE,
            'wallet_address' => STRING_TYPE,
        ];
    
    public $id;
    public $user_id;
    public $token_type;
}