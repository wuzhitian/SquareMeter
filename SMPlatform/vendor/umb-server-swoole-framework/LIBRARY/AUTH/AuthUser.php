<?php declare( strict_types = 1 );
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
    public $is_login = false;
    public $last_login_timestamp;
    
    public
    function logout()
    {
        $this->api_secret = NULL;
        $this->is_login = false;
//        $this->save();
    }
    
    protected
    function generateApiKey()
    {
        $api_key = Generator::token();
        $this->api_key = $api_key;
//        $this->save();
    }
    
    protected
    function updateLoginInfo()
    {
        $this->is_login = true;
        $this->last_login_timestamp = Time::getNow();
        $this->api_secret = Generator::apiSecret();
        $this->update();
    }
}