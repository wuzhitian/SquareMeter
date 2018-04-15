<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: AccountController.php
 * Create: 2018/4/10
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMBCMiddletier\PUBLISHER\SMBCMiddletierApi\Controller;

use EOSS\COMPONENT\VISITOR\AccountVisitor;
use UmbServer\SwooleFramework\LIBRARY\HTTP\CONTROLLER\Controller;

/**
 * 账户控制器
 * Class AccountController
 * @package SMBCMiddletier\PUBLISHER\SMBCMiddletierApi\Controller
 */
class AccountController extends Controller
{
    public
    function getNewAccount()
    {
        $res = AccountVisitor::getInstance()->createNewAccount();
        return $res;
    }
}