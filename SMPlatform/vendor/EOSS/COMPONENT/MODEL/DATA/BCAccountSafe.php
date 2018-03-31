<?php declare( strict_types = 1 );
/**
 * Project: EOSS
 * File: BCAccountSafe.php
 * Create: 2018/3/31
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace EOSS\COMPONENT\MODEL\DATA;

use UmbServer\SwooleFramework\LIBRARY\INSTANCE\SafeInstance;

/**
 * 合约账户保险库类
 * Class BCAccountSafe
 * @package EOSS\COMPONENT\MODEL\DATA
 */
class BCAccountSafe extends SafeInstance
{
    const SCHEMA = [
    ];
    
    public $address;
}