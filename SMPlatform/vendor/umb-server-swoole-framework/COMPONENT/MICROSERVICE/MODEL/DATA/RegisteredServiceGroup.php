<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: RegisteredServiceGroup.php
 * Create: 2018/4/12
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\MODEL\DATA;

use UmbServer\SwooleFramework\LIBRARY\ENUM\_LoadBalanceStrategy;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\Instance;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\InstanceTrait;
use UmbServer\SwooleFramework\LIBRARY\STRUCTURE\Ring;

/**
 * 注册的服务组类
 * Class RegisteredServiceGroup
 * @package UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\MODEL\DATA
 */
class RegisteredServiceGroup extends Instance
{
    use InstanceTrait;
    
    const TABLE_NAME = 'RegisteredServiceGroup'; //表名
    
    const SCHEMA = [
        'name'                                     => STRING_TYPE,
        'registered_service_target_id_array'       => ARRAY_TYPE,
        'load_balance_strategy'                    => STRING_TYPE,
        'last_access_registered_service_target_id' => STRING_TYPE,
        'authorize_public_key'                     => STRING_TYPE,
        'authorize_token_array'                    => ARRAY_TYPE,
    ];
    
    public $name; //组名
    public $registered_service_target_id_array; //注册的service_id数组
    public $load_balance_strategy; //负载均衡策略
    public $last_access_registered_service_target_id; //最后一次访问的id
    public $authorize_public_key; //授权公钥
    public $authorize_token_array; //授权id数组
    
    /**
     * 获取下一个访问服务对象
     * @return RegisteredServiceTarget
     */
    public
    function getNextRegisteredServiceTarget(): RegisteredServiceTarget
    {
        switch ( $this->load_balance_strategy ) {
            case _LoadBalanceStrategy::POLL: //轮询模式
                $last_access_registered_service_target_index = array_search( $this->last_access_registered_service_target_id, $this->registered_service_target_id_array );
                $registered_service_target_id_ring           = new Ring( $this->registered_service_target_id_array );
                $registered_service_target_id_ring->setCurrent( $last_access_registered_service_target_index );
                $next_registered_service_target_id = $registered_service_target_id_ring->next();
                $next_registered_service_target    = RegisteredServiceTarget::getById( $next_registered_service_target_id );
                break;
            case _LoadBalanceStrategy::CHALLENGE: //竞争模式，考虑is_free
                $registered_service_target_array = $this->getRegisteredServiceTargetArray();
                foreach ( $registered_service_target_array as $registered_service_target ) {
                    if ( $registered_service_target->is_free === true ) {
                        $next_registered_service_target = $registered_service_target;
                        break;
                    }
                }
                break;
            case _LoadBalanceStrategy::SPEED:
            default:
                $registered_service_target_array = $this->getRegisteredServiceTargetArray();
                $next_registered_service_target  = $registered_service_target_array[ 0 ];
                foreach ( $registered_service_target_array as $index => $registered_service_target ) {
                    if ( $registered_service_target->response_time_span < $next_registered_service_target->response_time_span ) {
                        $next_registered_service_target = $registered_service_target;
                    }
                }
        }
        $res = $next_registered_service_target;
        return $res;
    }
    
    /**
     * 获取注册的服务对象数组
     * @return array
     */
    public
    function getRegisteredServiceTargetArray( bool $is_must_health = true ): array
    {
        $res                             = [];
        $registered_service_target_array = RegisteredServiceTarget::getByIdArray( $this->registered_service_target_id_array );
        foreach ( $registered_service_target_array as $registered_service_target ) {
            if ( $is_must_health === true ) {
                if ( $registered_service_target->is_health === true ) {
                    array_push( $res, $registered_service_target );
                }
            } else {
                array_push( $res, $registered_service_target );
            }
        }
        
        return $res;
    }
    
    /**
     * 获取总访问次数
     * @return int
     */
    public
    function getTotalAccessCount(): int
    {
        $res = 0;
        foreach ( $this->getRegisteredServiceTargetArray() as $registered_service_target ) {
            $res += $registered_service_target->access_count;
        }
        return $res;
    }
    
    /**
     * 设置最后一个访问服务的id
     * @param RegisteredServiceTarget $registered_service_target
     */
    public
    function setLastAccessRegisteredServiceTarget( RegisteredServiceTarget $registered_service_target )
    {
        $this->last_access_registered_service_target_id = $registered_service_target->id;
        $this->update( false );
    }
}