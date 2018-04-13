<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: _TaskStatue.php
 * Create: 2018/4/11
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\ENUM;

/**
 * 任务状态枚举类
 * Class _TaskStatue
 * @package UmbServer\SwooleFramework\LIBRARY\ENUM
 */
class _TaskStatue
{
    const CREATE           = 0;
    const REQUEST          = 1;
    const REQUEST_CONFIRM  = 2;
    const HANDLING         = 3;
    const RESPONSE         = 4;
    const RESPONSE_CONFIRM = 5;
    const FINISH           = 6;
    const FAIL             = -1;
}