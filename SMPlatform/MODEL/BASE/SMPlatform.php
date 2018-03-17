<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: SMPlatform.php
 * Create: 2018/3/17
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\MODEL\BASE;

/**
 * 平方米平台
 * Class SMPlatform
 * @package SMPlatform\MODEL\BASE
 */
class SMPlatform
{
    private static $_instance; //单例存储

    /**
     * 单例模式禁止构造
     * SMPlatform constructor.
     */
    private
    function __construct()
    {
        //do nothing
    }

    /**
     * 单例模式禁止克隆
     */
    private
    function __clone()
    {
        //do nothing
    }

    /**
     * 获取单例
     * @return SMPlatform
     */
    public static
    function getInstance(): self
    {
        if ( !( self::$_instance instanceof self ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * 平台维护
     */
    public
    function maintain()
    {

    }

    /**
     * 平台全面开始运作
     */
    private
    function start()
    {

    }

    /**
     * 平台全面暂停运作
     */
    private
    function pause()
    {

    }

    /**
     * 平台全面停止运作
     */
    private
    function stop()
    {

    }

}