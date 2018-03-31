<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: InstanceTraits.php
 * Create: 2018/3/28
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\INSTANCE;

/**
 * Instance子类公用方法
 * Trait InstanceTraits
 * @package UmbServer\SwooleFramework\LIBRARY\INSTANCE
 */
trait InstanceTrait
{
    public static function getById( $id ): self
    {
        $res = Instance::_getById( __CLASS__, $id );
        return $res;
    }
}