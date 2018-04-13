<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: MicroServiceConfig.php
 * Create: 2018/4/11
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\BASE;

use UmbServer\SwooleFramework\LIBRARY\COMMON_MODEL\Config;

/**
 * 微服务配置类
 * Class MicroServiceConfig
 * @package UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\BASE
 */
class MicroServiceConfig extends Config
{
    public $name; //微服务名
    public $root; //部署根目录
    public $path; //相对路径
    public $type; //微服务类型
    
    public $registry; //注册中心配置
    public $authorizer; //鉴权中心配置
    public $monitor; //监控中心配置
    public $dispatcher; //分发中心配置
    public $logger; //日志中心配置
    public $data_sharer; //数据中心配置
    public $timer_manager; //定时任务中心配置
    
    public $server; //内置服务器配置
}