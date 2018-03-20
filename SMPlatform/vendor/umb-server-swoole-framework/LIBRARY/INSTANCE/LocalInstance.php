<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: LocalInstance.php
 * Create: 2018/3/20
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\INSTANCE;

/**
 * 本地实例基础类
 * Class LocalInstance
 * @package UmbServer\SwooleFramework\LIBRARY\INSTANCE
 */
class LocalInstance extends Instance
{
    private $_local_instance_data; //本地实例数据对象

    /**
     * 保存数据
     */
    public
    function save()
    {
        $res = 1;
        return $res;
    }

    /**
     * 同步数据
     */
    public
    function sync()
    {

    }
}