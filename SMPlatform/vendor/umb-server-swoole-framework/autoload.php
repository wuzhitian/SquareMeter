<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: autoload.php
 * Create: 2018/3/21
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

/**
 * LIBRARY LOAD
 */
//EXTEND
require_once( __DIR__ . '/LIBRARY/EXTEND/Const.php' );
require_once( __DIR__ . '/LIBRARY/EXTEND/ControllerArgument.php' );
require_once( __DIR__ . '/LIBRARY/EXTEND/GET.php' );
require_once( __DIR__ . '/LIBRARY/EXTEND/POST.php' );
require_once( __DIR__ . '/LIBRARY/EXTEND/UPLOAD_FILE.php' );

//ENUM
require_once( __DIR__ . '/LIBRARY/ENUM/_Config.php' );
require_once( __DIR__ . '/LIBRARY/ENUM/_ContentType.php' );
require_once( __DIR__ . '/LIBRARY/ENUM/_DB.php' );
require_once( __DIR__ . '/LIBRARY/ENUM/_InstanceBaseOperator.php' );
require_once( __DIR__ . '/LIBRARY/ENUM/_HttpServer.php' );
require_once( __DIR__ . '/LIBRARY/ENUM/_HttpResponseStatus.php' );
require_once( __DIR__ . '/LIBRARY/ENUM/_HttpRequestVerb.php' );
require_once( __DIR__ . '/LIBRARY/ENUM/_Server.php' );
require_once( __DIR__ . '/LIBRARY/ENUM/_Serialize.php' );

//ERROR
require_once( __DIR__ . '/LIBRARY/ERROR/Error.php' );
require_once( __DIR__ . '/LIBRARY/ERROR/UtilError.php' );
require_once( __DIR__ . '/LIBRARY/ERROR/HttpError.php' );

//FILESYSTEM
require_once( __DIR__ . '/LIBRARY/FILESYSTEM/File.php' );
require_once( __DIR__ . '/LIBRARY/FILESYSTEM/Folder.php' );

//UTIL
require_once( __DIR__ . '/LIBRARY/UTIL/ConfigLoader.php' );
require_once( __DIR__ . '/LIBRARY/UTIL/Console.php' );
require_once( __DIR__ . '/LIBRARY/UTIL/DataHandler.php' );
require_once( __DIR__ . '/LIBRARY/UTIL/Time.php' );
require_once( __DIR__ . '/LIBRARY/UTIL/Generator.php' );
require_once( __DIR__ . '/LIBRARY/UTIL/Serialize.php' );
require_once( __DIR__ . '/LIBRARY/UTIL/Autoloader.php' );
require_once( __DIR__ . '/LIBRARY/UTIL/Algorithm.php' );

//INSTANCE
require_once( __DIR__ . '/LIBRARY/INSTANCE/Instance.php' );

//AUTH
require_once( __DIR__ . '/LIBRARY/AUTH/AuthUser.php' );

//BASE
require_once( __DIR__ . '/LIBRARY/BASE/AOPObject.php' );
require_once( __DIR__ . '/LIBRARY/BASE/AOP.php' );

//HTTP
require_once( __DIR__ . '/LIBRARY/HTTP/CONTROLLER/AOPController.php' );
require_once( __DIR__ . '/LIBRARY/HTTP/CONTROLLER/Controller.php' );
require_once( __DIR__ . '/LIBRARY/HTTP/CONTROLLER/AuthController.php' );
require_once( __DIR__ . '/LIBRARY/HTTP/REQUEST/Request.php' );
require_once( __DIR__ . '/LIBRARY/HTTP/REQUEST/RequestTarget.php' );
require_once( __DIR__ . '/LIBRARY/HTTP/REQUEST/ApiTarget.php' );
require_once( __DIR__ . '/LIBRARY/HTTP/REQUEST/ResourceTarget.php' );
require_once( __DIR__ . '/LIBRARY/HTTP/HANDLER/RequestHandler.php' );
require_once( __DIR__ . '/LIBRARY/HTTP/RESPONSE/Response.php' );

/**
 * COMPONENT LOAD
 */
//CORE
require_once( __DIR__ . '/COMPONENT/CORE/SERVER/CONFIG/ServerConfig.php' );
require_once( __DIR__ . '/COMPONENT/CORE/SERVER/CONFIG/HttpServerConfig.php' );
require_once( __DIR__ . '/COMPONENT/CORE/SERVER/Server.php' );
require_once( __DIR__ . '/COMPONENT/CORE/SERVER/HttpServer.php' );
require_once( __DIR__ . '/COMPONENT/CORE/SERVER/HttpApiServer.php' );