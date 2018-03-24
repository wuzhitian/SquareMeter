<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: launcher.php
 * Create: 2018/3/20
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */
/**
 * 加载基础类库
 */
require_once( __DIR__ . '/../../vendor/umb-server-swoole-framework/autoload.php' );

use UmbServer\SwooleFramework\COMPONENT\CORE\SERVER\HttpApiServer;
use UmbServer\SwooleFramework\LIBRARY\ENUM\_Config;

$config = file_get_contents( __DIR__ . '/config.json' );
$server = new HttpApiServer();
$server->setConfig( $config, _Config::JSON );
$server->initial();
$server->start();