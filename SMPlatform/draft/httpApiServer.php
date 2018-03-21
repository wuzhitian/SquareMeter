<?php declare( strict_types = 1 );

/**
 * Project: UmbServerSwooleFramework
 * File: httpApiServer.php
 * Create: 2018/3/21
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

use UmbServer\SwooleFramework\COMPONENT\CORE\SERVER\HttpApiServer;
use UmbServer\SwooleFramework\LIBRARY\UTIL\ConfigLoader;
use UmbServer\SwooleFramework\LIBRARY\ENUM\_Config;

$server = new HttpApiServer();
$config = [
    'name'        => 'HttpApiServer',
    'root'        => '/SquareMeter',
    'path'        => '/SMPlatform/draft/',
    'listen_ip'   => '0.0.0.0',
    'listen_port' => 9527,
];

$server->setConfig( ConfigLoader::parse( $config, _Config::ARRAY ) );
$server->start();