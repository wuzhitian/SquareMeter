<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: DB.phpeate: 2018/3/9
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleLibrary\FRAMEWORK\CORE\DATABASE;

/**
 * Interface DB
 * @package UmbServer\SwooleLibrary\LIBRARY\BASE\DB
 */
interface DB
{
    function constructor();

    function connect();

    function disconnect();

    function isConnected(): bool;
}