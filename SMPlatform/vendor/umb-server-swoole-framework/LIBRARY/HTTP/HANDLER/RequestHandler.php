<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: RequestHandler.php
 * Create: 2018/3/24
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\HTTP\HANDLER;

use UmbServer\SwooleFramework\COMPONENT\SERVER\HttpServer;
use UmbServer\SwooleFramework\LIBRARY\BASE\AOP;
use UmbServer\SwooleFramework\LIBRARY\ENUM\_ContentType;
use UmbServer\SwooleFramework\LIBRARY\ENUM\_HttpResponseStatus;
use UmbServer\SwooleFramework\LIBRARY\ENUM\_HttpServer;
use UmbServer\SwooleFramework\LIBRARY\ENUM\_InstanceBaseOperator;
use UmbServer\SwooleFramework\LIBRARY\ENUM\_Serialize;
use UmbServer\SwooleFramework\LIBRARY\ERROR\Error;
use UmbServer\SwooleFramework\LIBRARY\ERROR\HttpError;
use UmbServer\SwooleFramework\LIBRARY\HTTP\REQUEST\ApiTarget;
use UmbServer\SwooleFramework\LIBRARY\HTTP\REQUEST\Request;
use UmbServer\SwooleFramework\LIBRARY\HTTP\REQUEST\RequestTarget;
use UmbServer\SwooleFramework\LIBRARY\HTTP\REQUEST\ResourceTarget;
use UmbServer\SwooleFramework\LIBRARY\HTTP\RESPONSE\Response;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\Instance;
use UmbServer\SwooleFramework\LIBRARY\UTIL\Console;
use UmbServer\SwooleFramework\LIBRARY\UTIL\DataHandler;
use UmbServer\SwooleFramework\LIBRARY\UTIL\Serialize;

/**
 * 针对request_target的处理器类
 * class RequestHandler
 * @package UmbServer\SwooleFramework\LIBRARY\HTTP\HANDLER
 */
class RequestHandler
{
    private $_request; //内置request对象
    private $_response; //内置response对象
    private $_http_server; //内置http_server对象
    private $_request_target; //内置request_target对象

    public $success = true; //请求是否成功
    public $error; //错误信息
    public $data; //返回数据
    public $instances; //影响实例

    /**
     * 构造
     * RequestHandler constructor.
     * @param HttpServer $http_server
     */
    public
    function __construct( HttpServer $http_server )
    {
        $this->_http_server    = $http_server;
        $this->_request        = $http_server->getRequest();
        $this->_response       = $http_server->getResponse();
        $this->_request_target = $http_server->getRequestTarget();
    }

    /**
     * 获取request对象
     * @return Request
     */
    private
    function getRequest(): Request
    {
        return $this->_request;
    }

    /**
     * 获取response对象
     * @return Response
     */
    private
    function getResponse(): Response
    {
        return $this->_response;
    }

    /**
     * 获取target对象
     * @return RequestTarget
     */
    private
    function getRequestTarget(): RequestTarget
    {
        return $this->_request_target;
    }

    /**
     * 获取api目标对象
     * @return ApiTarget
     */
    private
    function getApiTarget(): ApiTarget
    {
        return $this->getRequestTarget()->getApiTarget();
    }

    /**
     * 获取resource目标对象
     * @return ResourceTarget
     */
    private
    function getResourceTarget(): ResourceTarget
    {
        return $this->getRequestTarget()->getResourceTarget();
    }

    /**
     * 根据http服务器类型判断http_request类型是api还是resource
     * @return string
     */
    private
    function getRequestType(): string
    {
        $res = $this->getRequestTarget()->getHttpServerType();
        return $res;
    }

    /**
     * 处理请求
     */
    public
    function handle()
    {
        switch ( $this->getRequestType() ) {
            case _HttpServer::API:
                try {
                    Console::log( $this->getApiTarget() );
                    $controller_file_path = $this->getApiTarget()->getTargetFilePath();
                    $controller_classpath = $this->getApiTarget()->getControllerClasspath();

                    //检查控制器是否存在
                    if ( !file_exists( $controller_file_path ) ) {
                        $this->getResponse()->setStatus( _HttpResponseStatus::NOT_FOUND );
                        throw new HttpError( HttpError::CONTROLLER_NOT_FOUND, 'Controller "' . $controller_classpath . '" is not found' );

                    }

                    //引用控制器文件
                    include_once( $controller_file_path );
                    $controller               = new $controller_classpath( $this->getApiTarget() );
                    $aop_controller_container = new AOP();
                    $aop_controller_container->setObject( $controller );
                    $method_name = $this->getApiTarget()->getMethodName();

                    //检查方法是否存在
                    if ( !method_exists( $aop_controller_container->getObject(), $method_name ) ) {
                        $this->getResponse()->setStatus( _HttpResponseStatus::NOT_FOUND );
                        throw new HttpError( HttpError::METHOD_NOT_FOUND, 'Method "' . $method_name . '" is not found' );
                    }
                    $this->data = $aop_controller_container->$method_name();
                    $res        = $this->getApiRequestEncodeRes();
                }
                catch ( Error $e ) {
                    $this->success = false;
                    $this->error   = $e->getInfo();
                    $res           = $this->getApiRequestEncodeRes();
                }
                $this->getResponse()->setContent( $res, _ContentType::API );
                break;
            case _HttpServer::RESOURCE:
            default:
                $res = '';
                $this->getResourceTarget()->prepare();
                $this->getResponse()->setContent( $res, _ContentType::html );
        }
    }

    /**
     * 获取api请求结果并序列化
     * @param string $encode_type
     * @return string
     */
    private
    function getApiRequestEncodeRes( string $encode_type = _Serialize::JSON ): string
    {
        $api_request_res            = new \stdClass();
        $api_request_res->success   = $this->success;
        $api_request_res->error     = $this->error;
        $api_request_res->data      = $this->data;
        $api_request_res->instances = $this->instances;
        $res                        = Serialize::encode( $api_request_res, $encode_type );
        return $res;
    }

    /**
     * api请求过程中影响过的实例修改收集
     * @param string $operator
     * @param Instance $instance
     */
    public
    function addInfluenceInstance( string $operator, Instance $instance )
    {
        switch ( $operator ) {
            case _InstanceBaseOperator::CREATE:
                $this->addCreateInstance( $instance );
                break;
            case _InstanceBaseOperator::READ:
                $this->addReadInstance( $instance );
                break;
            case _InstanceBaseOperator::DELETE:
                $this->addDeleteInstance( $instance );
                break;
            case _InstanceBaseOperator::UPDATE:
            default:
                $this->addUpdateInstance( $instance );
        }
    }

    /**
     * 添加新实例
     * @param Instance $instance
     */
    private
    function addCreateInstance( Instance $instance )
    {
        $this->instances->create[] = [
            'class_name' => $instance->getClientInstancePoolClassName(),
            'instance'   => $instance->getData(),
        ];
    }

    /**
     * 获取新实例
     * @param Instance $instance
     */
    private
    function addReadInstance( Instance $instance )
    {
        $this->instances->read[] = [
            'class_name' => $instance->getClientInstancePoolClassName(),
            'instance'   => $instance->getData(),
        ];
    }

    /**
     * 更新实例
     * @param Instance $instance
     */
    private
    function addUpdateInstance( Instance $instance )
    {
        $this->instances->update[] = [
            'class_name' => $instance->getClientInstancePoolClassName(),
            'instance'   => $instance->getData(),
        ];
    }

    /**
     * 删除实例
     * @param Instance $instance
     */
    private
    function addDeleteInstance( Instance $instance )
    {
        $this->instances->delete[] = [
            'class_name' => $instance->getClientInstancePoolClassName(),
            'instance'   => [
                'id' => $instance->id,
            ],
        ];;
    }

    private
    function requireController()
    {

    }

    private
    function getResourceContent()
    {

    }
}