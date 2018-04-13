<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: _LoadBalanceStrategy.php
 * Create: 2018/4/12
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\ENUM;

/**
 * 负载均衡策略枚举类
 * Class _LoadBalanceStrategy
 * @package UmbServer\SwooleFramework\LIBRARY\ENUM
 */
class _LoadBalanceStrategy
{
    const POLL      = 'poll'; //轮询
    const CHALLENGE = 'challenge'; //争抢
    const SPEED     = 'speed'; //速度优先
}