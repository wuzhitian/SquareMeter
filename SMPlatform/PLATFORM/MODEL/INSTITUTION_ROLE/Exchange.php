<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: Exchange.php
 * Create: 2018/3/30
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\PLATFORM\MODEL\INSTITUTION_ROLE;

use SMPlatform\PLATFORM\MODEL\ROLE\Institution;

/**
 * 交易所类
 * Class Exchange
 * @package SMPlatform\PLATFORM\MODEL\INSTITUTION_ROLE
 */
class Exchange extends Institution
{
    const SCHEMA = [
        'api_host'                => STRING_TYPE,
        'api_port'                => INT_TYPE,
        'api_is_ssl'              => BOOL_TYPE,
        'official_website_url'    => STRING_TYPE,
        'name'                    => STRING_TYPE,
        'description'             => TEXT_TYPE,
        'is_active'               => BOOL_TYPE,
        'statue'                  => STRING_TYPE,
        'virtual_wallet_id_array' => ARRAY_TYPE,
    ];
    
    public $api_host; //交易所api_host
    public $api_port; //交易所api_port
    public $api_is_ssl; //交易所api_is_ssl
    
    public $official_website_url; //官方网站地址
    
    public $name; //交易所名称
    public $description; //交易所描述
    
    public $is_active; //交易所是否可用
    public $statue; //交易所状态
    
    public $virtual_wallet_id_array; //交易所虚拟钱包id_array
}