<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: Privilege.php
 * Create: 2018/4/9
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\PLATFORM\MODEL\DATA;

use UmbServer\SwooleFramework\LIBRARY\INSTANCE\SafeInstance;

/**
 * 权限类
 * Class Privilege
 * @package SMPlatform\PLATFORM\MODEL\DATA
 */
class Privilege extends SafeInstance
{
    const TABLE_NAME = 'privilege';
    
    const SCHEMA = [
        'privilege_group_id'   => STRING_TYPE,
        'applicant_service_id' => STRING_TYPE,
        'is_permanent'         => BOOL_TYPE,
        'name'                 => STRING_TYPE,
        'description'          => TEXT_TYPE,
    ];
    
    public $privilege_group_id; //权限组id
    
    public $applicant_service_id; //申请权限服务id
    public $is_permanent = false; //是否永久
    public $deadline_timestamp; //失效时间戳
    
    public $name; //权限名
    public $description; //权限描述
}