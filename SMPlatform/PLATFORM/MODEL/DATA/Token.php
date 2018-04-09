<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: Token.php
 * Create: 2018/4/9
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\PLATFORM\MODEL\DATA;

use SMPlatform\PLATFORM\MODEL\ENUM\_Token;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\Instance;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\InstanceTrait;

/**
 * token类
 * Class Token
 * @package SMPlatform\PLATFORM\MODEL\DATA
 */
class Token extends Instance
{
    use InstanceTrait;
    
    const TABLE_NAME = 'Token';
    
    const SCHEMA = [
        'name'           => STRING_TYPE,
        'type'           => STRING_TYPE,
        'publish_amount' => DOUBLE_TYPE,
    ];
    
    public $name; //token名称
    public $type = _Token::IRET; //token类型
    public $publish_amount; //发行量
}