<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: UserServiceVisitor.php
 * Create: 2018/3/30
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\PLATFORM\SERVICES\UserService;

use UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\BASE\Visitor;
use UmbServer\SwooleFramework\LIBRARY\ENUM\_VisitorConnectMode;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\SinglePatternTrait;

/**
 * UserService访问器
 * Class UserServiceVisitor
 * @package SMPlatform\PLATFORM\SERVICES\UserService
 */
class UserServiceVisitor extends Visitor
{
    use SinglePatternTrait; //加载单例模式

    const CONNECT_MODE = _VisitorConnectMode::HTTP; //连接模式

    public
    function register()
    {
        //创建User
        //申请SMBC账户
        //创建PrivateKeySafe
        //
    }
}