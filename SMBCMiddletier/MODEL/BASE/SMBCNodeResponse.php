<?php declare( strict_types = 1 );
/**
 * Project: SMBCMiddletier
 * File: SMBCNodeResponse.php
 * Create: 2018/4/10
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMBCMiddletier\MODEL\BASE;

/**
 * SMBC业务机node服务返回体类
 * Class SMBCNodeResponse
 * @package SMBCMiddletier\MODEL\BASE
 */
class SMBCNodeResponse
{
    public $data;
    public $hasError;
    public $error;
}