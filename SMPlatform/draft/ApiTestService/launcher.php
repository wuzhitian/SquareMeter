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
require_once( __DIR__ . '/../../../LIBRARY/autoload.php' );

/**
 * 加载SLF框架类库
 */
require_once( __DIR__ . '/../../../SLFramework/autoload.php' );

/**
 * 加载公共业务类库
 */
require_once( __DIR__ . '/../../LIBRARY/autoload.php' );

/**
 * 加载host配置
 */
$HOSTS = require_once( __DIR__ . '/../host_config.php' );

require_once( __DIR__ . '/ApiTestService.php' );

use draft\ApiTestService\MODEL\ApiTestService\ApiTestService;
use UmbServer\SwooleFramework\LIBRARY\UTIL\ConfigLoader;

$config      = ConfigLoader::parse( require_once( __DIR__ . './config.json' ) );
$service     = ApiTestService::getInstance();
$service->setConfig( $config );
$service->start();