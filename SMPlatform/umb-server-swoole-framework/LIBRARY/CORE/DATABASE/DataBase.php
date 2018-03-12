<?php
/**
 * Project: UmbServerSwooleFramework
 * File: DataBase.php
 * Create: 2018/3/9
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleLibrary\FRAMEWORK\CORE\DATABASE;

/**
 * Interface DataBase
 * @package UmbServer\SwooleLibrary\LIBRARY\CORE\DATABASE
 */
interface DataBase
{
    function constructor();

    function connect();

    function disconnect();

    function isConnected(): bool;
}