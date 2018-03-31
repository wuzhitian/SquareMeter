<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: InstanceControllerTraits.php
 * Create: 2018/3/30
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\INSTANCE;

use UmbServer\SwooleFramework\LIBRARY\ENUM\_InstanceBaseOperator;
use UmbServer\SwooleFramework\LIBRARY\EXTEND\POST;

/**
 * 实例控制器公用方法
 * Trait InstanceControllerTraits
 * @package UmbServer\SwooleFramework\LIBRARY\INSTANCE
 */
trait InstanceControllerTrait
{
    /**
     * 创建新实例
     * @return Instance
     */
    private function getNewInstance(): Instance
    {
        $instance_class = self::INSTANCE_CLASS;
        $instance       = new $instance_class();
        return $instance;
    }
    
    /**
     * 创建实例
     * @param POST $create_data_array
     */
    public function create( POST $create_data_array )
    {
        $instance = $this->getNewInstance();
        $instance->setData( $create_data_array->array() );
        $instance->create();
    }
    
    /**
     * 读取实例
     * @param POST $instance_id
     */
    public function read( POST $instance_id )
    {
        $instance = Instance::_getById( self::INSTANCE_CLASS, $instance_id );
        $instance->push( _InstanceBaseOperator::READ );
    }
    
    /**
     * 更新实例
     * @param POST $instance_id
     * @param POST $update_data_array
     */
    public function update( POST $instance_id, POST $update_data_array )
    {
        $instance = Instance::_getById( self::INSTANCE_CLASS, $instance_id );
        $instance->setData( $update_data_array->array() );
    }
    
    /**
     * 删除实例
     * @param POST $instance_id
     */
    public function delete( POST $instance_id )
    {
        $instance = Instance::_getById( self::INSTANCE_CLASS, $instance_id );
        $instance->delete();
    }
}