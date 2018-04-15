<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: UserTestController.php
 * Create: 2018/4/2
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\PLATFORM\SERVICES\AutoTestService\api\v1;

use SMPlatform\PLATFORM\SERVICES\AutoTestService\AutoTestService;
use UmbServer\SwooleFramework\LIBRARY\EXTEND\GET;
use UmbServer\SwooleFramework\LIBRARY\HTTP\CONTROLLER\Controller;

/**
 * 用户生命周期测试控制器
 * Class UserTestController
 * @package SMPlatform\PLATFORM\SERVICES\AutoTestService\api\v1
 */
class UserTestController extends Controller
{
    /**
     * 投资者注册
     * @param GET $cellphone
     * @param GET $password
     */
    public
    function investorRegisterByCellphone( GET $cellphone, GET $password )
    {

    }
}