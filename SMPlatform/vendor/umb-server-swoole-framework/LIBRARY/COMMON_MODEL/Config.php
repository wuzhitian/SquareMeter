<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: Config.php
 * Create: 2018/4/11
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\COMMON_MODEL;

use UmbServer\SwooleFramework\LIBRARY\ENUM\_Config;
use UmbServer\SwooleFramework\LIBRARY\UTIL\ConfigLoader;

/**
 * 配置类
 * Class Config
 * @package UmbServer\SwooleFramework\LIBRARY\COMMON_MODEL
 */
class Config
{
    private $_config_data; //解析完成后的config数据对象
    
    /**
     * 构造
     * Config constructor.
     * @param $config
     * @param string $config_type
     */
    public
    function __construct( $config, string $config_type = _Config::OBJECT )
    {
        $config_data = ConfigLoader::parse( $config, $config_type );
        $this->setConfigData( $config_data );
        $this->setByConfigData();
    }
    
    /**
     * 通过config_data设置
     */
    private
    function setByConfigData()
    {
        foreach ( $this->getConfigData() as $key => $value ) {
            if ( property_exists( get_class( $this ), $key ) ) {
                $this->$key = $value;
            }
        }
    }
    
    /**
     * 设置config_data
     * @param $config_data
     */
    private
    function setConfigData( $config_data )
    {
        $this->_config_data = $config_data;
    }
    
    /**
     * 获取config_data
     * @return \stdClass
     */
    public
    function getConfigData(): \stdClass
    {
        return $this->_config_data;
    }
}