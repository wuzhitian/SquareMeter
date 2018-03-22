<?php declare( strict_types = 1 );

/**
 * Project: UmbServerSwooleFramework
 * File: httpApiServer.php
 * Create: 2018/3/21
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

require_once( __DIR__ . '/../vendor/umb-server-swoole-framework/autoload.php' );

use UmbServer\SwooleFramework\COMPONENT\CORE\SERVER\HttpApiServer;

$server = new HttpApiServer();
$config = [
    'name' => 'HttpApiServer',
    'root' => '/SquareMeter',
    'path' => '/SMPlatform/draft/',
    'listen_ip' => '0.0.0.0',
    'listen_port' => 9527,
];

$server->setConfig( $config );
$server->initial();
$server->start();