<?php declare( strict_types = 1 );
/**
 * Project: EOSS
 * File: Account.php
 * Create: 2018/4/10
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace EOSS\COMPONENT\VISITOR;

use UmbServer\SwooleFramework\LIBRARY\INSTANCE\SinglePatternTrait;

/**
 * 账户业务访问器
 * Class AccountVisitor
 * @package EOSS\COMPONENT\CORE\BASE
 */
class AccountVisitor extends Visitor
{
    use SinglePatternTrait; //加载单例模式

    public
    function createNewAccount()
    {

    }
}