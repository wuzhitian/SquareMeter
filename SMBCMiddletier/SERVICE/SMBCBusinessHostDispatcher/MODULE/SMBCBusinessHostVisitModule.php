<?php declare( strict_types = 1 );
/**
 * Project: SMBCMiddletier
 * File: SMBCBusinessHostVisitModule.php
 * Create: 2018/4/15
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMBCMiddletier\SERVICE\SMBCBusinessHostDispatcher;

use SMBCMiddletier\MODEL\BASE\SMBCResponse;
use SMBCMiddletier\MODEL\DATA\SMBCAccount;
use SMBCMiddletier\MODEL\DATA\SMBCBusinessHost;
use SMBCMiddletier\MODEL\DATA\SMBCContract;
use UmbServer\SwooleFramework\LIBRARY\UTIL\Time;

/**
 * 业务机访问模块
 * Class SMBCBusinessHostVisitModule
 * @package SMBCMiddletier\SERVICE\SMBCBusinessHostDispatcher
 */
abstract
class SMBCBusinessHostVisitModule
{
    /**
     * 心跳
     * @param SMBCBusinessHost $target_host
     */
    public static
    function heartBeat( SMBCBusinessHost $target_host )
    {
        $start_timestamp = Time::getNow();
        $res             = self::isConnected( $target_host );
        if ( $res->success === true ) {
            $finish_timestamp                      = Time::getNow();
            $target_host->response_time_span       = $finish_timestamp - $start_timestamp;
            $target_host->last_heartbeat_timestamp = Time::getNow();
            $target_host->update( false );
        }
    }

    /**
     * isConnected最终实现
     * @param SMBCBusinessHost $target_host
     * @return SMBCResponse
     */
    public static
    function isConnected( SMBCBusinessHost $target_host ): SMBCResponse
    {
        $start_timestamp                 = Time::getNow();
        $curl_res                        = $target_host->get( '/isConnected' );
        $finish_timestamp                = Time::getNow();
        $target_host->response_time_span = $finish_timestamp - $start_timestamp;
        $target_host->update( false );
        $smbc_response = new SMBCResponse();
        $smbc_response->setData( $curl_res );
        $smbc_response->setResponser( $target_host );
        $res = $smbc_response;
        return $res;
    }

    /**
     * newAccount最终实现
     * @param SMBCBusinessHost $target_host
     * @return SMBCResponse
     */
    public static
    function newAccount( SMBCBusinessHost $target_host ): SMBCResponse
    {
        $curl_res      = $target_host->get( '/newAccount', [ 'password' => 123456 ] );
        $smbc_response = new SMBCResponse();
        $smbc_response->setData( $curl_res );
        $smbc_response->setResponser( $target_host );
        $res = $smbc_response;
        return $res;
    }

    /**
     * transaction最终实现
     * @param SMBCBusinessHost $target_host
     * @param SMBCAccount $operator_account
     * @param SMBCContract $contract
     * @param string $method
     * @param string $event_name
     * @param $params
     * @return SMBCResponse
     */
    public static
    function transaction( SMBCBusinessHost $target_host, SMBCAccount $operator_account, SMBCContract $contract, string $method, string $event_name, $params = NULL ): SMBCResponse
    {
        $post_params = [
            'caller'     => $operator_account->address,
            'privateKey' => $operator_account->private_key,
            'contract'   => $contract->address,
            'abi'        => $contract->abi,
            'method'     => $method,
            'eventName'  => $event_name,
            'params'     => $params,
        ];
        $target_host->setLastAccess( $operator_account );
        $curl_res      = $target_host->jsonPost( '/transaction', $post_params );
        $smbc_response = new SMBCResponse();
        $smbc_response->setData( $curl_res );
        $smbc_response->setResponser( $target_host );
        $res = $smbc_response;
        return $res;
    }

    /**
     * call最终实现
     * @param SMBCBusinessHost $target_host
     * @param SMBCContract $contract
     * @param string $method
     * @param $params
     * @return SMBCResponse
     */
    public static
    function call( SMBCBusinessHost $target_host, SMBCContract $contract, string $method, $params = NULL ): SMBCResponse
    {
        $post_params   = [
            'contract' => $contract->address,
            'abi'      => $contract->abi,
            'method'   => $method,
            'params'   => $params,
        ];
        $curl_res      = $target_host->jsonPost( '/call', $post_params );
        $smbc_response = new SMBCResponse();
        $smbc_response->setData( $curl_res );
        $smbc_response->setResponser( $target_host );
        $res = $smbc_response;
        return $res;
    }
}