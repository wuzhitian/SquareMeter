<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: DataCenter.php
 * Create: 2018/3/12
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\CORE_SERVICES\DataCenter;

use UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\MODEL\Service;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\Instance;

/**
 * 数据中心服务
 * Class DataCenter
 * @package UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\CORE_SERVICES\DataCenter
 */
class DataCenter extends Service
{
    //构建单例
    /************************************************************/
    private static $_instance;

    private
    function __construct()
    {
    }

    private
    function __clone()
    {
    }

    public static
    function getInstance(): self
    {
        if ( !( self::$_instance instanceof self ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    /************************************************************/

    /**
     * 创建实例管理器
     * @param string $class
     * @return bool
     */
    private
    function registerInstanceManager( string $class ): bool
    {

    }

    /**
     * 注册实例
     * @param Instance $instance
     * @return bool
     */
    public
    function registerInstance( Instance $instance ): bool
    {

    }

    /**
     * 更新实例
     * @param Instance $instance
     * @return bool
     */
    public
    function updateInstance( Instance $instance ): bool
    {

    }

    /**
     * 根据filter判断instance是否存在
     * @param string $class
     * @param string $filter
     * @return bool
     */
    public
    function isInstanceExistByFilter( string $class, string $filter ): bool
    {

    }

    public
    function isInstanceExistById( string $class, $id ): bool
    {

    }
}