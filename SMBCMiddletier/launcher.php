<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: launcher.php
 * Create: 2018/4/12
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

require( '/umb/loader/umb-server-swoole-framework.php' );
require( '/umb/loader/EOSS.php' );

use UmbServer\SwooleFramework\COMPONENT\MICRO_SERVICE\BASE\MicroServiceLauncher;

$config_folder_path = __DIR__ . '/CONFIG';

MicroServiceLauncher::getInstance()->launch( $argv, $config_folder_path );