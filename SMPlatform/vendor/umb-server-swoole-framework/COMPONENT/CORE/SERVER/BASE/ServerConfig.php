<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: ServerConfig.php
 * Create: 2018/3/15
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\CORE\SERVER\BASE;

use UmbServer\SwooleFramework\LIBRARY\COMMON_MODEL\Config;

/**
 * 服务器配置类
 * Class ServerConfig
 * @package UmbServer\SwooleFramework\COMPONENT\CORE\SERVER\BASE
 */
class ServerConfig extends Config
{
    public $name; //名称
    public $type; //server类型
    public $root; //root路径
    public $path; //path路径
    public $listen_ip = '0.0.0.0'; //监听ip
    public $listen_port = 9527; //监听端口
    public $set = []; //set集
}