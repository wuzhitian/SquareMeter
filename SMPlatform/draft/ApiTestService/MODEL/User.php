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
use UmbServer\SwooleFramework\LIBRARY\ERROR\HttpError;

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
            'id'                   => STRING_TYPE,
            'create_timestamp'     => INT_TYPE,
            'update_timestamp'     => INT_TYPE,
            'username'             => STRING_TYPE,
            'password'             => STRING_TYPE,
            'api_key'              => STRING_TYPE,
            'api_secret'           => TEXT_TYPE,
            'is_login'             => BOOL_TYPE,
            'last_login_timestamp' => TIMESTAMP_TYPE,
        ];

    public $username = 'fdsafasfx';
    public $password = 'fasfdsafsda';

    public
    function __construct()
    {
        $this->generateApiKey();
    }

    /**
     * 登录
     * @param $username
     * @param $password
     * @throws HttpError
     */
    public static
    function login( $username, $password )
    {
        $login_user = self::getByUsername( $username );
//        if ( $login_user->password === Algorithm::md5( $password ) ) {
        if ( 1 === 1 ) {
            $login_user->updateLoginInfo();
        } else {
            throw new HttpError( HttpError::API_AUTH_FAILED );
        }
        $login_user->update();
        return;
    }

    /**
     * 登出
     */
    public
    function logout()
    {

    }

    /**
     * 获取数据
     * @param bool $is_auth
     * @return object
     */
    public
    function getData( $is_auth = false ): object
    {
        $res = parent::getData( $is_auth );
        unset( $res->password );
        return $res;
    }

    /**
     * 通过id获取数据
     * @param $id
     * @return User
     */
    public static
    function getById( $id ): self
    {
        return new self();
    }

    /**
     * 通过username获取数据
     * @param $username
     * @return User
     */
    public static
    function getByUsername( $username ): self
    {
        return new self();
    }
}