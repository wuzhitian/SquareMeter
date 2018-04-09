<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: Position.php
 * Create: 2018/4/9
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\PLATFORM\MODEL\DATA;

use UmbServer\SwooleFramework\LIBRARY\INSTANCE\Instance;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\InstanceTrait;

/**
 * 头寸类
 * Class Position
 * @package SMPlatform\PLATFORM\MODEL\DATA
 */
class Position extends Instance
{
    use InstanceTrait;
    
    const TABLE_NAME = 'position';
    
    const SCHEMA = [
        'name'               => STRING_TYPE,
        'target_amount'      => DOUBLE_TYPE,
        'target_description' => TEXT_TYPE,
    ];
    
    public $name; //头寸名称
    public $target_amount; //头存标的数值
    public $target_description; //头存标的描述
}