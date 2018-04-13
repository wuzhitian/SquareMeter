<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: Ring.php
 * Create: 2018/4/12
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\STRUCTURE;

/**
 * 环
 * Class Ring
 * @package UmbServer\SwooleFramework\LIBRARY\STRUCTURE
 */
class Ring
{
    private $_ring_list = []; //环数据列表
    private $_current_pointer = 0; //当前指针
    
    /**
     * 构造
     * Ring constructor.
     * @param array $ring_array
     */
    public
    function __construct( array $ring_array )
    {
        $ring_array = array_values( $ring_array ); //去掉键名
        foreach ( $ring_array as $index => $value ) {
            $this->_ring_list[ $index ] = $value;
        }
    }
    
    /**
     * 设置当前指针
     * @param int $current_pointer
     */
    public
    function setCurrent( int $current_pointer )
    {
        $this->_current_pointer = $current_pointer;
    }
    
    /**
     * 重置指针为0
     */
    public
    function reset()
    {
        $this->setCurrent( 0 );
    }
    
    /**
     * 取出当前值
     */
    public
    function current()
    {
        $res = $this->_ring_list[ $this->_current_pointer ];
        return $res;
    }
    
    /**
     * 取出下一个值
     */
    public
    function next()
    {
        $next_pointer = $this->_current_pointer + 1;
        if ( $next_pointer + 1 > $this->getLength() ) {
            $next_pointer = 0;
        }
        $this->setCurrent( $next_pointer );
        $res = $this->current();
        return $res;
    }
    
    /**
     * 取出上一个值
     */
    public
    function prev()
    {
        $prev_pointer = $this->_current_pointer - 1;
        if ( $prev_pointer < 0 ) {
            $prev_pointer = $this->getLength() - 1;
        }
        $this->setCurrent( $prev_pointer );
        $res = $this->current();
        return $res;
    }
    
    /**
     * 获取环长度
     * @return int
     */
    public
    function getLength(): int
    {
        return sizeof( $this->_ring_list );
    }
}