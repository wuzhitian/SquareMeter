<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: Subscribe.php
 * Create: 2018/4/9
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\PLATFORM\MODEL\DATA;

use UmbServer\SwooleFramework\LIBRARY\INSTANCE\Instance;

/**
 * 认购类
 * Class Subscribe
 * @package SMPlatform\PLATFORM\MODEL\DATA
 */
class Subscribe extends Instance
{
    const TABLE_NAME = 'Subscribe';
    
    const SCHEMA = [
        'project_id'      => STRING_TYPE,
        'start_timestamp' => TIMESTAMP_TYPE,
        'end_timestamp'   => TIMESTAMP_TYPE,
        'seller_id'       => STRING_TYPE,
        'input_token_id'  => STRING_TYPE,
        'output_token_id' => STRING_TYPE,
        'total_amount'    => DOUBLE_TYPE,
        'price'           => DOUBLE_TYPE,
        'unit'            => DOUBLE_TYPE,
        'is_active'       => BOOL_TYPE,
    ];
    
    public $project_id; //项目id
    public $start_timestamp; //开始时间戳
    public $end_timestamp; //结束时间戳
    public $seller_id; //发售机构id
    public $input_token_id; //收入token
    public $output_token_id; //输出token
    public $total_amount; //认购总额
    public $price; //单价
    public $unit; //单位，比如一份为0.01 IRET004
    public $minimize_percentage; //最小百分比，成功条件
    public $maximize_percentage; //最大百分比，超限条件
    public $is_active = false; //是否活动
    
    public $user_subscribe_record_id_array; //用户认购记录id_array
    
    public
    function purchase( User $user, float $subscribe_amount )
    {
    
    }
}