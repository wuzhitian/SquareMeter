<?php declare( strict_types = 1 );
/**
 * Project: EOSS
 * File: BCAccountSafe.php
 * Create: 2018/3/31
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace EOSS\COMPONENT\MODEL\DATA;

use UmbServer\SwooleFramework\LIBRARY\INSTANCE\InstanceTrait;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\SafeInstance;

/**
 * 合约账户保险库类
 * Class BCAccountSafe
 * @package EOSS\COMPONENT\MODEL\DATA
 */
class BCAccountSafe extends SafeInstance
{
    use InstanceTrait;

    const SCHEMA
        = [
            'address'          => STRING_TYPE,
            'public_key_file'  => OBJECT_TYPE,
            'initial_password' => MD5_TYPE,
            'private_key'      => STRING_TYPE,
        ];

    public $address; //地址
    public $public_key_file; //公钥文件
    public $initial_password; //初始密码
    public $private_key; //私钥
}