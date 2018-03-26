<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: ApiTarget.php
 * Create: 2018/3/24
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\HTTP\REQUEST;

use UmbServer\SwooleFramework\LIBRARY\ENUM\_HttpServer;

/**
 * api请求目标类
 * Class ApiTarget
 * @package UmbServer\SwooleFramework\LIBRARY\HTTP\REQUEST
 */
class ApiTarget implements RequestTarget
{
    const HTTP_SERVER_TYPE = _HttpServer::API;

    public $request_uri;
    public $controller_name;
    public $controller_file_path;
    public $method_name;
    public $controller_namespace;
    public $header;
    public $cookie;
    public $params;
    public $files;
    public $verb;

    public $api_key;
    public $signature;

    /**
     * 准备目标资源
     */
    public
    function prepare()
    {

    }

    /**
     * 获取controller文件地址
     * @return string
     */
    public
    function getTargetFilePath(): string
    {
        return $this->controller_file_path;
    }

    /**
     * 获取方法名
     * @return string
     */
    public
    function getMethodName(): string
    {
        return $this->method_name;
    }

    /**
     * 获取api控制器命名空间
     * @return string
     */
    public
    function getControllerClasspath(): string
    {
        $res = $this->controller_namespace . '\\' . $this->controller_name;
        return $res;
    }

    /**
     * 获取http服务器类型
     * @return string
     */
    public
    function getHttpServerType(): string
    {
        return self::HTTP_SERVER_TYPE;
    }

    /**
     * 获取api目标对象
     * @return ApiTarget
     */
    public
    function getApiTarget(): ApiTarget
    {
        return $this;
    }

    /**
     * 获取resource目标对象
     * @return ResourceTarget
     */
    public
    function getResourceTarget(): ResourceTarget
    {
        return NULL;
    }
}