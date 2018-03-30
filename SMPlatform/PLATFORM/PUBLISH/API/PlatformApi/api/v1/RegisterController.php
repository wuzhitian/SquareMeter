<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: RegisterController.php
 * Create: 2018/3/30
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\PLATFORM\PUBLISH\api\v1\PlatformApi;

use SMPlatform\PLATFORM\SERVICES\UserService\UserServiceVisitor;
use UmbServer\SwooleFramework\LIBRARY\EXTEND\POST;
use UmbServer\SwooleFramework\LIBRARY\HTTP\CONTROLLER\Controller;

/**
 * 注册类业务接口
 * Class RegisterController
 * @package SMPlatform\PLATFORM\PUBLISH\api\v1\PlatformApi
 */
class RegisterController extends Controller
{
    /**
     * 注册个人投资者
     * @param POST $cellphone
     * @param POST $password
     */
    public function registerPersonalInvestor( POST $cellphone, POST $password )
    {
        $res = UserServiceVisitor::getInstance();
    }
    
    public function registerCompanyInvestor()
    {
    
    }
}