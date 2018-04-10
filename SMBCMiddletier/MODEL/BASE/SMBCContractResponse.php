<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: SMBCContractResponse.php
 * Create: 2018/4/10
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace EOSS\COMPONENT\MODEL\BASE;

/**
 * SMBC合约返回体
 * Class SMBCContractResponse
 * @package EOSS\COMPONENT\MODEL\BASE
 */
class SMBCContractResponse
{
    public $success; //合约方法是否调用成功
    public $from; //调用者account_address
    public $message; //附带信息
}