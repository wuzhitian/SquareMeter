<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: AOP.php
 * Create: 2018/3/12
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\BASE;

use UmbServer\SwooleFramework\LIBRARY\ERROR\Error;
use UmbServer\SwooleFramework\LIBRARY\UTIL\Console;
use UmbServer\SwooleFramework\LIBRARY\UTIL\DataHandler;

/**
 * 切面对象访问控制类
 * Class AOP
 * @package UmbServer\SwooleFramework\LIBRARY\BASE
 */
class AOP
{
    private $_object; //切面控制对象

    /**
     * 设置切面控制对象
     * @param $object
     */
    public
    function setObject( $object )
    {
        $this->_object = $object;
    }

    /**
     * 获取切面控制对象
     * @return AOPObject
     */
    public
    function getObject(): AOPObject
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
    public
    function __call( $function_name, $arguments )
    {
        $this->getObject()->_before();
        $this->getObject()->_run( $function_name, $arguments );
        $this->getObject()->_after();
        $res = $this->getObject()->getRes();
        return $res;
    }
}