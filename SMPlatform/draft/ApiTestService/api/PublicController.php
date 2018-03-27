<?php
/**
 * Project: SMPlatform
 * File: PublicController.php
 * Create: 2018/3/24
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace draft\ApiTestService\Controller;

use UmbServer\SwooleFramework\LIBRARY\HTTP\CONTROLLER\Controller;
use UmbServer\SwooleFramework\LIBRARY\EXTEND\GET;
use UmbServer\SwooleFramework\LIBRARY\EXTEND\POST;

use draft\ApiTestService\MODEL\User;

/**
 * Public控制器
 * Class PublicController
 */
class PublicController extends Controller
{
    /**
     * 登录
     * @param GET $username
     * @param GET $password
     * @return object
     */
    public
    function login( GET $username, GET $password )
    {
        $res = User::login( $username, $password );
        return $res;
    }

    public
    function test( GET $username, GET $password )
    {
        $user           = new User();
        $user->username = $username;
        $user->password = $password;
        $user->create();
    }
}