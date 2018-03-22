<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: ControllerArgument.php
 * Create: 2018/3/22
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\EXTEND;

use UmbServer\SwooleFramework\LIBRARY\UTIL\Serialize;

/**
 * 控制器参数基础类
 * Class ControllerArgument
 * @package UmbServer\SwooleFramework\LIBRARY\EXTEND
 */
class ControllerArgument
{
    private $_val; //值
    private $_is_set = false; //是否被设置

    /**
     * 构造
     * ControllerArgument constructor.
     * @param $val
     * @param bool $is_set
     */
    public
    function __construct( $val, $is_set = false )
    {
        $this->_val    = $val;
        $this->_is_set = $is_set;
    }

    /**
     * 检查是否为传输赋值，如果是传输赋值则为true，如果是setDefault，则为true,如果是填充则为false，且_val为NULL
     * @return bool
     */
    public
    function isSet(): bool
    {
        return $this->_is_set;
    }

    /**
     * 返回值
     * @return mixed
     */
    public
    function getVal()
    {
        return $this->_val;
    }

    /**
     * 赋值
     * @param $val
     */
    public
    function setVal( $val )
    {
        $this->_val    = $val;
        $this->_is_set = true;
    }

    /**
     * 设置默认值，只能为没有赋值的对象设置默认值，不会影响正常设置的NULL值
     * @param $default_val
     */
    public
    function setDefault( $default_val )
    {
        if ( !$this->isSet() ) {
            $this->setVal( $default_val );
        }
    }

    /**
     * 取int值
     * @return int
     */
    public
    function int()
    {
        return (int)$this->getVal();
    }

    /**
     * 取string值
     * @return string
     */
    public
    function string()
    {
        return (string)$this->getVal();
    }

    /**
     * 取float值
     * @return float
     */
    public
    function float()
    {
        return (float)$this->getVal();
    }

    /**
     * 取bool值
     * @return bool
     */
    public
    function bool()
    {
        return (bool)$this->getVal();
    }

    /**
     * 取stdClass对象，会把array转stdClass
     * @return object
     */
    public
    function object()
    {
        return (object)$this->getVal();
    }

    /**
     * 取array值，会把object转array
     * @return array
     */
    public
    function array()
    {
        return (array)$this->getVal();
    }

    /**
     * type为array时要加()访问，或者json_decode访问
     * @return mixed|string
     */
    public
    function __invoke()
    {
        if ( is_null( $this->getVal() ) || is_array( $this->getVal() ) || is_string( $this->getVal() ) || is_float( $this->getVal() ) || is_int( $this->getVal() ) || is_double( $this->getVal() ) || is_bool( $this->getVal() ) ) {
            $res = $this->getVal();
        } else {
            $res = $this->string();
        }
        return $res;
    }

    /**
     * 默认取值
     * @return mixed|null|string
     */
    public
    function __toString()
    {
        if ( !$this->isSet() ) {
            return NULL;
        }
        if ( is_string( $this->getVal() ) || is_float( $this->getVal() ) || is_int( $this->getVal() ) || is_double( $this->getVal() ) || is_bool( $this->getVal() ) ) {
            $res = $this->getVal();
        } elseif ( is_array( $this->getVal() ) ) {
            $res = Serialize::encode( $this->getVal() );
        } else {
            $res = $this->getVal();
        }
        return $res;
    }
}