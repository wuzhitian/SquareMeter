<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: Pawnshop.php
 * Create: 2018/3/30
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\PLATFORM\MODEL\INSTITUTION_ROLE;

use SMPlatform\PLATFORM\MODEL\ROLE\Institution;

/**
 * 抵押所类
 * Class Pawnshop
 * @package SMPlatform\PLATFORM\MODEL\INSTITUTION_ROLE
 */
class Pawnshop extends Institution
{
    const SCHEMA = [
        'api_host'             => STRING_TYPE,
        'api_port'             => INT_TYPE,
        'api_is_ssl'           => BOOL_TYPE,
        'official_website_url' => STRING_TYPE,
        'name'                 => STRING_TYPE,
        'description'          => TEXT_TYPE,
        'is_active'            => BOOL_TYPE,
        'statue'               => STRING_TYPE,
    ];
    
    public $api_host; //抵押所api_host
    public $api_port; //抵押所api_port
    public $api_is_ssl; //抵押所api_is_ssl
    
    public $official_website_url; //官方网站地址
    
    public $name; //抵押所名称
    public $description; //抵押所描述
    
    public $is_active; //抵押所是否可用
    public $statue; //抵押所状态
}