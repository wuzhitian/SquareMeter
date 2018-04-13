<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: Host.php
 * Create: 2018/3/23
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\COMMON_MODEL;

use UmbServer\SwooleFramework\LIBRARY\INSTANCE\Instance;

/**
 * 主机基础类
 * Class Host
 * @package UmbServer\SwooleFramework\LIBRARY\COMMON_MODEL
 */
class Host extends Instance
{
    public $name; //主机名
    public $ip; //ip地址
    public $domain; //域名
    
    /**
     * 获取主机访问字符串
     * @return string
     */
    public
    function getHostAccessString(): string
    {
        $res = $this->domain ?? $this->ip;
        return $res;
    }
}