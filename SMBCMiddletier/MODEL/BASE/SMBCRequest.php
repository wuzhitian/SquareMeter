<?php declare( strict_types = 1 );
/**
 * Project: SMBCMiddletier
 * File: SMBCRequest.php
 * Create: 2018/4/11
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMBCMiddletier\MODEL\BASE;

/**
 * SMBC请求
 * Class SMBCRequest
 * @package SMBCMiddletier\MODEL\BASE
 */
class SMBCRequest
{
    public $method;
    public $params;
    public $requester; //SMPlatform中发起请求的service对象
    public $operator_smbc_account_id;
    public $smbc_contract_id;
}