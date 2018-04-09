<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: TimerManagerVisitor.php
 * Create: 2018/4/9
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\VISITOR;

use UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\BASE\Visitor;
use UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\MODEL\DATA\IntervalTask;
use UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\MODEL\DATA\TimerTask;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\SinglePatternTrait;

/**
 * 定时器访问器类
 * Class TimerManagerVisitor
 * @package UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\VISITOR
 */
class TimerManagerVisitor extends Visitor
{
    use SinglePatternTrait; //加载单例模式
    
    public
    function setTimer( TimerTask $timer )
    {
    
    }
    
    public
    function setInterval( IntervalTask $interval )
    {
    
    }
}