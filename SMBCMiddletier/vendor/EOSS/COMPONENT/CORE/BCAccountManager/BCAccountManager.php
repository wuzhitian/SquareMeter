<?php declare( strict_types = 1 );
/**
 * Project: EOSS
 * File: BCAccountManager.php
 * Create: 2018/4/10
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace EOSS\COMPONENT\CORE\BCAccountManager;

use EOSS\COMPONENT\MODEL\DATA\BCAccountSafe;
use UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\MODEL\Service;

/**
 * 区块链账户创建
 * Class BCAccountManager
 * @package EOSS\COMPONENT\CORE\BCAccountManager
 */
class BCAccountManager extends Service
{
    public
    function createNewAccount( string $password ): BCAccountSafe
    {
        $response    = ;
        $new_account = new BCAccountSafe();
        $new_account->setData( $response->data );
        $new_account->update( false );
    }
}