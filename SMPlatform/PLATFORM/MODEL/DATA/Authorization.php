<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: Authorization.php
 * Create: 2018/4/9
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\PLATFORM\MODEL\DATA;

use UmbServer\SwooleFramework\LIBRARY\INSTANCE\SafeInstance;

/**
 * 授权类
 * Class Authorization
 * @package SMPlatform\PLATFORM\MODEL\DATA
 */
class Authorization extends SafeInstance
{
    const TABLE_NAME = 'Authorization';
    
    public $privilege_id; //权限id
    
    public $relative_model_classpath; //关联model类
    public $relative_model_id; //关联model id，id作为key
    public $algorithm; //算法名
    public $secret;
    public $is_permanent; //是否永久
    public $deadline_timestamp; //失效时间
    
    public $applicant_service_id; //申请服务id
    public $accept_service_id_array; //允许此权限的id
}