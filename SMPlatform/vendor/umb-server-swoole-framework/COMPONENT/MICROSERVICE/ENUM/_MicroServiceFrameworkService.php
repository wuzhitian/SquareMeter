<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: _MicroServiceFrameworkService.php
 * Create: 2018/4/13
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\ENUM;

/**
 * 微服务框架服务枚举类
 * Class _MicroServiceFrameworkService
 * @package UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\ENUM
 */
class _MicroServiceFrameworkService
{
    const Registry     = 'registry'; //注册中心
    const Authorizer   = 'authorizer'; //授权中心
    const DataSharer   = 'data_sharer'; //数据中心
    const Dispatcher   = 'dispatcher'; //分发器
    const Logger       = 'logger'; //日志中心
    const Monitor      = 'monitor'; //监控中心
    const TimerManager = 'timer_manager'; //定时任务中心
}