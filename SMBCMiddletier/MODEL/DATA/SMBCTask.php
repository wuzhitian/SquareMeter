<?php declare( strict_types = 1 );
/**
 * Project: SMBCMiddletier
 * File: SMBCTask.php
 * Create: 2018/3/30
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMBCMiddletier\MODEL\DATA;

use UmbServer\SwooleFramework\LIBRARY\COMMON_MODEL\Task;
use UmbServer\SwooleFramework\LIBRARY\ENUM\_DB;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\InstanceTrait;

/**
 * SMBC任务类
 * Class BlockChainTask
 * @package SMBCMiddletier\MODEL\DATA
 */
class SMBCTask extends Task
{
    use InstanceTrait;

    const TABLE_NAME = 'SMBCTask'; //表名

    const CACHE       = _DB::NONE; //不使用缓存
    const PERSISTENCE = _DB::MYSQL; //mysql持久化
}