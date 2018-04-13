<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: SMBCResponse.php
 * Create: 2018/4/11
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace EOSS\COMPONENT\MODEL\BASE;

/**
 * SMBC响应
 * Class SMBCResponse
 * @package EOSS\COMPONENT\MODEL\BASE
 */
class SMBCResponse
{
    public $responser; //响应的业务机对象
    public $success = false;
    public $data;
    public $error;
}