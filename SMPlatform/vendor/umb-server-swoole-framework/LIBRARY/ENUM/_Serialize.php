<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: _Serialize.php
 * Create: 2018/3/20
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\ENUM;

/**
 * 序列化模式枚举类
 * Class _Serialize
 * @package UmbServer\SwooleFramework\LIBRARY\ENUM
 */
class _Serialize
{
    const JSON = 'json';
    const UMB  = 'umb';

    const UMB_SERIALIZE_SOF = 'UMB_SERIALIZE_START::'; //umb序列化起始符
    const UMB_SERIALIZE_EOF = '::UMB_SERIALIZE_END'; //umb序列化结束符
}