<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: DB.php
 * create: 2018/3/9
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\DB;

/**
 * 数据库接口类
 * Interface DB
 * @package UmbServer\SwooleFramework\LIBRARY\DB
 */
interface DB
{
    public function constructor();

    public function connect();

    public function disconnect();

    public function isConnected(): bool;

    public function query();

    public function insert();

    public function updateById();

    public function deleteById();

    public function softDeleteById();
}