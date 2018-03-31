<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: Server.php
 * Create: 2018/3/20
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\CORE\SERVER;

/**
 * 服务器接口类
 * Interface Server
 * @package UmbServer\SwooleFramework\COMPONENT\CORE\SERVER
 */
interface Server
{
    public
    function start();
    
    public
    function onWorkerStart();
    
    public
    function onStart();
    
    public
    function onShutDown();
}