<?php declare( strict_types = 1 );
/**
 * Project: SMBCMiddletier
 * File: _TokenLiquidateMode.php
 * Create: 2018/4/9
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMBCMiddletier\ENUM;

/**
 * 数字资产清算模式枚举类
 * Class _TokenLiquidateMode
 * @package SMBCMiddletier\ENUM
 */
class _TokenLiquidateMode
{
    const PERIODIC = 'periodic';
    const VOTE     = 'vote';
}