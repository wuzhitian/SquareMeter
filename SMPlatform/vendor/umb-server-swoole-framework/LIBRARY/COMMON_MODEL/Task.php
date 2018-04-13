<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: Task.php
 * Create: 2018/3/30
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\COMMON_MODEL;

use UmbServer\SwooleFramework\LIBRARY\ENUM\_TaskStatue;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\Instance;
use UmbServer\SwooleFramework\LIBRARY\UTIL\Time;

/**
 * 任务类
 * Class Task
 * @package UmbServer\SwooleFramework\LIBRARY\COMMON_MODEL
 */
class Task extends Instance
{
    const SCHEMA = [
        'requester'                  => OBJECT_TYPE,
        'request_timestamp'          => TIMESTAMP_TYPE,
        'request_confirm_timestamp'  => TIMESTAMP_TYPE,
        'request_data'               => OBJECT_TYPE,
        'responser'                  => OBJECT_TYPE,
        'response_timestamp'         => TIMESTAMP_TYPE,
        'response_confirm_timestamp' => TIMESTAMP_TYPE,
        'statue'                     => INT_TYPE,
        'is_finish'                  => BOOL_TYPE,
        'task_time_span'             => TIMESTAMP_TYPE,
    ];
    
    public $requester; //请求者
    public $request_timestamp; //请求时间戳
    public $request_confirm_timestamp; //请求确认时间戳
    public $request_data; //请求数据
    public $responser; //响应者
    public $response_timestamp; //响应时间戳
    public $response_confirm_timestamp; //响应确认时间戳
    public $response_data; //响应数据
    public $statue = _TaskStatue::CREATE; //任务状态
    public $is_finish = false; //是否完成
    public $task_time_span; //完成时长
    
    /**
     * 设置请求
     * @param $request_data
     * @param $requester
     */
    public
    function request( $request_data, $requester )
    {
        $this->requestStatue();
        $this->setRequester( $requester );
        $this->setRequestData( $request_data );
        $this->update( false );
    }
    
    public
    function requestConfirm()
    {
        $this->requestConfirmStatue();
        $this->request_confirm_timestamp = Time::getNow();
        $this->update( false );
    }
    
    /**
     * 设置响应
     * @param $response_data
     * @param $responser
     */
    public
    function response( $response_data, $responser )
    {
        $this->responseStatue();
        $this->setResponser( $responser );
        $this->setResponseData( $response_data );
        $this->update( false );
    }
    
    public
    function responseConfirm()
    {
        $this->responseConfirmStatue();
        $this->response_confirm_timestamp = Time::getNow();
        $this->update( false );
    }
    
    public
    function finish()
    {
        $this->finishStatue();
        $this->task_time_span = $this->response_confirm_timestamp - $this->request_timestamp;
        $this->update( false );
    }
    
    public
    function fail()
    {
        $this->failStatue();
        $this->update( false );
    }
    
    /**
     * 设置请求者
     * @param $requester
     */
    public
    function setRequester( $requester )
    {
        $this->requester = $requester;
    }
    
    /**
     * 设置响应者
     * @param $responser
     */
    public
    function setResponser( $responser )
    {
        $this->responser = $responser;
    }
    
    /**
     * 设置请求数据
     * @param $request_data
     */
    public
    function setRequestData( $request_data )
    {
        $this->request_data = $request_data;
    }
    
    /**
     * 设置响应数据
     * @param $response_data
     */
    public
    function setResponseData( $response_data )
    {
        $this->response_data = $response_data;
    }
    
    public
    function createStatue()
    {
        $this->setStatue( _TaskStatue::CREATE );
    }
    
    public
    function requestStatue()
    {
        $this->setStatue( _TaskStatue::REQUEST );
    }
    
    public
    function requestConfirmStatue()
    {
        $this->setStatue( _TaskStatue::REQUEST_CONFIRM );
    }
    
    public
    function handlingStatue()
    {
        $this->setStatue( _TaskStatue::HANDLING );
    }
    
    public
    function responseStatue()
    {
        $this->setStatue( _TaskStatue::RESPONSE );
    }
    
    public
    function responseConfirmStatue()
    {
        $this->setStatue( _TaskStatue::RESPONSE_CONFIRM );
    }
    
    public
    function finishStatue()
    {
        $this->setStatue( _TaskStatue::FINISH );
    }
    
    public
    function failStatue()
    {
        $this->setStatue( _TaskStatue::FAIL );
    }
    
    /**
     * 设置任务状态
     * @param int $statue_code
     */
    private
    function setStatue( int $statue_code )
    {
        $this->statue = $statue_code;
    }
}