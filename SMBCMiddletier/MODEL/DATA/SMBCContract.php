<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: SMBCContract.php
 * Create: 2018/4/10
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\MIDDLETIER\MODEL\DATA;

use UmbServer\SwooleFramework\LIBRARY\ENUM\_DB;
use UmbServer\SwooleFramework\LIBRARY\ENUM\_InstanceDataSource;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\Instance;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\InstanceTrait;

/**
 * SMBC已发布的合约类
 * Class SMBCContract
 * @package SMPlatform\MIDDLETIER\MODEL\DATA
 */
class SMBCContract extends Instance
{
    use InstanceTrait;
    
    const TABLE_NAME = 'SMBCContract';
    
    const MODE   = _InstanceDataSource::REMOTE;
    const SCHEMA = [
        'smbc_contract_template_id' => STRING_TYPE,
        'smbc_address'              => STRING_TYPE,
        'construct_params'          => OBJECT_TYPE,
    ];
    
    const CACHE = _DB::NONE;
    
    public $smbc_contract_template_id; //对应的合约模板id
    public $smbc_address; //合约链上地址
    public $construct_params; //构造参数
    
    public $abi;
}