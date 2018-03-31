<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: Service.php
 * Create: 2018/3/17
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\MODEL;

use UmbServer\SwooleFramework\COMPONENT\CORE\SERVER\HttpApiServer;
use UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\ENUM\_ServiceMode;
use UmbServer\SwooleFramework\COMPONENT\SERVER\CONFIG\ServerConfig;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\Instance;

/**
 * 微服务基础类
 * Class Service
 * @package UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\MODEL
 */
class Service extends Instance
{
    const SERVICE_MODE = _ServiceMode::HTTP_API_SERVICE; //service模式
    
    private $_server; //内置服务器对象
    private $_config;
    
    /**
     * 设置
     * @param $config
     */
    public
    function setConfig( $config )
    {
        $this->_config = $config;
    }
    
    /**
     * 获取config对象
     */
    private function getConfig(): ServerConfig
    {
        return $this->_config;
    }
    
    /**
     * 获取服务类型
     * @return string
     */
    private function getServiceMode(): string
    {
        $classpath = get_class( $this );
        $res       = $classpath::SERVICE_MODE;
        return $res;
    }
    
    /**
     * 初始化服务
     */
    private function initial()
    {
        //根据service_mode初始化内置server对象
        $service_mode = $this->getServiceMode();
        switch ( $service_mode ) {
            case _ServiceMode::TCP_RPC_SERVICE:
                $this->initialTcpRpcServer();
                break;
            case _ServiceMode::HTTP_RESOURCE_SERVICE:
                $this->initialHttpResourceServer();
                break;
            case _ServiceMode::HTTP_API_SERVICE:
            default:
                $this->initialHttpApiServer();
        }
    }
    
    private function initialHttpApiServer()
    {
        $this->_server = HttpApiServer::getInstance();
    }
    
    private function initialHttpResourceServer()
    {
        $this->_server =
    }
    
    private function initialTcpRpcServer()
    {
    }
  
    
    /**
     * http_api_server开启完成，并启动了worker时的回调
     */
    public
    function onWorkerStart()
    {
        $this->connect();
    }
    
    /**
     * 根据is_http_api_server来启动service
     */
    public
    function start()
    {
        if ( $this->is_server ) {
            $this->initServer();
            $this->service_server->start();
        } else {
            $this->connect();
        }
    }
    
    /**
     * parsePhp
     * 用于解析php页面，以字符串形式返回结果
     *
     * @param $url
     * 解析的php文件的url
     * @param $request
     * 传入到html里的值
     *
     * @return string   返回静态html字符串
     */
    public
    function parsePhp( $url, $request )
    {
        flush();
        ob_start();
        $_REQUEST = $request;
        $_POST    = $request->post ?? NULL;
        $_GET     = $request->get ?? NULL;
        include( $url );
        $contents = ob_get_contents();
        ob_end_clean();
        return $contents;
    }
    
    /**
     * 非server模式下，发起TcpClient对Engine的连接
     */
    public
    function connect()
    {
        $client = $this->setServiceTcpClient();
        $client->setHandler( $this );
        $client->connect();
    }
    
    /**
     * 设置service中的TcpClient对象
     * @return \SLFramework\COMPONENT\ServiceAsyncTcpClient
     */
    public
    function setServiceTcpClient()
    {
        if ( isset( $this->service_async_tcp_client ) ) {
            unset( $this->service_async_tcp_client );
        }
        $connect                        = SLFManager::getInstance()->getConnectInfo();
        $this->service_async_tcp_client = new ServiceAsyncTcpClient( $connect );
        $this->service_async_tcp_client->setEOF( "\r\n" );
        return $this->service_async_tcp_client;
    }
    
    /**
     * 获取service中的AsyncTcpClient对象
     * @return \SLFramework\COMPONENT\ServiceAsyncTcpClient
     */
    public
    function getServiceAsyncTcpClient(): ServiceAsyncTcpClient
    {
        return $this->service_async_tcp_client;
    }
    
    /**
     * 回复错误信息
     *
     * @param $request
     * @param $error_msg
     */
    public
    function replyServiceError( $request, $error_msg )
    {
        $response[ 'msg_type' ]        = 'reply';
        $response[ 'access_token' ]    = $this->access_token;
        $response[ 'from_service_id' ] = $this->id;
        $response[ 'task_id' ]         = $request[ 'task_id' ];
        $response[ 'ask_uri' ]         = $request[ 'ask_uri' ];
        $response[ 'reply_success' ]   = false;
        $response[ 'reply_error_msg' ] = $error_msg;
        $response[ 'reply_timestamp' ] = Time::getNow();
        $this->send( $response );
    }
    
    /**
     * 同步处理ask，并reply
     *
     * @param $request
     *
     * @return bool|mixed
     */
    public
    function askHandle( $request )
    {
        $ask_uri    = $request[ 'ask_uri' ];
        $parse_uri  = $this->parseUri( $ask_uri );
        $controller = $parse_uri[ 'controller' ];
        $function   = $parse_uri[ 'function' ];
        $file_path  = $parse_uri[ 'file_path' ];
        // var_dump($file_path);
        //控制器不存在
        if ( !file_exists( $file_path ) ) {
            $this->replyServiceError( $request, 'Ask uri error.' );
            return false;
        } else {
            //加载控制器类controller
            include_once( $file_path );
            //异步请求不使用AOP
            $controller_class = new $controller( $request );
            $reply_result     = $controller_class->$function();
            //如果ask不要求返回，就不返回
            if ( $request[ 'ask_need_reply' ] == false ) {
                return true;
            }
            $reply_success = true;
        }
        //处理请求失败的情况
        if ( $reply_result == false ) {
            $reply_success   = false;
            $reply_error_msg = $reply_result[ 'error_msg' ] ?? NULL;
        }
        //组装response体
        $response = [
            'reply_result'    => $reply_result,
            'reply_success'   => $reply_success,
            'reply_error_msg' => $reply_error_msg ?? NULL,
        ];
        //reply此ask
        $res = $this->reply( $request, $response );
        return $res;
    }
    
    /**
     * 将成功的result传给ask_uri的回调函数，并回传delivered
     *
     * @param $response
     *
     * @return mixed
     */
    public
    function replyHandle( $response )
    {
        //这里要先回传delivered，不然可能会记时不准确
        $delivered_msg = [
            'access_token'        => $this->access_token,
            'msg_type'            => 'delivered',
            'task_id'             => $response[ 'task_id' ],
            'delivered_timestamp' => Time::getNow(),
        ];
        $res           = $this->delivered( $delivered_msg );
        if ( $response[ 'reply_success' ] ) {
            $ask_callback_function = $response[ 'ask_callback_function' ];
            //将处理完成的wait_queue的is_callback设为true
            $wait_queue               = $this->getWaitQueueByTaskId( $response[ 'task_id' ] );
            $response[ 'ask_params' ] = $wait_queue->ask_params;
            $wait_queue->callback();
            //释放掉已经处理完成的wait_queue
            $this->releaseWaitQueue();
            $this->$ask_callback_function( $response );
        } else {
            echo 'task_id: ' . $response[ 'task_id' ] . PHP_EOL;
            echo 'ask_uri: ' . $response[ 'ask_uri' ] . PHP_EOL;
            echo 'error_msg: ' . $response[ 'reply_error_msg' ] . PHP_EOL;
        }
        return $res;
    }
    
    /**
     * 通过task_id找到需要reply的wait_queue
     *
     * @param $task_id
     *
     * @return \SLFramework\OBJECT\WaitQueue
     */
    public
    function getWaitQueueByTaskId( $task_id ): WaitQueue
    {
        $res = NULL;
        foreach ( $this->wait_queues as $wait_queue ) {
            if ( $wait_queue->task_id == $task_id ) {
                $res = $wait_queue;
            }
        }
        return $res;
    }
    
    /**
     * 释放掉已经处理完成的wait_queue
     */
    private
    function releaseWaitQueue()
    {
        foreach ( $this->wait_queues as $key => $wait_queue ) {
            if ( $wait_queue->is_callback ) {
                unset( $this->wait_queues[ $key ] );
            }
        }
    }
    
    /**
     * 注册服务到DE
     */
    public
    function register()
    {
        $register_msg = [
            'msg_type'        => 'register_ask',
            'from_service_id' => $this->id,
            'service_type'    => $this->type,
        ];
        $this->send( $register_msg );
    }
    
    /**
     * 处理注册事务回调
     *
     * @param $request
     */
    public
    function registerCallback( $request )
    {
        if ( $request[ 'register_reply_success' ] ) {
            $this->access_token = $request[ 'access_token' ];
            $this->getServiceAsyncTcpClient()->startCheckTicker();
        } else {
            echo 'service_id: ' . $request[ 'from_service_id' ] . ' service_type: ' . $request[ 'service_type' ] . ' register error.' . PHP_EOL;
            echo 'error_msg: ' . $request[ 'register_reply_error_msg' ] . '.' . PHP_EOL;
        }
    }
    
    /**
     * 作为ask方，发起任务，由发起者提出task_id
     *
     * @param $request
     *
     * @return bool|mixed
     */
    public
    function ask( $request )
    {
        $ask_msg                      = $request;
        $ask_msg[ 'access_token' ]    = $this->access_token;
        $ask_msg[ 'msg_type' ]        = 'ask';
        $ask_msg[ 'from_service_id' ] = $this->id;
        $ask_msg[ 'task_id' ]         = Generator::uuid();
        $ask_msg[ 'ask_need_reply' ]  = $request[ 'ask_need_reply' ] ?? true;
        $ask_msg[ 'ask_params' ]      = $request[ 'ask_params' ] ?? NULL;
        $ask_msg[ 'ask_is_outbound' ] = $request[ 'ask_is_outbound' ] ?? false;
        $ask_msg[ 'ask_timestamp' ]   = Time::getNow();
        $res                          = $this->send( $ask_msg );
        //发送成功，且ask_need_reply为true就保存为wait_queue
        if ( $res && $ask_msg[ 'ask_need_reply' ] ) {
            $wait_queue          = new WaitQueue( $ask_msg );
            $this->wait_queues[] = $wait_queue;
        }
        // var_dump($res);
        // var_dump($ask_msg['ask_need_reply']);
        return $res;
    }
    
    /**
     * 作为reply方收到任务，做出回复
     *
     * @param $request
     * @param $response
     *
     * @return mixed
     */
    public
    function reply( $request, $response )
    {
        $reply_msg                      = $response;
        $reply_msg[ 'access_token' ]    = $this->access_token;
        $reply_msg[ 'from_service_id' ] = $this->id;
        $reply_msg[ 'msg_type' ]        = 'reply';
        $reply_msg[ 'task_id' ]         = $request[ 'task_id' ];
        $reply_msg[ 'reply_timestamp' ] = Time::getNow();
        $res                            = $this->send( $reply_msg );
        return $res;
    }
    
    /**
     * 作为ask方发出任务，收到回复以后的已送成确认
     *
     * @param $request
     *
     * @return mixed
     */
    public
    function delivered( $request )
    {
        $delivered_msg[ 'access_token' ]        = $this->access_token;
        $delivered_msg[ 'from_service_id' ]     = $this->id;
        $delivered_msg[ 'msg_type' ]            = 'delivered';
        $delivered_msg[ 'task_id' ]             = $request[ 'task_id' ];
        $delivered_msg[ 'delivered_timestamp' ] = Time::getNow();
        $res                                    = $this->send( $delivered_msg );
        return $res;
    }
    
    /**
     * 封装发送数据给DE的方法，成功会返回数据长度，失败会返回false
     *
     * @param $data
     *
     * @return mixed
     */
    private
    function send( $data )
    {
        $client = $this->getServiceAsyncTcpClient();
        $res    = $client->send( $data );
        // var_dump( $data );
        return $res;
    }
}