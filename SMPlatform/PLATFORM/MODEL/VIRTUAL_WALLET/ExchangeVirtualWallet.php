<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: ExchangeWallet.php
 * Create: 2018/3/30
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\PLATFORM\MODEL\VIRTUAL_WALLET;

/**
 * 交易所虚拟钱包类
 * Class ExchangeVirtualWallet
 * @package SMPlatform\PLATFORM\MODEL\VIRTUAL_WALLET
 */
class ExchangeVirtualWallet extends VirtualWalletSafe
{
    public $exchange_id;
    public $token;
    public $value;
}