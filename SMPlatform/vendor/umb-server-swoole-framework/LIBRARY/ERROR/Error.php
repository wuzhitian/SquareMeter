<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: Error.php
 * Create: 2018/3/19
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\ERROR;

use \Exception;

/**
 * 异常基础类
 * Class Error
 * @package UmbServer\SwooleFramework\LIBRARY\ERROR
 */
class Error extends Exception
{
    const PREFIX_CODE = '01';
    const ERROR_TYPE  = 'BaseError';
    
    const UNKNOWN_ERROR = [
        'code'    => 0,
        'message' => [
            'CN' => '发生了未知错误',
            'EN' => 'Unknown error',
        ],
    ];
    
    public $error_code;
    public $error_type;
    public $error_message;
    public $error_data;
    
    public
    function __construct( $error = self::UNKNOWN_ERROR, $error_data = NULL )
    {
        $this->error_code    = get_class( $this )::PREFIX_CODE . '-' . sprintf( "%04d", $error[ 'code' ] );
        $this->error_message = $error[ 'message' ];
        $this->error_type    = get_class( $this )::ERROR_TYPE;
        $this->error_data    = $error_data;
    }
    
    private function getErrorMessage( $language = 'EN' )
    {
        return $this->error_message[ $language ];
    }
    
    public
    function getInfo(): \stdClass
    {
        $res                = new \stdClass();
        $res->error_code    = $this->error_code;
        $res->error_type    = $this->error_type;
        $res->error_message = $this->getErrorMessage();
        $res->error_data    = $this->error_data;
        return $res;
    }
}