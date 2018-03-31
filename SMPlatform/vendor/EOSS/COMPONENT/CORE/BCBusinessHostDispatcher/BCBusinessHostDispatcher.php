<?php declare( strict_types = 1 );
/**
 * Project: EOSS
 * File: BCBusinessHostDispatcher.php
 * Create: 2018/3/31
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace EOSS\COMPONENT\CORE\BCBusinessHostDispatcher;

use UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\MODEL\Service;

/**
 * 区块链业务机分发器
 * Class BCBusinessHostDispatcher
 * @package EOSS\COMPONENT\CORE\BCBusinessHostDispatcher
 */
class BCBusinessHostDispatcher extends Service
{
    const SERVICE_MODE = _Service::TCP;
}