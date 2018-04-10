<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: SMBCContractTemplate.php
 * Create: 2018/4/10
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\MIDDLETIER\MODEL\DATA;

use UmbServer\SwooleFramework\LIBRARY\INSTANCE\Instance;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\InstanceTrait;

/**
 * SMBC合约模版类
 * Class SMBCContractTemplate
 * @package SMPlatform\MIDDLETIER\MODEL\DATA
 */
class SMBCContractTemplate extends Instance
{
    use InstanceTrait;

    const TABLE_NAME = 'SMBCContractTemplate';

    public $name;
    public $abstract_interface;
    public $byte_code;

    public $version;
}