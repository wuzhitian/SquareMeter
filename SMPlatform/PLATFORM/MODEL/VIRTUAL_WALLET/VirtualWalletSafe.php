<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: VirtualWallet.php
 * Create: 2018/3/30
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\PLATFORM\MODEL\VIRTUAL_WALLET;

use UmbServer\SwooleFramework\LIBRARY\INSTANCE\SafeInstance;

/**
 * 虚拟钱包保险库类
 * Class VirtualWallet
 * @package SMPlatform\PLATFORM\MODEL\VIRTUAL_WALLET
 */
class VirtualWalletSafe extends SafeInstance
{
    const TABLE_NAME = 'VirtualWalletSafe';
    
    public $owner_type; //所有者类型
    public $owner_id; //所有者id
}