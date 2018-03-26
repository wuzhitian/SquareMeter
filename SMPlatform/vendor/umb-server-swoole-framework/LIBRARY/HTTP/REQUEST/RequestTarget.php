<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: RequestTarget.php
 * Create: 2018/3/24
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\HTTP\REQUEST;

/**
 * 经过解析后的请求目标类
 * interface RequestTarget
 * @package UmbServer\SwooleFramework\LIBRARY\HTTP\REQUEST
 */
interface RequestTarget
{
    /**
     * 获取http服务器类型
     * @return string
     */
    public
    function getHttpServerType(): string;

    /**
     * 准备目标资源
     * @return mixed
     */
    public
    function prepare();

    /**
     * 获取目标文件地址
     * @return string
     */
    public
    function getTargetFilePath(): string;

    /**
     * 获取api控制器classpath，仅api请求存在
     * @return string
     */
    public
    function getControllerClasspath(): string;

    /**
     * 获取api请求方法名，仅api请求存在
     * @return string
     */
    public
    function getMethodName(): string;

    /**
     * 获取api目标对象，仅api请求存在
     * @return ApiTarget
     */
    public
    function getApiTarget(): ApiTarget;

    /**
     * 获取resource目标对象，仅resource请求存在
     * @return ResourceTarget
     */
    public
    function getResourceTarget(): ResourceTarget;
}