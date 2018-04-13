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
    
    public $name; //合约模板名
    public $abstract_interface; //abi
    public $byte_code; //字节码
    
    public $version; //版本号
}