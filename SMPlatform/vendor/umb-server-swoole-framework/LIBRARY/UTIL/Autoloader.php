<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: Autoloader.php
 * Create: 2018/3/21
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\UTIL;

/**
 * 自动加载工具类
 * Class Autoloader
 * @package UmbServer\SwooleFramework\LIBRARY\UTIL
 */
abstract
class Autoloader
{
    public static
    function attach( $folder_path, $file_name = NULL )
    {
        $folder_path_array = [];
        if ( is_string( $folder_path ) ) {
            $folder_path_array[] = $folder_path;
        } else {
            $folder_path_array = $folder_path;
        }
        foreach ( $folder_path_array as $folder_path ) {
            $folder = new Folder( $folder_path );
            $folder->init();
            $folder->requireAll( $file_name );
        }
    }
}