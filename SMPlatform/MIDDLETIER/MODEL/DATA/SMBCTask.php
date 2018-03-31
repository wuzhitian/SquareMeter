<?php
/**
 * Project: SMPlatform
 * File: Task.php
 * Create: 2018/3/30
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\MIDDLETIER\MODEL\DATA;

use UmbServer\SwooleFramework\LIBRARY\COMMON_MODEL\Task;

/**
 * 平方米私链任务类
 * Class BlockChainTask
 * @package SMPlatform\MIDDLETIER\MODEL\DATA
 */
class SMBCTask extends Task
{
    const TABLE_NAME = 'SMBCTask';
    
    public $requester;
    public $contract_id;
    public $method;
    public $params;
}