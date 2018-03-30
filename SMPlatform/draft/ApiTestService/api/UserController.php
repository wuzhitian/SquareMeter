<?php
/**
 * Project: SMPlatform
 * File: UserController.php
 * Create: 2018/3/20
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace draft\ApiTestService\Controller;

use UmbServer\SwooleFramework\LIBRARY\HTTP\CONTROLLER\AuthController;
use UmbServer\SwooleFramework\LIBRARY\EXTEND\POST;

use draft\ApiTestService\MODEL\User;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\InstanceControllerTraits;

/**
 * User控制器类
 * Class UserController
 */
class UserController extends AuthController
{
    use InstanceControllerTraits; //加载实例控制器功能
    
    /**
     * 登出
     */
    public
    function logout()
    {
        $user = User::getById( $this->getAuthUserId() );
        $res  = $user->logout();
        return $res;
    }
}