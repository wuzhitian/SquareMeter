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

/**
 * 微服务基础类
 * Class Service
 * @package UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\MODEL
 */
class Service
{
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
     * 与Engine的连接验证
     * @var
     */
    public $access_token;

    /**
     * service的AsyncTcpClient对象
     * @var
     */
    public $service_async_tcp_client;

    /**
     * service的server对象
     * @var
     */
    public $service_server;

    /**
     * 已经发出但没有响应的队列
     * @var array
     */
    public $wait_queues = [];

    /**
     * 初始化server
     * @return bool
     */
    private
    function initServer()
    {
        $this->apiServer();
        return true;
    }

    /**
     * 启动api server
     */
    private
    function apiServer()
    {
        $this->service_server = new \swoole_http_server( $this->server_listen_ip, $this->server_listen_port, SWOOLE_BASE, SWOOLE_SOCK_TCP );
        $this->service_server->set( [
            'react_num'          => 128,
            'worker_num'         => 128,    //开启两个worker进程
            'package_max_length' => 500 * 1024 * 1024,
            'upload_tmp_dir'     => '/data/uploadfiles',
            'buffer_output_size' => 500 * 1024 * 1024,
        ] );
        $this->bindCallback();
    }

    /**
     * 获取对应的host_data对象
     * @return \SLFramework\DATA\HostData
     */
    public
    function getHostData(): HostData
    {
        $host_data = HostData::_getById( $this->host_id );
        return $host_data;
    }

    /**
     * http_api_server绑定回调事件
     */
    public
    function bindCallback()
    {
        $this->service_server->on( 'Start', [
            $this,
            'onStart',
        ] );
        $this->service_server->on( 'Shutdown', [
            $this,
            'onShutdown',
        ] );
        $this->service_server->on( 'Request', [
            $this,
            'onRequest',
        ] );
        $this->service_server->on( 'WorkerStart', [
            $this,
            'onWorkerStart',
        ] );
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
     * server开启时的回调
     */
    public
    function onStart()
    {
        echo 'onStart:: ' . GRManager::getInstance()->BI[ 'company_name' ] . ' ' . GRManager::getInstance()->BI[ 'project_name' ] . ' ' . $this->type . ' ' . $this->server_protocol . ' ' . $this->server_type . ' Server started successfully.' . PHP_EOL;
        echo $this->getHostData()->WAN_ip . ':' . $this->server_listen_port . PHP_EOL;
    }

    /**
     * server关闭时的回调
     */
    public
    function onShutdown()
    {
        echo 'onShutdown:: ' . GRManager::getInstance()->BI[ 'company_name' ] . ' ' . GRManager::getInstance()->BI[ 'project_name' ] . ' ' . $this->type . ' ' . $this->server_protocol . ' ' . $this->server_type . ' Server stopped successfully.' . PHP_EOL;
    }

    /**
     * 解析uri
     *
     * @param $uri
     * @param $server_type
     *
     * @return array
     */
    private
    function parseUri( $uri, $server_type = 'api' )
    {
        if ( $server_type == 'api' ) {
            // 把请求的path字符串拆分为数组，用array_filter去空
            $path_array = explode( '/', $uri );

            // 如果没有写控制器名称，默认为index
            $controller_name = $path_array[ sizeof( $path_array ) - 2 ] ?? '/index';
            $function_name   = $path_array[ sizeof( $path_array ) - 1 ];

            // 遍历controller和function的路径深度，组成$path
            $path = '/';
            foreach ( $path_array as $key => $dir ) {
                if ( $key > sizeof( $path_array ) - 3 ) {
                    break;
                }
                if ( $dir == '' ) {
                    continue;
                }
                $path .= ( $dir . '/' );
            }
            $file_path = $this->getHostData()->deploy_root . $this->path . $path . $controller_name . '.php';
            $res       = [
                'controller' => $controller_name,
                'function'   => $function_name,
                'file_path'  => $file_path,
            ];
        } else {
            $file_path = $this->getHostData()->deploy_root . $this->path . $uri;
            $res       = [
                'file_path' => $file_path,
            ];
        }

        // var_dump( $res );
        return $res;
    }

    /**
     * http_api_server收到信息的回调
     *
     * @param $request
     * @param $response
     *
     * @return bool
     */
    public
    function onRequest( $request, $response )
    {
        //请求过滤，否则favicon的附带请求会让服务端频繁报错，虽然不会影响运行
        if ( $request->server[ 'request_uri' ] == '/favicon.ico' ) {
            $response->status( 404 );
            $response->end();
            return false;
        }

        if ( $this->server_type == 'api' ) {
            //处理application/json格式的post体，加载到request中
            if ( array_key_exists( 'accept', $request->header ) && $request->header[ 'accept' ] == 'application/json' ) {
                $request->post = json_decode( $request->rawContent(), true );
            }
            var_dump( $request );
            $parse_uri  = $this->parseUri( $request->server[ 'request_uri' ] );
            $controller = $parse_uri[ 'controller' ];
            $function   = $parse_uri[ 'function' ];
            $file_path  = $parse_uri[ 'file_path' ];
            //控制器不存在
            if ( !file_exists( $file_path ) ) {
                $response->status( 404 );
                $response->end();
                return false;
            }

            //加载控制器类controller
            include_once( $file_path );
            $controller_object = new AOP( $controller, $request );
            $res               = $controller_object->$function();
            $response->header( 'Access-Control-Allow-Origin', '*' );
            $response->end( $res );
            return true;
        } elseif ( $this->server_type == 'web' ) {
            $parse_uri = $this->parseUri( $request->server[ 'request_uri' ], 'web' );
            $file_path = $parse_uri[ 'file_path' ];
            $file_path = explode( '%', $file_path )[ 0 ];
            $file_type = array_reverse( explode( '.', $file_path ) )[ 0 ];

            echo $file_path . PHP_EOL;

            $response->header( 'Access-Control-Allow-Origin', '*' );
            switch ( $file_type ) {
                case 'mp4':
                    var_dump( $request );
                    $file_string = file_get_contents( $file_path );
                    $file_size   = strlen( $file_string );
                    var_dump( $file_size );
                    $range = $request->header[ 'range' ];

                    $a = explode( '=', $range )[ 1 ];
                    $b = explode( '-', $a );

                    var_dump( $range );
                    var_dump( $a );
                    var_dump( $b );
                    $start = 0;
                    $end   = $file_size - 1;
                    if ( isset( $b ) ) {
                        $start = (int)$b[ 0 ];
                        if ( $b[ 1 ] != '' ) {
                            $end = (int)$b[ 1 ];
                        }
                    }
                    $length = $end - $start + 1;

                    echo 'start:' . $start . PHP_EOL;
                    echo 'end:' . $end . PHP_EOL;
                    echo 'length:' . $length . PHP_EOL;

                    if ( isset( $range ) ) {
                        $response->status( 206 );
                    }

                    $response->header( 'Accept-Ranges', 'bytes' );
                    $response->header( 'Content-Type', 'video/mp4' );
                    $response->header( 'Content-Range', 'bytes ' . $start . '-' . $end . '/' . $file_size );
                    $response->header( 'Etag', '"' . md5( $file_string ) . '"' );
                    // $response->write( '\q' );
                    // $response->end();
                    $response->sendfile( $file_path, $start, $length );
                    break;
                case 'css':
                    $response->header( 'Content-Type', 'text/css' );
                    $response->gzip( 5 );
                    $response->end( file_get_contents( $file_path ) );
                    break;
                case 'php':
                    $response->header( 'Content-Type', 'text/html' );
                    $response->gzip( 5 );
                    $response->end( $this->parsePhp( $file_path, $request ) );
                    break;
                case 'html':
                    $response->header( 'Content-Type', 'text/html' );
                    $response->gzip( 5 );
                    $response->end( file_get_contents( $file_path ) );
                    break;
                case 'png':
                    $response->header( 'Content-Type', 'image/png' );
                    $response->gzip( 5 );
                    $response->end( file_get_contents( $file_path ) );
                    break;
                case 'jpg':
                case 'jpeg':
                    $response->header( 'Content-Type', 'image/jpeg' );
                    $response->gzip( 5 );
                    $response->end( file_get_contents( $file_path ) );
                    break;
                case 'js':
                    $response->header( 'Content-Type', 'text/javascript' );
                    $response->gzip( 5 );
                    $response->write( file_get_contents( $file_path ) );
                    $response->end();
                    break;
                default:
                    $response->header( 'Content-Type', 'text/plain' );
                    $response->gzip( 5 );
                    $response->write( file_get_contents( $file_path ) );
                    $response->end();
                    break;
            }
            return true;
        } else {
            $dispatch_token = explode( '/', $request->server[ 'request_uri' ] )[ 1 ];
            DispatchData::_initAll();
            $dispatch_url = DispatchManager::getTargetByToken( $dispatch_token );
            var_dump( $dispatch_url );
            if ( !$dispatch_url ) {
                $response->status( 404 );
                $response->end( 'Dispatch token not found.' );
            } else {
                $response->header( 'Location', $dispatch_url );
                $response->status( 302 );
                $response->end();
                return true;
            }
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
        $_POST    = $request->post ?? null;
        $_GET     = $request->get ?? null;
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