<?php declare( strict_types = 1 );
/**
 * Project: SMBCMiddletier
 * File: TokenDistributor.php
 * Create: 2018/4/15
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMBCMiddletier\MODEL\CONTRACT;

use SMBCMiddletier\MODEL\DATA\SMBCContract;

/**
 * Token派发合约类
 * Class TokenDistributor
 * @package SMBCMiddletier\MODEL\CONTRACT
 */
class TokenDistributor extends SMBCContract
{
    /**
     * 派发
     * @return bool
     */
    public
    function distribute(): bool
    {
        $res = $this->transaction();
        return $res;
    }
}