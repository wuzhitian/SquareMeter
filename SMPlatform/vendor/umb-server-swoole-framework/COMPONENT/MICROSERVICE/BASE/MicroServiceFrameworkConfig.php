<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: MicroServiceFrameworkConfig.php
 * Create: 2018/4/13
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\SERVICE\BASE;

use UmbServer\SwooleFramework\LIBRARY\COMMON_MODEL\Config;

/**
 * 微服务框架配置类
 * Class MicroServiceFrameworkConfig
 * @package UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\SERVICE\BASE
 */
class MicroServiceFrameworkConfig extends Config
{
    public $project; //项目名
    public $sub_project; //子项目名
    public $path; //加载路径
    public $framework_service; //框架服务
    public $framework_datasource; //框架数据源
}