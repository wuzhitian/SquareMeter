<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: InstanceTraits.php
 * Create: 2018/3/28
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\INSTANCE;

/**
 * Instance子类公用方法
 * Trait InstanceTraits
 * @package UmbServer\SwooleFramework\LIBRARY\INSTANCE
 */
trait InstanceTrait
{
    /**
     * 通过id获取实例
     * @param $id
     * @return self
     */
    public static
    function getById( $id ): self
    {
        $res = Instance::_getById( __CLASS__, $id );
        return $res;
    }
    
    /**
     * 获取对象列表
     * @return array
     */
    public static
    function getList(): array
    {
        $res = Instance::_getList( __CLASS__ );
        return $res;
    }
    
    /**
     * 通过id_array获取对象数组
     * @param array $id_array
     * @return array
     */
    public static
    function getByIdArray( array $id_array ): array
    {
        $res = [];
        foreach ( $id_array as $id ) {
            $instance = self::getById( $id );
            array_push( $res, $instance );
        }
        return $res;
    }
}