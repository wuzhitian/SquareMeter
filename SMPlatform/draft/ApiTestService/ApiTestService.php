<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: ApiTestService.php
 * Create: 2018/3/19
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace draft\ApiTestService\MODEL\ApiTestService;

use UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\MODEL\Service;

/**
 * ApiTest服务
 * Class ApiTestService
 * @package draft\ApiTestService\MODEL\ApiTestService
 */
class ApiTestService extends Service
{
    private static $_instance;

    private
    function __construct()
    {
    }

    private
    function __clone()
    {
    }

    public static
    function getInstance(): self
    {
        if ( !( self::$_instance instanceof self ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
}