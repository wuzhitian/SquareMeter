<?php declare( strict_types = 1 );
/**
 * Project: SMBCMiddletier
 * File: SMBCBusinessHostController.php
 * Create: 2018/4/15
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMBCMiddletier\SERVICE\SMBCBusinessHostDispatcher\Controller;

use SMBCMiddletier\MODEL\CONTRACT\SMBCCurrencyToken;
use SMBCMiddletier\MODEL\DATA\SMBCAccount;
use SMBCMiddletier\MODEL\DATA\SMBCBusinessHost;
use SMBCMiddletier\MODEL\DATA\SMBCContract;
use SMBCMiddletier\SERVICE\SMBCBusinessHostDispatcher\SMBCBusinessHostLoadBalanceModule;
use SMBCMiddletier\SERVICE\SMBCBusinessHostDispatcher\SMBCBusinessHostVisitModule;
use UmbServer\SwooleFramework\LIBRARY\EXTEND\POST;
use UmbServer\SwooleFramework\LIBRARY\HTTP\CONTROLLER\Controller;

/**
 * SMBCBusinessHost控制器类
 * Class SMBCBusinessHostController
 * @package SMBCMiddletier\SERVICE\SMBCBusinessHostDispatcher\Controller
 */
class SMBCBusinessHostController extends Controller
{
    public
    function getNewAccount()
    {
        //        $target_host = SMBCBusinessHostLoadBalanceModule::getPropertyBusinessHost();
        $target_host                          = new SMBCBusinessHost();
        $target_host->ip                      = '47.100.185.238';
        $target_host->node_server_listen_port = 9090;
        $res                                  = SMBCBusinessHostVisitModule::newAccount( $target_host );
        return $res;
    }

    public
    function execute( POST $operator_account_id, POST $contract_id, POST $method, POST $event_name, POST $params = NULL )
    {
        $operator_account = SMBCAccount::getById( $operator_account_id );
        $contract         = SMBCContract::getById( $contract_id );
        $method           = $method->string();
        $event_name       = $event_name->string();
        $params           = $params->object();
        $target_host      = SMBCBusinessHostLoadBalanceModule::getPropertyBusinessHost();
        $res              = SMBCBusinessHostVisitModule::transaction( $target_host, $operator_account, $contract, $method, $event_name, $params );
        return $res;
    }

    public
    function select( POST $contract_id, POST $method, POST $params = NULL )
    {
        $contract    = SMBCContract::getById( $contract_id );
        $method      = $method->string();
        $params      = $params->object();
        $target_host = SMBCBusinessHostLoadBalanceModule::getPropertyBusinessHost();
        $res         = SMBCBusinessHostVisitModule::call( $target_host, $contract, $method, $params );
        return $res;
    }

    public
    function CNYTCharge()
    {
        $target_host                          = new SMBCBusinessHost();
        $target_host->ip                      = '47.100.185.238';
        $target_host->node_server_listen_port = 9090;

        $operator_account              = new SMBCAccount();
        $operator_account->address     = '0xfb896078fe4a7447278b38247a0547a8c61f720f';
        $operator_account->private_key = '2d43e736b6bb8cb269842e28a61128c67a1e61daf3a2c1a6d5e8e40c02ddf7eb';

        $cnyt_contract          = new SMBCCurrencyToken();
        $cnyt_contract->address = '0x0f2b0461d231791b6a06b830cc87ccf7e2c265d5';
        $cnyt_contract->abi     = '[{"constant":false,"inputs":[{"name":"_newOperator","type":"address"}],"name":"changeOperator","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"getTotalBalance","outputs":[{"name":"_totalBalance","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"getSymbol","outputs":[{"name":"_symbol","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"getTotalHolders","outputs":[{"name":"count","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"MAX_UINT256","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"getHolders","outputs":[{"name":"holders","type":"address[]"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"owner","type":"address"}],"name":"balanceOf","outputs":[{"name":"balance","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"acceptOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"value","type":"uint256"}],"name":"mint","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"to","type":"address"},{"name":"value","type":"uint256"}],"name":"transfer","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"index","type":"uint256"}],"name":"accountAt","outputs":[{"name":"addr","type":"address"},{"name":"balance","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"getDecimals","outputs":[{"name":"_decimals","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"inputs":[],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"},{"indexed":false,"name":"value","type":"uint256"},{"indexed":false,"name":"message","type":"string"},{"indexed":false,"name":"success","type":"bool"}],"name":"Mint","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"}],"name":"OperatorChanged","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"}],"name":"OwnershipTransferring","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"},{"indexed":false,"name":"value","type":"uint256"},{"indexed":false,"name":"message","type":"string"},{"indexed":false,"name":"success","type":"bool"}],"name":"Transfer","type":"event"}]';

        $method     = 'mint';
        $event_name = 'Mint';
        $params     = [
            'value' => 1000000 * 1000000,
        ];

        $res = SMBCBusinessHostVisitModule::transaction( $target_host, $operator_account, $cnyt_contract, $method, $event_name, $params );
        return $res;
    }

    public
    function CNYTGetBalance( $address )
    {
        $target_host                          = new SMBCBusinessHost();
        $target_host->ip                      = '47.100.185.238';
        $target_host->node_server_listen_port = 9090;

        $cnyt_contract          = new SMBCCurrencyToken();
        $cnyt_contract->address = '0x0f2b0461d231791b6a06b830cc87ccf7e2c265d5';
        $cnyt_contract->abi     = '[{"constant":false,"inputs":[{"name":"_newOperator","type":"address"}],"name":"changeOperator","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"getTotalBalance","outputs":[{"name":"_totalBalance","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"getSymbol","outputs":[{"name":"_symbol","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"getTotalHolders","outputs":[{"name":"count","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"MAX_UINT256","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"getHolders","outputs":[{"name":"holders","type":"address[]"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"owner","type":"address"}],"name":"balanceOf","outputs":[{"name":"balance","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"acceptOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"value","type":"uint256"}],"name":"mint","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"to","type":"address"},{"name":"value","type":"uint256"}],"name":"transfer","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"index","type":"uint256"}],"name":"accountAt","outputs":[{"name":"addr","type":"address"},{"name":"balance","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"getDecimals","outputs":[{"name":"_decimals","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"inputs":[],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"},{"indexed":false,"name":"value","type":"uint256"},{"indexed":false,"name":"message","type":"string"},{"indexed":false,"name":"success","type":"bool"}],"name":"Mint","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"}],"name":"OperatorChanged","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"}],"name":"OwnershipTransferring","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"},{"indexed":false,"name":"value","type":"uint256"},{"indexed":false,"name":"message","type":"string"},{"indexed":false,"name":"success","type":"bool"}],"name":"Transfer","type":"event"}]';

        $method = 'balanceOf';
        $params = [
            //            'to' => '0x2a699d030197505177ccbd3a50d0a6e816387750',
            'to' => $address,
        ];

        $res = SMBCBusinessHostVisitModule::call( $target_host, $cnyt_contract, $method, $params );
        return $res;
    }

    public
    function CNYTTransfer()
    {
        $target_host                          = new SMBCBusinessHost();
        $target_host->ip                      = '47.100.185.238';
        $target_host->node_server_listen_port = 9090;

        $operator_account              = new SMBCAccount();
        $operator_account->address     = '0x2a699d030197505177ccbd3a50d0a6e816387750';
        $operator_account->private_key = 'eae4c677efb4b6656f8520f64ef8a12f7742877bb00322c7c444f27db062e748';

        $cnyt_contract          = new SMBCCurrencyToken();
        $cnyt_contract->address = '0x0f2b0461d231791b6a06b830cc87ccf7e2c265d5';
        $cnyt_contract->abi     = '[{"constant":false,"inputs":[{"name":"_newOperator","type":"address"}],"name":"changeOperator","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"getTotalBalance","outputs":[{"name":"_totalBalance","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"getSymbol","outputs":[{"name":"_symbol","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"getTotalHolders","outputs":[{"name":"count","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"MAX_UINT256","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"getHolders","outputs":[{"name":"holders","type":"address[]"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"owner","type":"address"}],"name":"balanceOf","outputs":[{"name":"balance","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"acceptOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"value","type":"uint256"}],"name":"mint","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"to","type":"address"},{"name":"value","type":"uint256"}],"name":"transfer","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"index","type":"uint256"}],"name":"accountAt","outputs":[{"name":"addr","type":"address"},{"name":"balance","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"getDecimals","outputs":[{"name":"_decimals","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"inputs":[],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"},{"indexed":false,"name":"value","type":"uint256"},{"indexed":false,"name":"message","type":"string"},{"indexed":false,"name":"success","type":"bool"}],"name":"Mint","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"}],"name":"OperatorChanged","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"}],"name":"OwnershipTransferring","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"},{"indexed":false,"name":"value","type":"uint256"},{"indexed":false,"name":"message","type":"string"},{"indexed":false,"name":"success","type":"bool"}],"name":"Transfer","type":"event"}]';

        $method     = 'transfer';
        $event_name = 'Transfer';
        $params     = [
            'to'    => '0x85a390517a83dc4e63650f557890e5a38dde5b65', //pay contract
            'value' => 100000 * 1000000,
        ];

        $res = SMBCBusinessHostVisitModule::transaction( $target_host, $operator_account, $cnyt_contract, $method, $event_name, $params );
        return $res;
    }

    public
    function IRETGetBalance( $address )
    {
        $target_host                          = new SMBCBusinessHost();
        $target_host->ip                      = '47.100.185.238';
        $target_host->node_server_listen_port = 9090;

        $iret_contract          = new SMBCCurrencyToken();
        $iret_contract->address = '0xadc29904c92ac653c33a2d338951a80d279ee52c';
        $iret_contract->abi     = '[{"constant":false,"inputs":[{"name":"_newOperator","type":"address"}],"name":"changeOperator","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"getTotalBalance","outputs":[{"name":"_totalBalance","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"getSymbol","outputs":[{"name":"_symbol","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"getTotalHolders","outputs":[{"name":"count","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"MAX_UINT256","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"getHolders","outputs":[{"name":"holders","type":"address[]"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"owner","type":"address"}],"name":"balanceOf","outputs":[{"name":"balance","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"acceptOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"to","type":"address"},{"name":"value","type":"uint256"}],"name":"transfer","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"index","type":"uint256"}],"name":"accountAt","outputs":[{"name":"addr","type":"address"},{"name":"balance","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"getDecimals","outputs":[{"name":"_decimals","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"inputs":[{"name":"symbol","type":"string"},{"name":"decimals","type":"uint256"},{"name":"total","type":"uint256"}],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"}],"name":"OperatorChanged","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"}],"name":"OwnershipTransferring","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"},{"indexed":false,"name":"value","type":"uint256"},{"indexed":false,"name":"message","type":"string"},{"indexed":false,"name":"success","type":"bool"}],"name":"Transfer","type":"event"}]';

        $method = 'balanceOf';
        $params = [
            'to' => $address,
            //            'to' => '0x2a699d030197505177ccbd3a50d0a6e816387750',
        ];

        $res = SMBCBusinessHostVisitModule::call( $target_host, $iret_contract, $method, $params );
        return $res;
    }

    public
    function IRETTransfer()
    {
        $target_host                          = new SMBCBusinessHost();
        $target_host->ip                      = '47.100.185.238';
        $target_host->node_server_listen_port = 9090;

        $operator_account              = new SMBCAccount();
        $operator_account->address     = '0x2a699d030197505177ccbd3a50d0a6e816387750';
        $operator_account->private_key = 'eae4c677efb4b6656f8520f64ef8a12f7742877bb00322c7c444f27db062e748';

        $cnyt_contract          = new SMBCCurrencyToken();
        $cnyt_contract->address = '0xadc29904c92ac653c33a2d338951a80d279ee52c';
        $cnyt_contract->abi     = '[{"constant":false,"inputs":[{"name":"_newOperator","type":"address"}],"name":"changeOperator","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"getTotalBalance","outputs":[{"name":"_totalBalance","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"getSymbol","outputs":[{"name":"_symbol","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"getTotalHolders","outputs":[{"name":"count","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"MAX_UINT256","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"getHolders","outputs":[{"name":"holders","type":"address[]"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"owner","type":"address"}],"name":"balanceOf","outputs":[{"name":"balance","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"acceptOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"to","type":"address"},{"name":"value","type":"uint256"}],"name":"transfer","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"index","type":"uint256"}],"name":"accountAt","outputs":[{"name":"addr","type":"address"},{"name":"balance","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"getDecimals","outputs":[{"name":"_decimals","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"inputs":[{"name":"symbol","type":"string"},{"name":"decimals","type":"uint256"},{"name":"total","type":"uint256"}],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"}],"name":"OperatorChanged","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"}],"name":"OwnershipTransferring","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"},{"indexed":false,"name":"value","type":"uint256"},{"indexed":false,"name":"message","type":"string"},{"indexed":false,"name":"success","type":"bool"}],"name":"Transfer","type":"event"}]';

        $method     = 'transfer';
        $event_name = 'Transfer';
        $params     = [
            'to'    => '0x7893f1d6cb86298e7e81cc9314b21b62d7ff64ba', //Account2
            'value' => 1 * 100,
        ];

        $res = SMBCBusinessHostVisitModule::transaction( $target_host, $operator_account, $cnyt_contract, $method, $event_name, $params );
        return $res;
    }

    public
    function IRETProfitDistribute()
    {
        $target_host                          = new SMBCBusinessHost();
        $target_host->ip                      = '47.100.185.238';
        $target_host->node_server_listen_port = 9090;

        $operator_account              = new SMBCAccount();
        $operator_account->address     = '0xd7f3fa13b2328da60475843af7ca915f66025640';
        $operator_account->private_key = '262646e248fa61a14b269a79eae1283dfb164eaa5adbe7168029467b3c04913e';

        $profit_contract          = new SMBCCurrencyToken();
        $profit_contract->address = '0x85a390517a83dc4e63650f557890e5a38dde5b65';
        $profit_contract->abi = '[{"constant":false,"inputs":[{"name":"sender","type":"address"},{"name":"value","type":"uint256"},{"name":"token","type":"address"}],"name":"tokenFallback","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_newOperator","type":"address"}],"name":"changeOperator","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[],"name":"pay","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"getIreToken","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"acceptOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"getCnyToken","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"inputs":[{"name":"_ireToken","type":"address"},{"name":"_cnyToken","type":"address"}],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":false,"name":"total","type":"uint256"},{"indexed":false,"name":"residual","type":"uint256"},{"indexed":false,"name":"message","type":"string"},{"indexed":false,"name":"success","type":"bool"}],"name":"Payed","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"}],"name":"OperatorChanged","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"}],"name":"OwnershipTransferring","type":"event"}]';

        $method     = 'pay';
        $event_name = 'Payed';

        $res = SMBCBusinessHostVisitModule::transaction( $target_host, $operator_account, $profit_contract, $method, $event_name );
        return $res;
    }

    public
    function IRETGetHolder()
    {
        $target_host                          = new SMBCBusinessHost();
        $target_host->ip                      = '47.100.185.238';
        $target_host->node_server_listen_port = 9090;

        $iret_contract          = new SMBCCurrencyToken();
        $iret_contract->address = '0xadc29904c92ac653c33a2d338951a80d279ee52c';
        $iret_contract->abi     = '[{"constant":false,"inputs":[{"name":"_newOperator","type":"address"}],"name":"changeOperator","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"getTotalBalance","outputs":[{"name":"_totalBalance","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"getSymbol","outputs":[{"name":"_symbol","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"getTotalHolders","outputs":[{"name":"count","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"MAX_UINT256","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"getHolders","outputs":[{"name":"holders","type":"address[]"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"owner","type":"address"}],"name":"balanceOf","outputs":[{"name":"balance","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"acceptOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"to","type":"address"},{"name":"value","type":"uint256"}],"name":"transfer","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"index","type":"uint256"}],"name":"accountAt","outputs":[{"name":"addr","type":"address"},{"name":"balance","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"getDecimals","outputs":[{"name":"_decimals","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"inputs":[{"name":"symbol","type":"string"},{"name":"decimals","type":"uint256"},{"name":"total","type":"uint256"}],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"}],"name":"OperatorChanged","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"}],"name":"OwnershipTransferring","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"},{"indexed":false,"name":"value","type":"uint256"},{"indexed":false,"name":"message","type":"string"},{"indexed":false,"name":"success","type":"bool"}],"name":"Transfer","type":"event"}]';

        $method = 'getHolders';

        $res = SMBCBusinessHostVisitModule::call( $target_host, $iret_contract, $method );
        var_dump( $res );

        $balance_res = [];
        foreach ( $res->data as $index => $account_address ) {
            $balance          = new \stdClass();
            $balance->address = $account_address;
            $balance->balance = $this->IRETGetBalance( $account_address );
            $balance_res[]    = $balance;
        }
        return $balance_res;
    }

    public
    function CNYTGetHolder()
    {
        $target_host                          = new SMBCBusinessHost();
        $target_host->ip                      = '47.100.185.238';
        $target_host->node_server_listen_port = 9090;

        $cnyt_contract          = new SMBCCurrencyToken();
        $cnyt_contract->address = '0x0f2b0461d231791b6a06b830cc87ccf7e2c265d5';
        $cnyt_contract->abi     = '[{"constant":false,"inputs":[{"name":"_newOperator","type":"address"}],"name":"changeOperator","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"getTotalBalance","outputs":[{"name":"_totalBalance","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"getSymbol","outputs":[{"name":"_symbol","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"getTotalHolders","outputs":[{"name":"count","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"MAX_UINT256","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"getHolders","outputs":[{"name":"holders","type":"address[]"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"owner","type":"address"}],"name":"balanceOf","outputs":[{"name":"balance","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"acceptOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"value","type":"uint256"}],"name":"mint","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"to","type":"address"},{"name":"value","type":"uint256"}],"name":"transfer","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"index","type":"uint256"}],"name":"accountAt","outputs":[{"name":"addr","type":"address"},{"name":"balance","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"getDecimals","outputs":[{"name":"_decimals","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"inputs":[],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"},{"indexed":false,"name":"value","type":"uint256"},{"indexed":false,"name":"message","type":"string"},{"indexed":false,"name":"success","type":"bool"}],"name":"Mint","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"}],"name":"OperatorChanged","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"}],"name":"OwnershipTransferring","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"},{"indexed":false,"name":"value","type":"uint256"},{"indexed":false,"name":"message","type":"string"},{"indexed":false,"name":"success","type":"bool"}],"name":"Transfer","type":"event"}]';

        $method = 'getHolders';

        $res = SMBCBusinessHostVisitModule::call( $target_host, $cnyt_contract, $method );
        var_dump( $res );

        $balance_res = [];
        foreach ( $res->data as $index => $account_address ) {
            $balance          = new \stdClass();
            $balance->address = $account_address;
            $balance->balance = $this->CNYTGetBalance( $account_address );
            $balance_res[]    = $balance;
        }
        return $balance_res;
    }

}