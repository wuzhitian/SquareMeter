<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: _InstanceBaseOperator.php
 * Create: 2018/3/24
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\ENUM;

/**
 * 实例基本操作枚举类
 * Class _InstanceBaseOperator
 * @package UmbServer\SwooleFramework\LIBRARY\ENUM
 */
class _InstanceBaseOperator
{
    const CREATE = 'create';
    const READ   = 'read';
    const UPDATE = 'update';
    const DELETE = 'delete';
}