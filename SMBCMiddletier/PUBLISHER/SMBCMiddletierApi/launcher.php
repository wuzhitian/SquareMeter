<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: launcher.php
 * Create: 2018/4/13
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */
require_once( __DIR__ . '/../../../../SMPlatform/vendor/umb-server-swoole-framework/autoload.php' );

use UmbServer\SwooleFramework\LIBRARY\UTIL\ConfigLoader;
use UmbServer\SwooleFramework\LIBRARY\ENUM\_Config;
use SMBCMiddletier\PUBLISH\API\Api_SMBCMiddletier\_SMBCMiddletierApi;

$config    = ConfigLoader::parse( __DIR__ . '/../../../CONFIG/publisher.config.json', _Config::JSON_FILE );
$publisher = _SMBCMiddletierApi::getInstance();
$publisher->loadConfig( $config->publisher->Api_SMBCMiddletier );
$publisher->initial();
$publisher->publish();