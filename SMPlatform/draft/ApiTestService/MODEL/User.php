<?php
/**
 * Project: SMPlatform
 * File: IndustrialRealEstateAsset.php
 * Create: 2018/3/10
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace draft\ApiTestService\MODEL;

use UmbServer\SwooleFramework\LIBRARY\AUTH\AuthUser;

/**
 * User类
 * Class User
 * @package draft\ApiTestService\MODEL
 */
class User extends AuthUser
{
    const LOCAL_INSTANCE = true;

    const SCHEMA
        = [
            'id'         => STRING_TYPE,
            'username'   => STRING_TYPE,
            'password'   => STRING_TYPE,
            'api_key'    => STRING_TYPE,
            'api_secret' => TEXT_TYPE,
        ];

    public $username;
    public $password;

    public
    function __construct()
    {
        $this->generateApiKey();
    }

    public static
    function login( $username, $password )
    {

    }

    public
    function logout()
    {

    }

    public
    function getData( $is_auth = false ): object
    {
        $res = parent::getData( $is_auth );
        unset( $res->password );
        return $res;
    }

    public static
    function getById( $id ): self
    {
        return new self();
    }
}