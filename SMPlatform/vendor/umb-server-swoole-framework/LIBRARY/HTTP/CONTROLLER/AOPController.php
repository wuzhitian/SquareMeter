<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: AOPController.php
 * Create: 2018/3/24
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\HTTP\CONTROLLER;

use UmbServer\SwooleFramework\LIBRARY\BASE\AOPObject;
use UmbServer\SwooleFramework\LIBRARY\HTTP\REQUEST\ApiTarget;
use UmbServer\SwooleFramework\LIBRARY\HTTP\REQUEST\Request;
use UmbServer\SwooleFramework\LIBRARY\HTTP\RESPONSE\Response;

/**
 * AOP控制器接口类
 * Interface AOPController
 * @package UmbServer\SwooleFramework\LIBRARY\HTTP\CONTROLLER
 */
interface AOPController extends AOPObject
{
    /**
     * 构造
     * AOPController constructor.
     * @param ApiTarget $api_target
     */
    public
    function __construct( ApiTarget $api_target );
}