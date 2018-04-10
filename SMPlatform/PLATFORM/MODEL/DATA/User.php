<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: User.php
 * Create: 2018/4/8
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\PLATFORM\MODEL\DATA;

use SMPlatform\PLATFORM\MODEL\DEPARTMENT\TradeCommittee;
use UmbServer\SwooleFramework\EXTRA\ENUM\_Currency;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\Instance;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\InstanceTrait;
use UmbServer\SwooleFramework\LIBRARY\STRUCTURE\Amount;

/**
 * 平台用户类
 * Class User
 * @package SMPlatform\PLATFORM\MODEL\DATA
 */
class User extends Instance
{
    use InstanceTrait;
    
    const TABLE_NAME = 'User'; //表名
    
    const SCHEMA = [
        'type'               => STRING_TYPE,
        'smbc_account_id'    => STRING_TYPE,
        'cellphone'          => STRING_TYPE,
        'privilege_group_id' => STRING_TYPE,
        'user_identity_id'   => STRING_TYPE,
    ];
    
    public $type; //personal | company
    public $smbc_account_id; //关联的smbc账户id，用以访问区块链
    public $cellphone; //手机号
    public $privilege_group_id; //权限组id
    public $user_identity_id; //user认证id
    
    /**
     * 登出
     */
    public
    function logout()
    {
    
    }
    
    /**
     * 初始化User
     */
    public
    function initial()
    {
        $this->initialTokenWallet();
        $this->initialTradeVirtualTokenWallet();
    }
    
    /**
     * 初始化用户平方米链上钱包
     */
    private
    function initialTokenWallet()
    {
    
    }
    
    /**
     * 初始化用户交易所虚拟钱包
     */
    private
    function initialTradeVirtualTokenWallet()
    {
    
    }
    
    /**
     * 充值人民币至用户链上钱包
     * @param Amount $CNY_amount
     * @param string $currency
     */
    public
    function exchangeCNYTByCurrency( Amount $CNY_amount, string $currency = _Currency::CNY )
    {
    
    }
    
    /**
     * 从用户链上钱包提现到指定银行卡
     * @param Amount $CNYT_amount
     * @param UserBankcard $target_bankcard
     * @param string $currency
     */
    public
    function exchangeCurrencyByCNYT( Amount $CNYT_amount, UserBankcard $target_bankcard, string $currency = _Currency::CNY )
    {
    
    }
    
    /**
     * 认购
     * @param Subscribe $subscribe
     * @param float $subscribe_amount
     */
    public
    function subscribe( Subscribe $subscribe, float $subscribe_amount )
    {
        $subscribe->purchase( $this, $subscribe_amount );
    }
    
    /**
     * 用CNYT购买数字资产token
     * @param Token $token
     * @param Amount $token_amount
     */
    public
    function purchaseDigitalEstateTokenByCNYT( Token $token, Amount $token_amount )
    {
        $CNYT_token = Token::getCNYT();
        $this->purchaseTokenByToken( $token, $CNYT_token, $token_amount );
    }
    
    /**
     * 币币交易，用token_b购买token_a
     * @param Token $token_a
     * @param Token $token_b
     * @param Amount $token_a_amount
     */
    private
    function purchaseTokenByToken( Token $token_a, Token $token_b, Amount $token_a_amount )
    {
        $deviation_amount = new Amount();
        TradeCommittee::getInstance()->tradeDeviationTransfer( $token_a, $deviation_amount );
    }
    
}