<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: Controller.php
 * Create: 2018/3/20
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\HTTP\CONTROLLER;

use UmbServer\SwooleFramework\LIBRARY\ENUM\_HttpRequestVerb;
use UmbServer\SwooleFramework\LIBRARY\ERROR\HttpError;
use UmbServer\SwooleFramework\LIBRARY\EXTEND\GET;
use UmbServer\SwooleFramework\LIBRARY\EXTEND\POST;
use UmbServer\SwooleFramework\LIBRARY\EXTEND\UPLOAD_FILE;
use UmbServer\SwooleFramework\LIBRARY\HTTP\REQUEST\ApiTarget;

/**
 * 控制器基础类
 * Class Controller
 * @package UmbServer\SwooleFramework\LIBRARY\HTTP\CONTROLLER
 */
class Controller implements AOPController
{
    public $VERB;
    public $GET;
    public $POST;
    public $PARAMS;
    public $HEADER;
    public $COOKIE;
    public $FILES;
    public $RESPONSE;

    public
    function __construct( ApiTarget $api_target )
    {
        $this->VERB = $api_target->verb;
        switch ( $this->VERB ) {
            case _HttpRequestVerb::UPLOAD_FILE:
                $this->PARAMS      = $api_target->files;
                $this->UPLOAD_FILE = $api_target->files;
                break;
            case _HttpRequestVerb::GET:
                $this->PARAMS = $api_target->params;
                $this->GET    = $api_target->params;
                break;
            case _HttpRequestVerb::POST:
            default:
                $this->PARAMS = $api_target->params;
                $this->POST   = $api_target->params;
        }
        $this->HEADER = $api_target->header;
        $this->COOKIE = $api_target->cookie;
    }

    /**
     * 前置
     * @return bool
     */
    public
    function _before(): bool
    {
        return true;
    }

    /**
     * 控制器执行方法
     * @param $function_name
     * @param $arguments
     * @return mixed
     * @throws HttpError
     * @throws \ReflectionException
     */
    public
    function _run( $function_name, $arguments )
    {
        //创建反射对象
        $reflect_method                  = new \ReflectionMethod( $this, $function_name );
        $expired_reflect_parameter_array = $reflect_method->getParameters();
        $import_arguments                = [];
        $required_parameter_key_array    = [];
        $import_parameter_array          = [];
        $parameter_key_array             = [];

        //由反射对象中反映的形参进行赋值
        foreach ( $expired_reflect_parameter_array as $expired_reflect_parameter ) {
            if ( $expired_reflect_parameter->getClass()->name === UPLOAD_FILE::class ) {
                $import_arguments[ $expired_reflect_parameter->getPosition() ] = new UPLOAD_FILE( NULL );
            } elseif ( $expired_reflect_parameter->getClass()->name === POST::class ) {
                $import_arguments[ $expired_reflect_parameter->getPosition() ] = new POST( NULL );
            } elseif ( $expired_reflect_parameter->getClass()->name === GET::class ) {
                $import_arguments[ $expired_reflect_parameter->getPosition() ] = new GET( NULL );
            }
            $parameter_key_array[] = $expired_reflect_parameter->getName();
            $is_default            = $expired_reflect_parameter->isDefaultValueAvailable();
            if ( !$is_default ) {
                $required_parameter_key_array[] = $expired_reflect_parameter->getPosition();
            }
            if ( !empty( $this->FILES ) ) {
                foreach ( $this->FILES as $files_key => $files ) {
                    if ( $expired_reflect_parameter->getClass()->name === UPLOAD_FILE::class ) {
                        if ( $expired_reflect_parameter->getName() === $files_key ) {
                            $import_arguments[ $expired_reflect_parameter->getPosition() ] = new UPLOAD_FILE( $files, true );
                            $import_parameter_array[]                                      = $expired_reflect_parameter;
                            break;
                        }
                    }
                }
            }
            if ( !empty( $this->POST ) ) {
                foreach ( $this->POST as $post_key => $post ) {
                    if ( $expired_reflect_parameter->getClass()->name === POST::class ) {
                        if ( $expired_reflect_parameter->getName() === $post_key ) {
                            $import_arguments[ $expired_reflect_parameter->getPosition() ] = new POST( $post, true );
                            $import_parameter_array[]                                      = $expired_reflect_parameter;
                            break;
                        }
                    }
                }
            }
            if ( !empty( $this->GET ) ) {
                foreach ( $this->GET as $get_key => $get ) {
                    if ( $expired_reflect_parameter->getClass()->name === GET::class ) {
                        if ( $expired_reflect_parameter->getName() === $get_key ) {
                            $import_arguments[ $expired_reflect_parameter->getPosition() ] = new GET( $get, true );
                            $import_parameter_array[]                                      = $expired_reflect_parameter;
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
                throw new HttpError( HttpError::NECESSARY_PARAMETER_MISSING, 'Parameter "' . $parameter_key_array[ $required_parameter_key ] . '" is necessary' );
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
    public
    function _after(): bool
    {
        return true;
    }

    /**
     * 设置response
     * @param $response
     * @return bool|mixed
     */
    public
    function setResponse( $response )
    {
        $this->RESPONSE = $response;
        return true;
    }

    /**
     * 获取response
     * @return mixed
     */
    public
    function getResponse()
    {
        return $this->RESPONSE;
    }

    /**
     * 获取result
     */
    public
    function getRes()
    {
        $res = $this->getResponse();
        return $res;
    }

    /**
     * 控制器通用的isConnected接口
     * @return bool
     */
    public
    function isConnected(): bool
    {
        return true;
    }
}