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

use UmbServer\SwooleFramework\LIBRARY\ENUM\_InstanceBaseOperator;
use UmbServer\SwooleFramework\LIBRARY\HTTP\CONTROLLER\Controller;
use UmbServer\SwooleFramework\LIBRARY\EXTEND\GET;
use UmbServer\SwooleFramework\LIBRARY\EXTEND\POST;

use draft\ApiTestService\MODEL\User;
use UmbServer\SwooleFramework\LIBRARY\UTIL\Crypto;

/**
 * Public控制器
 * Class PublicController
 */
class PublicController extends Controller
{
    const CRYPTO = false;
    const CRYPTO_CLASS = Crypto::class;
    
    /**
     * 登录
     * @param GET $username
     * @param GET $password
     * @return mixed
     * @throws \UmbServer\SwooleFramework\LIBRARY\ERROR\HttpError
     */
    public
    function login( GET $username, GET $password )
    {
        $user = User::login( $username, $password );
        $res = $user->getData( true );
        return $res;
    }
    
    public
    function test( GET $username, GET $password )
    {
        $user = new User();
        $user->username = $username;
        $user->password = $password;
        $user->create();
    }
    
    public function get( GET $id )
    {
        $user = User::getById( $id );
        $user->push( _InstanceBaseOperator::READ );
    }
    
    public function set( GET $id, GET $is_login )
    {
        $user = User::getById( $id );
        $user->is_login = $is_login;
        $user->update();
    }
    
    public function del( GET $id )
    {
        $user = User::getById( $id );
        $user->delete();
    }
}