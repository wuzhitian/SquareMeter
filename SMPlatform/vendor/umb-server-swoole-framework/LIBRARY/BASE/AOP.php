<?php
/**
 * Project: UmbServerSwooleFramework
 * File: AOP.php
 * Create: 2018/3/12
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\CORE\BASE;

/**
 * 切面对象访问控制类
 * Class AOP
 * @package UmbServer\SwooleFramework\BASE\BASE
 */
class AOP
{
    /**
     * 受控制的对象
     */
    private $_object;

    /**
     * 内部构造切面访问对象
     * AOP constructor.
     *
     * @param $object
     * @param $request
     */
    public function __construct( $object, $request )
    {
        $this->object_name = $object;
        $this->_object = new $object( $request );
    }

    /**
     * 获取切面对象
     * @return AOPObject
     */
    private function getObject(): AOPObject
    {
        return $this->_object;
    }

    /**
     * 访问切面
     *
     * @param $function_name
     * @param $arguments
     *
     * @return string
     */
    public function __call( $function_name, $arguments )
    {
        try {
            if ( !method_exists( $this->getObject(), $function_name ) ) {
                throw new Error( Error::FUNCTION_NOT_EXIST );
            }
            $this->getObject()->_before();
            $this->getObject()->_run( $function_name, $arguments );
            $this->getObject()->_after();
            $res = $this->getObject()->getResponse();
        } catch ( Exception $e ) {
            $res = StringFormat::return ( false, json_decode( $e->getMessage() ) );
            echo 'AOP Error:' . PHP_EOL;
            echo $e->getMessage() . PHP_EOL;
            echo $e->getTraceAsString() . PHP_EOL;
        }
        var_dump( $res );
        return $res;
    }
}