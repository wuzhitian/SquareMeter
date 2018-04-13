<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: TcpAsyncTaskServer.php
 * Create: 2018/4/12
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\CORE\SERVER\TcpAsyncTaskServer;

use UmbServer\SwooleFramework\LIBRARY\INSTANCE\SinglePatternTrait;

/**
 * TcpAsyncTask服务器
 * Class TcpAsyncTaskServer
 * @package UmbServer\SwooleFramework\COMPONENT\CORE\SERVER\TcpAsyncTaskServer
 */
class TcpAsyncTaskServer
{
    use SinglePatternTrait; //加载单例模式

    /**
     * 设置配置
     * @param array $config
     * @param string $config_file_type
     */
    public
    function loadConfig( $config = self::DEFAULT_CONFIG, $config_file_type = _Config::ARRAY )
    {
        $this->_config = new HttpApiServerConfig();
        $this->getConfig()->setByConfig( $config, $config_file_type );
    }
}