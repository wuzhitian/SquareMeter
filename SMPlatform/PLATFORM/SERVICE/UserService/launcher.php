<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: launcher.php
 * Create: 2018/3/30
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

require_once( __DIR__ . '/../../../vendor/umb-server-swoole-framework/autoload.php' ); //加载umb-server-swoole-framework

use UmbServer\SwooleFramework\COMPONENT\CORE\SERVER\HttpApiServer;
use UmbServer\SwooleFramework\LIBRARY\ENUM\_Config;
use UmbServer\SwooleFramework\LIBRARY\UTIL\Autoloader;
use UmbServer\SwooleFramework\LIBRARY\DATA\LocalDataCenter;

Autoloader::attach( __DIR__ . '/MODEL' );

$config            = file_get_contents( __DIR__ . '/config.json' );
$server            = HttpApiServer::getInstance();
$local_data_center = LocalDataCenter::getInstance();
$server->setConfig( $config, _Config::JSON );
$local_data_center->setConfig( $config, _Config::JSON );
$server->initial();
$local_data_center->initial();
$server->start();