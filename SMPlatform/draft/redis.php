<?php
/**
 * Project: SMPlatform
 * File: redis.php
 * Create: 2018/3/28
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */
$redis = new Redis();
$redis->connect( 'r-bp10391e33abe284.redis.rds.aliyuncs.com', 6379 );
$redis->auth( 'Umbrella2017' );
$redis->select( 0 );
//$redis->set( 'cat', 111 );
echo $redis->get( 'cat' );