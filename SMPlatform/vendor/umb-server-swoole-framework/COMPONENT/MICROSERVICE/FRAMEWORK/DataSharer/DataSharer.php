<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: DataSharer.php
 * Create: 2018/3/12
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\FRAMEWORK\DataSharer;

use UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\SERVICE\BASE\MicroService;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\Instance;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\SinglePatternTrait;

/**
 * 数据分享服务类
 * Class DataSharer
 * @package UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\FRAMEWORK\DataSharer
 */
class DataSharer extends MicroService
{
    use SinglePatternTrait; //加载单例模式

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