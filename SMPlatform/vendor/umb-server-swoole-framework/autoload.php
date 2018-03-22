<?php
/**
 * Project: SMPlatform
 * File: autoload.php
 * Create: 2018/3/21
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */
require_once( __DIR__ . '/LIBRARY/EXTEND/Const.php' );
require_once( __DIR__ . '/LIBRARY/ENUM/_Config.php' );
require_once( __DIR__ . '/LIBRARY/ENUM/_Server.php' );
require_once( __DIR__ . '/LIBRARY/ENUM/_DB.php' );
require_once( __DIR__ . '/LIBRARY/ENUM/_Serialize.php' );
require_once( __DIR__ . '/LIBRARY/UTIL/ConfigLoader.php' );

require_once( __DIR__ . '/COMPONENT/CORE/SERVER/CONFIG/ServerConfig.php' );
require_once( __DIR__ . '/COMPONENT/CORE/SERVER/CONFIG/HttpApiServerConfig.php' );
require_once( __DIR__ . '/COMPONENT/CORE/SERVER/Server.php' );
require_once( __DIR__ . '/COMPONENT/CORE/SERVER/HttpApiServer.php' );
