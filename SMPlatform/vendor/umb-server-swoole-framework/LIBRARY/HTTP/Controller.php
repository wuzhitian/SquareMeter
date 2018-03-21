<?php
/**
 * Project: UmbServerSwooleFramework
 * File: Controller.php
 * Create: 2018/3/20
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\HTTP;

use UmbServer\SwooleFramework\LIBRARY\BASE\AOPObject;
use UmbServer\SwooleFramework\LIBRARY\UTIL\DataHandler;

/**
 * 控制器基础类
 * Class Controller
 * @package UmbServer\SwooleFramework\LIBRARY\HTTP
 */
class Controller implements AOPObject
{
    /**
     * http request对象
     * @var
     */
    public $REQUEST;

    /**
     * get数组
     * @var null
     */
    public $GET;

    /**
     * post数组
     * @var null
     */
    public $POST;

    /**
     * header数组
     * @var null
     */
    public $HEADER;

    /**
     * cookie数组
     * @var null
     */
    public $COOKIE;

    /**
     * file数组
     * @var
     */
    public $FILES;

    /**
     * 返回结果
     * @var
     */
    public $RESPONSE;

    /**
     * 构造
     * Controller constructor.
     * @param Request $request
     */
    public function __construct( Request $request )
    {
        $this->REQUEST = $request;
        $this->GET = $request->get ?? NULL;
        $this->POST = $request->post ?? NULL;
        $this->HEADER = $request->header ?? NULL;
        $this->COOKIE = $request->cookie ?? NULL;
        $this->FILES = $request->files ?? NULL;
    }

    /**
     * 前置
     * @return bool
     */
    public function _before(): bool
    {
        return true;
    }

    /**
     * 控制器执行方法
     * @param $function_name
     * @param $arguments
     * @return mixed
     * @throws \ReflectionException
     */
    public function _run( $function_name, $arguments )
    {
        //创建反射对象
        $reflect_method = new \ReflectionMethod( $this, $function_name );
        $expired_reflect_parameter_array = $reflect_method->getParameters();
        $import_arguments = [];
        $required_parameter_key_array = [];
        $import_parameter_array = [];
        $parameter_key_array = [];

        //由反射对象中反映的形参进行赋值
        foreach ( $expired_reflect_parameter_array as $expired_reflect_parameter ) {
            if ( $expired_reflect_parameter->getType() == 'FILES' ) {
                $import_arguments[ $expired_reflect_parameter->getPosition() ] = new FILES( NULL );
            } elseif ( $expired_reflect_parameter->getType() == 'POST' ) {
                $import_arguments[ $expired_reflect_parameter->getPosition() ] = new POST( NULL );
            } elseif ( $expired_reflect_parameter->getType() == 'GET' ) {
                $import_arguments[ $expired_reflect_parameter->getPosition() ] = new GET( NULL );
            }
            $parameter_key_array[] = $expired_reflect_parameter->getName();
            $is_default = $expired_reflect_parameter->isDefaultValueAvailable();
            if ( !$is_default ) {
                $required_parameter_key_array[] = $expired_reflect_parameter->getPosition();
            }
            if ( !empty( $this->FILES ) ) {
                foreach ( $this->FILES as $files_key => $files ) {
                    if ( $expired_reflect_parameter->getType() == 'FILES' ) {
                        if ( $expired_reflect_parameter->getName() == $files_key ) {
                            $import_arguments[ $expired_reflect_parameter->getPosition() ] = new FILES( $files, true );
                            $import_parameter_array[] = $expired_reflect_parameter;
                            break;
                        }
                    }
                }
            }
            if ( !empty( $this->POST ) ) {
                foreach ( $this->POST as $post_key => $post ) {
                    if ( $expired_reflect_parameter->getType() == 'POST' ) {
                        if ( $expired_reflect_parameter->getName() == $post_key ) {
                            $import_arguments[ $expired_reflect_parameter->getPosition() ] = new POST( $post, true );
                            $import_parameter_array[] = $expired_reflect_parameter;
                            break;
                        }
                    }
                }
            }
            if ( !empty( $this->GET ) ) {
                foreach ( $this->GET as $get_key => $get ) {
                    if ( $expired_reflect_parameter->getType() == 'GET' ) {
                        if ( $expired_reflect_parameter->getName() == $get_key ) {
                            $import_arguments[ $expired_reflect_parameter->getPosition() ] = new GET( $get, true );
                            $import_parameter_array[] = $expired_reflect_parameter;
                            break;
                        }
                    }
                }
            }
        }

        //拼装结果并按position重新排列
        ksort( $import_arguments );

        //参数检查
        foreach ( $required_parameter_key_array as $required_parameter_key ) {
            if ( is_null( $import_arguments[ $required_parameter_key ]->getVal() ) ) {
                throw new Error( Error::PARAMETER_ERROR, 'Parameter ' . $parameter_key_array[ $required_parameter_key ] . ' is needed.' );
            }
        }

        //执行控制器方法
        $res = $this->$function_name( ...$import_arguments );

        //设置结果交给after处理
        $this->setResponse( $res );
        return $res;
    }

    /**
     * 后置
     * @return bool
     */
    public function _after(): bool
    {
        $this->setResponse( DataHandler::return ( true, $this->getResponse() ) );
        return true;
    }

    /**
     * 设置response
     * @param Response $response
     * @return bool|mixed
     */
    public function setResponse( Response $response )
    {
        $this->RESPONSE = $response;
        return true;
    }

    /**
     * 获取response
     * @return mixed
     */
    public function getResponse()
    {
        return $this->RESPONSE;
    }
}