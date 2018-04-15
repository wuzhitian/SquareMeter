<?php declare( strict_types = 1 );
/**
 * Project: SMBCMiddletier
 * File: SMBCTransferResponse.php
 * Create: 2018/4/10
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMBCMiddletier\MODEL\BASE;

/**
 * 转账返回体，于node_response的data中
 * Class SMBCTransferResponse
 * @package SMBCMiddletier\MODEL\BASE
 */
class SMBCTransferResponse extends SMBCContractResponse
{
    public $to; //收款方account_address
    public $value; //转账数额
}