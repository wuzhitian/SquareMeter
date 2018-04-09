<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: Const.php
 * Create: 2018/3/12
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

const INT_TYPE       = 'int'; //整型
const BOOL_TYPE      = 'bool'; //布尔型
const STRING_TYPE    = 'string'; //字符串型
const TIMESTAMP_TYPE = 'timestamp'; //时间戳型
const TEXT_TYPE      = 'text'; //文本型
const FLOAT_TYPE     = 'float'; //单精度浮点型
const DOUBLE_TYPE    = 'double'; //双精度浮点型
const ARRAY_TYPE     = 'array'; //数组型，数组默认在数据库存json
const OBJECT_TYPE    = 'object'; //对象类型
const MD5_TYPE       = 'md5'; //md5加密类型，先json_encode，再md5，实质上是string
const AMOUNT_TYPE    = 'amount'; //金额类型，会用字段名加_value存bigint，然后再存一个_decimal_bit存小数位
