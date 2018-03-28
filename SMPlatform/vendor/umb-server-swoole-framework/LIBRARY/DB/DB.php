<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: DB.php
 * create: 2018/3/9
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\DB;

use UmbServer\SwooleFramework\LIBRARY\ENUM\_Config;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\Instance;

/**
 * 数据库接口类
 * Interface DB
 * @package UmbServer\SwooleFramework\LIBRARY\DB
 */
interface DB
{
    /**
     * 设置配置
     * @param $config
     * @param string $config_type
     * @return mixed
     */
    public function setConfig( $config, string $config_type = _Config::OBJECT );
    
    /**
     * 连接
     * @return bool
     */
    public function connect(): bool;
    
    /**
     * 断开连接
     * @return bool
     */
    public function disconnect(): bool;
    
    /**
     * 是否连接中
     * @return bool
     */
    public function isConnected(): bool;
    
    /**
     * insert基本方法
     * @param string $table_name
     * @param Instance $instance
     * @return bool
     */
    public function insert( string $table_name, Instance $instance ): bool;
    
    /**
     * 获取指定表下一个整型id
     * @param string $table_name
     * @return int
     */
    public function getNextIntId( string $table_name ): int;
    
    /**
     * 获取表
     * @param string $table_name
     * @return array
     */
    public function getTable( string $table_name ): array;
    
    /**
     * 根据id查询数据
     * @param string $table_name
     * @param $id
     * @return array
     */
    public function fetchById( string $table_name, $id ): array;
    
    /**
     * 在table中指定id是否存在
     * @param string $table_name
     * @param $id
     * @return bool
     */
    public function isExistById( string $table_name, $id ): bool;
    
    /**
     * 根据id删除数据
     * @param string $table_name
     * @param $id
     * @return bool
     */
    public function deleteById( string $table_name, $id ): bool;
    
    /**
     * 根据id更新数据
     * @param string $table_name
     * @param $id
     * @param Instance $instance
     * @return bool
     */
    public function updateById( string $table_name, $id, Instance $instance ): bool;
}