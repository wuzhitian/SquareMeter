<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: RegistryVisitor.php
 * Create: 2018/4/12
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\FRAMEWORK\Registry;

use UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\BASE\MicroServiceVisitor;
use UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\ENUM\_MicroServiceVisitor;

/**
 * 注册中心微服务类
 * Class RegistryVisitor
 * @package UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\FRAMEWORK\Registry
 */
class RegistryVisitor extends MicroServiceVisitor
{
    protected $_type = _MicroServiceVisitor::HTTP_API_SERVICE_VISITOR;
    
    public
    function getMicroServiceFrameworkConfig()
    {
    
    }
}