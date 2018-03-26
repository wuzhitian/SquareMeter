<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: ResourceTarget.php
 * Create: 2018/3/24
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\HTTP\REQUEST;

use UmbServer\SwooleFramework\LIBRARY\ENUM\_HttpServer;

/**
 * 静态资源请求目标类
 * Class ResourceTarget
 * @package UmbServer\SwooleFramework\LIBRARY\HTTP\REQUEST
 */
class ResourceTarget implements RequestTarget
{
    const HTTP_SERVER_TYPE = _HttpServer::RESOURCE;

    public $request_uri;
    public $resource_type;
    public $resource_file_path;

    /**
     * 准备resource目标资源
     */
    public
    function prepare()
    {

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

    public
    function getMethodName(): string
    {
        // TODO: Implement getMethodName() method.
    }

    public
    function getTargetFilePath(): string
    {
        // TODO: Implement getTargetFilePath() method.
    }

    public
    function getControllerClasspath(): string
    {
        // TODO: Implement getControllerClasspath() method.
    }

    public
    function getApiTarget(): ApiTarget
    {
        return NULL;
    }

    public
    function getResourceTarget(): ResourceTarget
    {
        return $this;
    }
}