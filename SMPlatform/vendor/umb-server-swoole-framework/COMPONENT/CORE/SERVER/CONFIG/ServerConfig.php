<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: ServerConfig.php
 * Create: 2018/3/15
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\CORE\SERVER\CONFIG;

use UmbServer\SwooleFramework\LIBRARY\UTIL\ConfigLoader;

/**
 * 服务器配置类
 * Class ServerConfig
 * @package UmbServer\SwooleFramework\COMPONENT\CORE\SERVER\CONFIG
 */
class ServerConfig
{
    public $name; //名称
    public $root; //root路径
    public $path; //path路径
    public $listen_ip; //监听ip
    public $listen_port; //监听端口
    public $set = []; //set集

    /**
     * 获取配置
     * @param $config
     * @param $config_file_type
     */
    public
    function setByConfig( $config, $config_file_type )
    {
        $config_object = ConfigLoader::parse( $config, $config_file_type );
        foreach ( $config_object as $key => $value ) {
            $this->$key = $value;
        }
    }
}