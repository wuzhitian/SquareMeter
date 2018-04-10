<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: httpClient.php
 * Create: 2018/4/10
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

$http_client = new swoole_http_client( '10.10.10.30', 9090, false );
$http_client->set( [ 'timeout' => 30 ] );
$http_client->get( '/newAccount?password=123', function ( $response ) {
    var_dump( $response );
} );