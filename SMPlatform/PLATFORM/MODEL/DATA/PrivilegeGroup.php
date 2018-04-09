<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: PrivilegeGroup.php
 * Create: 2018/4/9
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\PLATFORM\MODEL\DATA;

use UmbServer\SwooleFramework\LIBRARY\INSTANCE\SafeInstance;

/**
 * 权限组类
 * Class PrivilegeGroup
 * @package SMPlatform\PLATFORM\MODEL\DATA
 */
class PrivilegeGroup extends SafeInstance
{
    const TABLE_NAME = 'privilege_group';

    const SCHEMA
        = [
            'name'        => STRING_TYPE,
            'description' => TEXT_TYPE,
        ];

    public $name; //权限组名
    public $description; //权限组描述
}