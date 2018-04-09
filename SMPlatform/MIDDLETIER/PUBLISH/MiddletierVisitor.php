<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: MiddletierVisitor.php
 * Create: 2018/4/9
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\MIDDLETIER\PUBLISH;

use SMPlatform\MIDDLETIER\MODEL\DATA\SMBCAccount;
use UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\BASE\Visitor;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\SinglePatternTrait;

/**
 * 中间件访问器类
 * Class MiddletierVisitor
 * @package SMPlatform\MIDDLETIER\PUBLISH
 */
class MiddletierVisitor extends Visitor
{
    use SinglePatternTrait; //加载单例模式

    public
    function applyAccount()
    {
        $smbc_account = new SMBCAccount();
        return $smbc_account->id;
    }

    public
    function send( string $from_smbc_account_id, string $to_smbc_account_id, string $token, int $amount )
    {

    }
}