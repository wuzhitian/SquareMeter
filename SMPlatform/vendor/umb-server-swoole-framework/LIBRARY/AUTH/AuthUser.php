<?php
/**
 * Project: UmbServerSwooleFramework
 * File: AuthUser.php
 * Create: 2018/3/20
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\AUTH;

use UmbServer\SwooleFramework\LIBRARY\INSTANCE\Instance;
use UmbServer\SwooleFramework\LIBRARY\UTIL\Generator;
use UmbServer\SwooleFramework\LIBRARY\UTIL\Time;

/**
 * 授权接口访问用户基础类
 * Class AuthUser
 * @package UmbServer\SwooleFramework\LIBRARY\AUTH
 */
class AuthUser extends Instance
{
    public $api_key;
    public $api_secret;
    public $is_login;
    public $last_login_timestamp;

    public
    function logout()
    {

    }

    protected
    function generateApiKey()
    {
        $api_key       = Generator::token();
        $this->api_key = $api_key;
        $this->save();
    }

    protected
    function updateLoginInfo()
    {
        $last_login_timestamp = Time::getNow();
        $api_secret           = Generator::apiSecret();
        $update_array         = [
            'is_login'             => true,
            'last_login_timestamp' => $last_login_timestamp,
            'api_secret'           => $api_secret,
        ];
        $this->setAttributeByArray( $update_array );
        return $this->getData();
    }
}