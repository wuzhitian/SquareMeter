<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: ServerConfig.php
 * Create: 2018/3/15
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\SERVER\CONFIG;

use UmbServer\SwooleFramework\LIBRARY\UTIL\ConfigLoader;

/**
 * 服务器配置类
 * Class ServerConfig
 * @package UmbServer\SwooleFramework\COMPONENT\SERVER
 */
class ServerConfig
{
    public $name;
    public $type;
    public $root;
    public $path;
    public $listen_ip;
    public $listen_port;
    public $set = [];

    public function setByConfig( $config, $config_file_type )
    {
        $config_object = ConfigLoader::parse( $config, $config_file_type );
        foreach ( $config_object as $key => $value ) {
            $this->$key = $value;
        }
    }
}