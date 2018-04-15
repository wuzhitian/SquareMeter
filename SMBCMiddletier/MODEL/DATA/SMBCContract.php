<?php declare( strict_types = 1 );
/**
 * Project: SMBCMiddletier
 * File: SMBCContract.php
 * Create: 2018/4/10
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMBCMiddletier\MODEL\DATA;

use UmbServer\SwooleFramework\LIBRARY\ENUM\_DB;
use UmbServer\SwooleFramework\LIBRARY\ENUM\_InstanceDataSource;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\Instance;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\InstanceTrait;

/**
 * SMBC已发布的合约类
 * Class SMBCContract
 * @package SMBCMiddletier\MODEL\DATA
 */
class SMBCContract extends Instance
{
    use InstanceTrait;

    const TABLE_NAME = 'SMBCContract'; //表名

    const MODE = _InstanceDataSource::REMOTE;
    const SCHEMA
               = [
            'smbc_contract_template_id' => STRING_TYPE,
            'address'                   => STRING_TYPE,
            'construct_params'          => OBJECT_TYPE,
            'owner_account_id'          => STRING_TYPE,
            'abi'                       => OBJECT_TYPE,
        ];

    const CACHE = _DB::NONE;

    public $smbc_contract_template_id; //对应的合约模板id
    public $address; //合约链上地址
    public $construct_params; //构造参数
    public $owner_account_id; //合约所有者account_id
    public $abi; //abi

    /**
     * 获取合约实例所有人账户
     * @return SMBCAccount
     */
    protected
    function getOwner(): SMBCAccount
    {
        $res = SMBCAccount::getById( $this->owner_account_id );
        return $res;
    }

    /**
     * 获取合约模板
     * @return SMBCContractTemplate
     */
    public
    function getContractTemplate(): SMBCContractTemplate
    {
        $res = SMBCContractTemplate::getById( $this->smbc_contract_template_id );
        return $res;
    }

    protected
    function transaction()
    {
        return true;
    }

    protected
    function call()
    {

    }
}