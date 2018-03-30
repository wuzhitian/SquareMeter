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

use UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\VISITOR\Visitor;
use UmbServer\SwooleFramework\LIBRARY\ENUM\_VisitorConnectMode;

/**
 * UserService访问器
 * Class UserServiceVisitor
 * @package SMPlatform\PLATFORM\SERVICES\UserService
 */
class UserServiceVisitor extends Visitor
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
    
    const CONNECT_MODE = _VisitorConnectMode::HTTP; //连接模式
    
    public function register()
    {
        //创建User
        //申请SMBC账户
        //创建PrivateKeySafe
        //
    }
}