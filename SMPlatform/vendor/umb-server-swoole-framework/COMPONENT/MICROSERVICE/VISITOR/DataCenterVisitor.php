<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: DataCenterVisitor.php
 * Create: 2018/3/26
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\VISITOR;

use UmbServer\SwooleFramework\LIBRARY\INSTANCE\Instance;

/**
 * 数据中心访问器类
 * Class DataCenterVisitor
 * @package UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\VISITOR
 */
class DataCenterVisitor extends Visitor
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

    public
    function createInstance( string $class, Instance $instance ): bool
    {

    }

    public
    function updateInstance( string $class, Instance $instance ): bool
    {

    }

    public
    function readInstance( string $class, $id ): Instance
    {

    }

    public
    function deleteInstance( string $class, $id ): bool
    {

    }
}