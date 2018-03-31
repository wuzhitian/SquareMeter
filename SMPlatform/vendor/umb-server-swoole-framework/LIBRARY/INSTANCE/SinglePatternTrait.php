<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: SinglePatternTrait.php
 * Create: 2018/3/31
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\INSTANCE;

/**
 * 单例模式trait
 * Trait SinglePatternTraits
 * @package UmbServer\SwooleFramework\LIBRARY\INSTANCE
 */
trait SinglePatternTrait
{
    private static $_instance; //内置单例对象存储
    
    /**
     * 单例不允许构造
     * SinglePatternTrait constructor.
     */
    private
    function __construct()
    {
        //do nothing
    }
    
    /**
     * 单例不允许克隆
     */
    private
    function __clone()
    {
        //do nothing
    }
    
    /**
     * 获取单例
     * @return self
     */
    public static
    function getInstance(): self
    {
        if ( !( self::$_instance instanceof self ) ) {
            self::$_instance = new self();
            self::$_instance->__initial();
        }
        return self::$_instance;
    }
    
    /**
     * 初始化
     */
    private
    function __initial()
    {
        //TODO 重写单例初始化
    }
}