<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: RegisteredHost.php
 * Create: 2018/4/12
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\MODEL\DATA;

use UmbServer\SwooleFramework\LIBRARY\COMMON_MODEL\Host;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\InstanceTrait;

/**
 * 注册的主机类
 * Class RegisteredHost
 * @package UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\MODEL\DATA
 */
class RegisteredHost extends Host
{
    use InstanceTrait;
    
    const TABLE_NAME = 'RegisteredHost'; //表名
    
    const SCHEMA = [
        'ip'     => STRING_TYPE,
        'name'   => STRING_TYPE,
        'domain' => STRING_TYPE,
    ];
}