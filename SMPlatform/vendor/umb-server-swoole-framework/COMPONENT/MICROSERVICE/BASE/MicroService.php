<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: MicroService.php
 * Create: 2018/3/17
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\SERVICE\BASE;

use UmbServer\SwooleFramework\COMPONENT\CORE\SERVER\HttpApiServer\HttpApiServer;
use UmbServer\SwooleFramework\COMPONENT\CORE\SERVER\HttpResourceServer;
use UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\BASE\MicroServiceConfig;
use UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\FRAMEWORK\Authorizer\AuthorizerVisitor;
use UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\FRAMEWORK\DataSharer\DataSharerVisitor;
use UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\FRAMEWORK\Dispatcher\DispatcherVisitor;
use UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\FRAMEWORK\Logger\LoggerVisitor;
use UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\FRAMEWORK\Monitor\MonitorVisitor;
use UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\FRAMEWORK\Registry\RegistryVisitor;
use UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\FRAMEWORK\TimerManager\TimerManagerVisitor;
use UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\ENUM\_MicroService;
use UmbServer\SwooleFramework\COMPONENT\SERVER\TcpAsyncTaskServer\TcpAsyncTaskServer;
use UmbServer\SwooleFramework\LIBRARY\ENUM\_Config;

/**
 * 微服务基础类
 * Class MicroService
 * @package UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\SERVICE\BASE
 */
class MicroService
{
    private $_config; //service_config
    private $_type = _MicroService::HTTP_API_SERVICE; //service类型
    private $_server_config; //内置服务器配置对象
    private $_server; //内置服务器对象
    
    private $_registry_visitor; //注册中心访问器
    private $_authorizer_visitor; //鉴权中心访问器
    private $_monitor_visitor; //监控中心访问器
    private $_dispatcher_visitor; //分发中心访问器
    private $_logger_visitor; //日志中心访问器
    private $_data_sharer_visitor; //数据中心访问器
    private $_timer_manager_visitor; //定时任务中心访问器
    
    /**
     * 加载配置
     * @param $config
     * @param string $config_type
     */
    public
    function loadConfig( $config, $config_type = _Config::ARRAY )
    {
        $micro_service_config = new MicroServiceConfig( $config, $config_type );
        $this->setConfig( $micro_service_config );
        $this->setType();
    }
    
    /**
     * 初始化注册中心访问器
     */
    private
    function initialRegistryVisitor()
    {
        $this->_registry_visitor = new RegistryVisitor();
        $this->_registry_visitor->setConfig( $this->getConfig()->registry, _Config::OBJECT );
        $this->_registry_visitor->initial();
    }
    
    /**
     * 获取注册中心访问器
     * @return RegistryVisitor
     */
    protected
    function getRegistryVisitor(): RegistryVisitor
    {
        return $this->_registry_visitor;
    }
    
    /**
     * 初始化鉴权中心访问器
     */
    private
    function initialAuthorizerVisitor()
    {
        $this->_authorizer_visitor = new AuthorizerVisitor();
        $this->_authorizer_visitor->setConfig( $this->getConfig()->authorizer, _Config::OBJECT );
        $this->_authorizer_visitor->initial();
    }
    
    /**
     * 获取鉴权中心访问器
     * @return AuthorizerVisitor
     */
    protected
    function getAuthorizerVisitor(): AuthorizerVisitor
    {
        return $this->_authorizer_visitor;
    }
    
    /**
     * 初始化监控中心访问器
     */
    private
    function initialMonitorVisitor()
    {
        $this->_monitor_visitor = new MonitorVisitor();
        $this->_monitor_visitor->setConfig( $this->getConfig()->authorizer, _Config::OBJECT );
        $this->_monitor_visitor->initial();
    }
    
    /**
     * 获取监控中心访问器
     * @return MonitorVisitor
     */
    protected
    function getMonitorVisitor(): MonitorVisitor
    {
        return $this->_monitor_visitor;
    }
    
    /**
     * 初始化分发中心访问器
     */
    private
    function initialDispatcherVisitor()
    {
        $this->_dispatcher_visitor = new DispatcherVisitor();
        $this->_dispatcher_visitor->setConfig( $this->getConfig()->authorizer, _Config::OBJECT );
        $this->_dispatcher_visitor->initial();
    }
    
    /**
     * 获取分发中心访问器
     * @return DispatcherVisitor
     */
    protected
    function getDispatcherVisitor(): DispatcherVisitor
    {
        return $this->_dispatcher_visitor;
    }
    
    /**
     * 初始化日志中心访问器
     */
    private
    function initialLoggerVisitor()
    {
        $this->_logger_visitor = new LoggerVisitor();
        $this->_logger_visitor->setConfig( $this->getConfig()->authorizer, _Config::OBJECT );
        $this->_logger_visitor->initial();
    }
    
    /**
     * 获取日志中心访问器
     * @return LoggerVisitor
     */
    protected
    function getLoggerVisitor(): LoggerVisitor
    {
        return $this->_logger_visitor;
    }
    
    /**
     * 初始化数据中心访问器
     */
    private
    function initialDataSharerVisitor()
    {
        $this->_data_sharer_visitor = new DataSharerVisitor();
        $this->_data_sharer_visitor->setConfig( $this->getConfig()->authorizer, _Config::OBJECT );
        $this->_data_sharer_visitor->initial();
    }
    
    /**
     * 获取数据中心访问器
     * @return DataSharerVisitor
     */
    protected
    function getDataSharerVisitor(): DataSharerVisitor
    {
        return $this->_data_sharer_visitor;
    }
    
    /**
     * 初始化定时任务中心访问器
     */
    private
    function initialTimerManagerVisitor()
    {
        $this->_timer_manager_visitor = new TimerManagerVisitor();
        $this->_timer_manager_visitor->setConfig( $this->getConfig()->authorizer, _Config::OBJECT );
        $this->_timer_manager_visitor->initial();
    }
    
    /**
     * 获取定时任务中心访问器
     * @return TimerManagerVisitor
     */
    protected
    function getTimerManagerVisitor(): TimerManagerVisitor
    {
        return $this->_timer_manager_visitor;
    }
    
    /**
     * 设置
     * @param $config
     */
    private
    function setConfig( $config )
    {
        $this->_config = $config;
    }
    
    /**
     * 获取config对象
     */
    protected
    function getConfig(): MicroServiceConfig
    {
        return $this->_config;
    }
    
    /**
     * 获取服务类型
     * @return string
     */
    protected
    function getType(): string
    {
        $res = $this->_type;
        return $res;
    }
    
    /**
     * 设置内置服务器配置
     */
    private
    function setServerConfig()
    {
        $this->_server_config = $this->getConfig()->server;
    }
    
    /**
     * 获取server_config
     * @return \stdClass
     */
    private
    function getServerConfig(): \stdClass
    {
        return $this->_server_config;
    }
    
    /**
     * 设置微服务类型
     */
    private
    function setType()
    {
        if ( property_exists( $this->getConfig(), 'type' ) ) {
            $this->_type = $this->getConfig()->type;
        };
    }
    
    /**
     * 初始化内置服务器
     */
    private
    function initialServer()
    {
        $this->setServerConfig();
        switch ( $this->getType() ) {
            case _MicroService::TCP_ASYNC_TASK_SERVICE:
                $this->initialTcpAsyncTaskServer();
                break;
            case _MicroService::HTTP_RESOURCE_SERVICE:
                $this->initialHttpResourceServer();
                break;
            case _MicroService::HTTP_API_SERVICE:
            default:
                $this->initialHttpApiServer();
        }
    }
    
    /**
     * 初始化服务
     */
    public
    function initial()
    {
        $this->initialServer(); //初始化内置服务器
        $this->initialRegistryVisitor(); //初始化注册中心访问器
        $this->initialAuthorizerVisitor(); //初始化鉴权中心访问器
        $this->initialDataSharerVisitor(); //初始化数据中心访问器
        $this->initialLoggerVisitor(); //初始化日志中心访问器
        $this->initialMonitorVisitor(); //初始化监控中心访问器
        $this->initialDispatcherVisitor(); //初始化分发中心访问器
        $this->initialTimerManagerVisitor(); //初始化定时任务中心访问器
    }
    
    /**
     * 初始化http_api_server
     */
    private
    function initialHttpApiServer()
    {
        $this->_server = HttpApiServer::getInstance();
        $this->_server->loadConfig( $this->getServerConfig(), _Config::OBJECT );
    }
    
    /**
     * 初始化http_resource_server
     */
    private
    function initialHttpResourceServer()
    {
        $this->_server = HttpResourceServer::getInstance();
        $this->_server->loadConfig( $this->getServerConfig(), _Config::OBJECT );
    }
    
    /**
     * 初始化tcp_async_task_server
     */
    private
    function initialTcpAsyncTaskServer()
    {
        $this->_server = TcpAsyncTaskServer::getInstance();
        $this->_server->loadConfig( $this->getServerConfig(), _Config::OBJECT );
    }
    
    /**
     * 向注册中心注册
     */
    public
    function register()
    {
    
    }
    
    /**
     * 获取微服务框架配置
     */
    public
    function getMicroServiceFrameworkConfig()
    {
    
    }
    
    /**
     * 启动微服务
     */
    public
    function start()
    {
        $this->_server->start();
    }
}