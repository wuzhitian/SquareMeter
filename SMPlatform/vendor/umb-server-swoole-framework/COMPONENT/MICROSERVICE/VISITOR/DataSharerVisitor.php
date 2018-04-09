<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: DataSharerVisitor.php
 * Create: 2018/3/26
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\VISITOR;

use UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\BASE\Visitor;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\Instance;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\SinglePatternTrait;

/**
 * 数据中心访问器类
 * Class DataSharerVisitor
 * @package UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\VISITOR
 */
class DataSharerVisitor extends Visitor
{
    use SinglePatternTrait; //加载单例模式
    
    public
    function createInstance( Instance $instance ): Instance
    {
    
    }
    
    public
    function updateInstance( Instance $instance ): bool
    {
    
    }
    
    public
    function readInstance( Instance $instance ): Instance
    {
    
    }
    
    public
    function deleteInstance( Instance $instance ): bool
    {
    
    }
}