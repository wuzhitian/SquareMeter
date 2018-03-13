<?php
/**
 * Project: UmbServerSwooleFramework
 * File: HttpApiServer.php
 * Create: 2018/3/12
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\SERVER;

use UmbServer\SwooleFramework\CORE\BASE\AOP;

/**
 * Class HttpApiServer
 * @package UmbServer\SwooleFramework\COMPONENT\SERVER
 */
class HttpApiServer
{
    const DEFAULT_CONFIG = [
        'name' => 'HttpApiServer',
        'listen_ip' => '127.0.0.1',
        'listen_port' => 9527,
    ]; //默认配置

    private $_server; //swoole_http_server对象
    private $_config; //配置

    private $extra_data; //附加数据

    /**
     * 构造，带上config
     * HttpApiServer constructor.
     * @param null $config
     */
    public function __construct( $config = NULL )
    {
        $this->_config = $config ?? self::DEFAULT_CONFIG;
        $this->_server = new \swoole_http_server( $this->_config[ 'listen_ip' ], $this->_config[ 'listen_port' ], SWOOLE_BASE, SWOOLE_SOCK_TCP );
        $this->bindCallback();
    }

    /**
     * 获取内置server对象
     * @return \swoole_http_server
     */
    private function getServer()
    {
        return $this->_server;
    }

    /**
     * 获取extra_data
     * @return mixed
     */
    public function getExtraData()
    {
        return $this->extra_data;
    }

    /**
     * 设置额外的数据
     * @param null $extra_data
     */
    public function setExtraData( $extra_data = NULL )
    {
        $this->extra_data = $extra_data;
    }

    public function setHttp2()
    {
        $this->set[ 'open_http2_protocol' ] = true;
    }

    public function setSSLFile( $cert_file_path, $key_file_path )
    {
        $this->set[ 'ssl_cert_file' ] = $cert_file_path;
        $this->set[ 'ssl_key_file' ] = $key_file_path;
    }

    public function set()
    {
        $this->getServer()->set( $this->set );
    }

    /**
     * 绑定回调
     */
    public function bindCallback()
    {
        $this->getServer()->on( 'Start', [ $this, 'onStart' ] );
        $this->getServer()->on( 'Shutdown', [ $this, 'onShutdown' ] );
        $this->getServer()->on( 'Request', [ $this, 'onRequest' ] );
        $this->getServer()->on( 'WorkerStart', [ $this, 'onWorkerStart' ] );
    }

    /**
     * worker进程启动后的回调
     */
    public function onWorkerStart()
    {

    }

    /**
     * server主进程启动后的回调
     */
    public function onStart()
    {
        echo "onStart:: $this->_config[ 'name' ] Server started successfully.\n";
    }

    /**
     * server主进程关闭后的回调
     */
    public function onShutdown()
    {
        echo "onShutdown:: $this->_config[ 'name' ] Server stopped successfully.\n";
    }

    /**
     * 收到请求后的回调
     * @param $request
     * @param $response
     * @return bool
     */
    public function onRequest( $request, $response )
    {
        // 请求过滤，否则favicon的附带请求会让服务端频繁报错，虽然不会影响运行
        if ( $request->server[ 'request_uri' ] == '/favicon.ico' ) {
            $response->status( 404 );
            $response->end();
            return false;
        }

        // 把请求的path字符串拆分为数组，用array_filter去空
        $path_array = explode( '/', $request->server[ 'request_uri' ] );

        // 如果没有写控制器名称，默认为index
        $controller_name = $path_array[ sizeof( $path_array ) - 2 ] ?? 'index';
        $function_name = $path_array[ sizeof( $path_array ) - 1 ];

        // 遍历controller和function的路径深度，组成$path
        $path = '';
        foreach ( $path_array as $key => $dir ) {
            if ( $key > sizeof( $path_array ) - 3 ) {
                break;
            }
            $path .= ( $dir . '/' );
        }

        $file_path = $this->config[ 'root' ] . $path . $controller_name . '.php';

        var_dump( $file_path );
        // 控制器不存在
        if ( !file_exists( $file_path ) ) {
            $response->status( 404 );
            $response->end();
            return false;
        }

        // 加载控制器类controller
        include_once( $file_path );
        // var_dump($file_path);
        $controller = new AOP( new $controller_name, $request );
        $res = $controller->$function_name();
        $response->header( 'Access-Control-Allow-Origin', '*' );
        $response->end( $res );
        return true;
    }

    /**
     * 启动server
     */
    public function start()
    {
        $this->getServer()->start();
    }
}