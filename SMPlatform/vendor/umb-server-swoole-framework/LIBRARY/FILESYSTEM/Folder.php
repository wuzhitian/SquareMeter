<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: Folder.php
 * Create: 2018/3/14
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\FILESYSTEM;

/**
 * 文件夹类
 * Class Folder
 * @package UmbServer\SwooleFramework\LIBRARY\FILESYSTEM
 */
class Folder
{
    public  $absolute_path;
    private $file_map        = [];
    private $sub_folder_list = [];
    private $file_list       = [];
    private $depth;
    private $max_depth       = 0;

    public
    function __construct( $absolute_path )
    {
        $this->absolute_path = $absolute_path;
        $this->depth         = self::getDepthByPath( $absolute_path );
    }

    public
    function init()
    {
        $this->file_map = $this->iterate( $this->absolute_path );
    }

    public
    function iterate( $path )
    {
        $path_depth = self::getDepthByPath( $path );
        if ( is_dir( $path ) ) {
            $path_depth--;
        }
        if ( $path_depth > $this->max_depth ) {
            $this->max_depth = $path_depth;
        }
        $start_path_pointer = $path;
        $res                = [];
        $folder             = opendir( $start_path_pointer );
        if ( $folder ) {
            while ( ( $file = readdir( $folder ) ) !== false ) {
                if ( substr( $file, 0, 1 ) != '.' ) {
                    $path = $start_path_pointer . '/' . $file;
                    if ( is_dir( $path ) ) {
                        $res[ $path ]            = $this->iterate( $path );
                        $this->sub_folder_list[] = $path;
                    } else {
                        $res[]             = $path;
                        $this->file_list[] = $path;
                    }
                }
            }
            closedir( $folder );
        }
        return $res;
    }

    public
    function getFileMap(): array
    {
        return $this->file_map;
    }

    public
    function getFileList(): array
    {
        return $this->file_list;
    }

    public
    function getSubFolderList(): array
    {
        return $this->sub_folder_list;
    }

    public
    function getMaxDepth()
    {
        return $this->max_depth;
    }

    public
    function getDepth()
    {
        return $this->depth;
    }

    public
    function requireAll( $file_name = NULL )
    {
        foreach ( $this->file_list as $file ) {
            if ( !isset( $file_name ) ) {
                $require_file = $file;
                require_once( $require_file );
            } else {
                if ( self::getFileNameByPath( $file ) == $file_name ) {
                    $require_file = $file;
                    require_once( $require_file );
                }
            }
        }
    }

    public static
    function getDepthByPath( $path )
    {
        $depth = sizeof( explode( '/', $path ) );
        if ( is_dir( $path ) ) {
            $depth++;
        }
        return $depth;
    }

    public static
    function getFileNameByPath( $path )
    {
        $file_name = array_reverse( explode( '/', $path ) )[ 0 ];
        return $file_name;
    }
}