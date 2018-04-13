<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: SMBCTask.php
 * Create: 2018/3/30
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\MIDDLETIER\MODEL\DATA;

use UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\VISITOR\DataSharerMicroServiceVisitor;
use UmbServer\SwooleFramework\LIBRARY\COMMON_MODEL\Task;
use UmbServer\SwooleFramework\LIBRARY\ENUM\_DB;
use UmbServer\SwooleFramework\LIBRARY\ENUM\_Instance_DataSource;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\InstanceTrait;

/**
 * SMBC任务类
 * Class BlockChainTask
 * @package SMPlatform\MIDDLETIER\MODEL\DATA
 */
class SMBCTask extends Task
{
    use InstanceTrait;
    
    const MODE                      = _Instance_DataSource::REMOTE; //数据中心管理
    const DATA_SHARER_VISITOR_CLASS = DataSharerMicroServiceVisitor::class; //定义数据中心访问器类
    const TABLE_NAME                = 'SMBCTask'; //表名
    
    const CACHE       = _DB::NONE; //不使用缓存
    const PERSISTENCE = _DB::MYSQL; //mysql持久化
}