<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: launcher.php
 * Create: 2018/4/12
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

require( '../../../umb/server/library/umb-server-swoole-framework/autoload.php' );
require( '../../../umb/server/vendor/EOSS/autoload.php' );

use UmbServer\SwooleFramework\COMPONENT\MICRO_SERVICE\BASE\MicroServiceLauncher;

MicroServiceLauncher::getInstance()->launch( $argv, __DIR__ );