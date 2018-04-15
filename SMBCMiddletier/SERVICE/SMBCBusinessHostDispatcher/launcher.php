<?php declare( strict_types = 1 );

/**
 * Project: SMBCMiddletier
 * File: launcher.php
 * Create: 2018/4/15
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */
require( '/umb/loader/umb-server-swoole-framework.php' );
require( '/umb/loader/EOSS.php' );
require( __DIR__ . '/SMBCBusinessHostDispatcher.php' );
require( __DIR__ . '/../../MODEL/autoload.php' );

use UmbServer\SwooleFramework\LIBRARY\UTIL\Autoloader;
use UmbServer\SwooleFramework\LIBRARY\UTIL\ConfigLoader;
use UmbServer\SwooleFramework\LIBRARY\ENUM\_Config;
use SMBCMiddletier\SERVICE\SMBCBusinessHostDispatcher\SMBCBusinessHostDispatcher;

Autoloader::attach( __DIR__ . '/MODULE' );

$service_config = ConfigLoader::parse( __DIR__ . '/../../CONFIG/service.config.json', _Config::JSON_FILE );
$config         = $service_config->service->SMBCBusinessHostDispatcher;
SMBCBusinessHostDispatcher::getInstance()->loadConfig( $config );
SMBCBusinessHostDispatcher::getInstance()->initial();
SMBCBusinessHostDispatcher::getInstance()->start();
