<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: UserWallet.php
 * Create: 2018/4/10
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\PLATFORM\MODEL\DATA;

use UmbServer\SwooleFramework\LIBRARY\INSTANCE\InstanceTrait;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\SafeInstance;
use UmbServer\SwooleFramework\LIBRARY\STRUCTURE\Amount;

/**
 * 用户钱包类
 * Class UserWallet
 * @package SMPlatform\PLATFORM\MODEL\DATA
 */
class UserWallet extends SafeInstance
{
    use InstanceTrait;
    
    const TABLE_NAME = 'UserWallet'; //表名
    
    const SCHEMA = [
        'user_id'                             => STRING_TYPE,
        'pay_password'                        => MD5_TYPE,
        'token_wallet_id_array'               => ARRAY_TYPE,
        'trade_virtual_token_wallet_id_array' => ARRAY_TYPE,
        'bankcard_id_array'                   => ARRAY_TYPE,
    ];
    
    public $user_id; //用户id
    public $pay_password; //支付密码
    public $token_wallet_id_array; //平方米钱包id数组
    public $trade_virtual_token_wallet_id_array; //平方米交易虚拟钱包id数组
    public $bankcard_id_array; //银行卡id数组
    
    /**
     * 获取用户钱包
     * @return \stdClass
     */
    public
    function getWallet()
    {
        $wallet                                   = new \stdClass();
        $wallet->token_wallet_array               = $this->getTokenWalletArray();
        $wallet->trade_virtual_token_wallet_array = $this->getTradeVirtualTokenWalletArray();
        return $wallet;
    }
    
    /**
     * 获取指定token的链上钱包和交易虚拟钱包
     * @param Token $token
     * @return \stdClass
     */
    public
    function getWalletByToken( Token $token )
    {
        $wallet                             = new \stdClass();
        $wallet->token_wallet               = $this->getTokenWalletByToken( $token );
        $wallet->trade_virtual_token_wallet = $this->getTradeVirtualTokenWalletByToken( $token );
        return $wallet;
    }
    
    /**
     * 通过token获取用户链上钱包余额
     * @param Token $token
     * @return Amount
     */
    public
    function getTokenWalletBalanceByToken( Token $token ): Amount
    {
        $res = $this->getTokenWalletByToken( $token )->balance_amount;
        return $res;
    }
    
    /**
     * 通过token获取用户交易虚拟钱包余额
     * @param Token $token
     * @return Amount
     */
    public
    function getTradeVirtualTokenWalletBalanceByToken( Token $token ): Amount
    {
        $res = $this->getTradeVirtualTokenWalletByToken( $token )->balance_amount;
        return $res;
    }
    
    /**
     * 通过token获取用户总余额
     * @param Token $token
     * @return Amount
     */
    public
    function getBalanceByToken( Token $token ): Amount
    {
        $token_wallet_balance               = $this->getTokenWalletBalanceByToken( $token );
        $trade_virtual_token_wallet_balance = $this->getTradeVirtualTokenWalletBalanceByToken( $token );
        $res                                = Amount::add( $token_wallet_balance, $trade_virtual_token_wallet_balance );
        return $res;
    }
    
    /**
     * 获取用户链上钱包集
     * @return array
     */
    public
    function getTokenWalletArray()
    {
        $token_wallet_array = UserTokenWallet::getByIdArray( $this->token_wallet_id_array );
        return $token_wallet_array;
    }
    
    /**
     * 获取用户交易虚拟钱包集
     * @return array
     */
    public
    function getTradeVirtualTokenWalletArray()
    {
        $trade_virtual_token_wallet_array = UserTradeVirtualTokenWallet::getByIdArray( $this->trade_virtual_token_wallet_id_array );
        return $trade_virtual_token_wallet_array;
    }
    
    /**
     * 通过token获取用户链上钱包
     * @param Token $token
     * @return UserTokenWallet
     */
    public
    function getTokenWalletByToken( Token $token ): UserTokenWallet
    {
        $token_wallet = UserTokenWallet::getById( $token->id );
        return $token_wallet;
    }
    
    /**
     * 通过token获取用户交易虚拟钱包
     * @param Token $token
     * @return UserTradeVirtualTokenWallet
     */
    public
    function getTradeVirtualTokenWalletByToken( Token $token ): UserTradeVirtualTokenWallet
    {
        $trade_virtual_token_wallet = UserTradeVirtualTokenWallet::getById( $token->id );
        return $trade_virtual_token_wallet;
    }
}