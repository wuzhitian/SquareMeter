<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: MicroServicePublisher.php
 * Create: 2018/4/13
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\SERVICE\BASE;

/**
 * 微服务发布器类
 * Class MicroServicePublisher
 * @package UmbServer\SwooleFramework\COMPONENT\MICROSERVICE\SERVICE\BASE
 */
class MicroServicePublisher extends MicroService
{
    /**
     * 注册
     */
    public
    function register()
    {
        $this->registerAsPublisher();
    }

    /**
     * 发布
     */
    public
    function publish()
    {
        $this->start();
    }
}