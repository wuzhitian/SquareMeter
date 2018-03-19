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

use UmbServer\SwooleFramework\LIBRARY\INSTANCE\Instance;
use UmbServer\SwooleFramework\LIBRARY\UTIL\Generator;
use UmbServer\SwooleFramework\LIBRARY\UTIL\Time;

class User extends Instance
{
    const LOCAL_INSTANCE = true;

    const DATA_SCHEMA = [
        'id' => STRING_TYPE,
        'username' => STRING_TYPE,
        'password' => STRING_TYPE,
        'api_key' => STRING_TYPE,
        'api_secret' => TEXT_TYPE,
    ];

    public $username;
    public $password;
    public $api_key;
    public $api_secret;

    public static function login( $username, $password )
    {

    }

    public function logout()
    {

    }

    /**
     *
     * @return mixed
     */
    private function updateLoginInfo()
    {
        $last_login_timestamp = Time::getNow();
        $api_secret = Generator::apiSecret();
        $update_array = [
            'is_login' => true,
            'last_login_timestamp' => $last_login_timestamp,
            'api_secret' => $api_secret,
        ];
        $this->setAttributeByArray($update_array);
        return $this->getData();
    }
}