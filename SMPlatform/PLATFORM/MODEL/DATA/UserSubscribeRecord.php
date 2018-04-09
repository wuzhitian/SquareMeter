<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: UserSubscribeRecord.php
 * Create: 2018/4/9
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\PLATFORM\MODEL\DATA;

use UmbServer\SwooleFramework\LIBRARY\INSTANCE\InstanceTrait;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\SafeInstance;

/**
 * 用户认购记录
 * Class UserSubscribeRecord
 * @package SMPlatform\PLATFORM\MODEL\DATA
 */
class UserSubscribeRecord extends SafeInstance
{
    use InstanceTrait;
    
    const TABLE_NAME = 'UserSubscribeRecord';
    
    public $user_id;
    public $subscribe_id;
    public $input_token_id;
    public $input_token_amount;
    public $subscribe_amount;
    public $subscribe_number_range;
}