<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: _VirtualWalletOwner.php
 * Create: 2018/3/30
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\PLATFORM\MODEL\ENUM;

/**
 * 虚拟钱包持有者类型枚举类
 * Class _VirtualWalletOwner
 * @package SMPlatform\PLATFORM\MODEL\ENUM
 */
class _VirtualWalletOwner
{
    const INVESTOR = 'investor';
    const EXCHANGE = 'exchange';
    const PAWNSHOP = 'pawnshop';
}