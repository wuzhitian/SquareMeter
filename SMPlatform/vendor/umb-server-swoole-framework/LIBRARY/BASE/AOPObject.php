<?php
/**
 * Project: UmbServerSwooleFramework
 * File: AOPObject.php
 * Create: 2018/3/12
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\BASE;

use UmbServer\SwooleFramework\LIBRARY\HTTP\Response;

/**
 * AOP对象接口类
 * Interface AOPObject
 * @package UmbServer\SwooleFramework\LIBRARY\BASE
 */
interface AOPObject
{
    /**
     * 前置方法
     * @return bool
     */
    public function _before(): bool;

    /**
     * 执行中方法
     * @param $function_name
     * @param $arguments
     * @return mixed
     */
    public function _run( $function_name, $arguments );

    /**
     * 后置方法
     * @return bool
     */
    public function _after(): bool;

    /**
     * 设置结果
     * @param $response
     * @return mixed
     */
    public function setResponse( Response $response );

    /**
     * 获取最终结果
     * @return mixed
     */
    public function getResponse();
}