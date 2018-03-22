<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: autoload.php
 * Create: 2018/3/21
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

require_once( __DIR__ . '/LIBRARY/EXTEND/Const.php' );
require_once( __DIR__ . '/LIBRARY/EXTEND/ControllerArgument.php' );
require_once( __DIR__ . '/LIBRARY/EXTEND/GET.php' );
require_once( __DIR__ . '/LIBRARY/EXTEND/POST.php' );
require_once( __DIR__ . '/LIBRARY/EXTEND/UPLOAD_FILE.php' );

require_once( __DIR__ . '/LIBRARY/ENUM/_Config.php' );
require_once( __DIR__ . '/LIBRARY/ENUM/_Server.php' );
require_once( __DIR__ . '/LIBRARY/ENUM/_DB.php' );
require_once( __DIR__ . '/LIBRARY/ENUM/_Serialize.php' );

require_once( __DIR__ . '/LIBRARY/UTIL/ConfigLoader.php' );

require_once( __DIR__ . '/LIBRARY/BASE/AOPObject.php' );
require_once( __DIR__ . '/LIBRARY/BASE/AOP.php' );

require_once( __DIR__ . '/LIBRARY/HTTP/Controller.php' );
require_once( __DIR__ . '/LIBRARY/HTTP/AuthController.php' );
require_once( __DIR__ . '/LIBRARY/HTTP/Request.php' );
require_once( __DIR__ . '/LIBRARY/HTTP/Response.php' );

require_once( __DIR__ . '/COMPONENT/CORE/SERVER/CONFIG/ServerConfig.php' );
require_once( __DIR__ . '/COMPONENT/CORE/SERVER/CONFIG/HttpApiServerConfig.php' );
require_once( __DIR__ . '/COMPONENT/CORE/SERVER/Server.php' );
require_once( __DIR__ . '/COMPONENT/CORE/SERVER/HttpApiServer.php' );
