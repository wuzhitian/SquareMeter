<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: File.php
 * Create: 2018/3/14
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\FILESYSTEM;

/**
 * 文件类
 * Class File
 * @package UmbServer\SwooleFramework\LIBRARY\FILESYSTEM
 */
class File
{
    private $path; //文件路径
    private $name; //文件名
    private $md5; //文件md5
    private $size; //文件大小
    private $content; //文件内容string

    /**
     * 通过路径设置file对象
     * @param $path
     */
    public
    function setByPath( $path )
    {
        $this->path = $path;
        $this->name = basename( $path );
        $this->md5  = md5_file( $path );
        $this->size = filesize( $path );
    }

    /**
     * 通过内容设置file对象
     * @param $content
     */
    public
    function setByContent( $content )
    {
        $this->content = $content;
        $this->md5     = md5( $content );
        $this->size    = strlen( $content );
    }

    /**
     * 获取文件名
     * @return mixed
     */
    public
    function getName()
    {
        return $this->name;
    }

    /**
     * 获取文件内容
     * @return mixed
     */
    public
    function getContent()
    {
        if ( $this->content === NULL ) {
            $this->content = file_get_contents( $this->path );
        }
        return $this->content;
    }

    /**
     * 获取文件路径
     * @return mixed
     */
    public
    function getPath()
    {
        return $this->path;
    }

    /**
     * 获取文件大小
     * @return mixed
     */
    public
    function getSize()
    {
        return $this->size;
    }

    /**
     * 获取文件md5
     * @return mixed
     */
    public
    function getMd5()
    {
        return $this->md5;
    }

    /**
     * 获取文件后缀
     * @return mixed
     */
    public
    function getSuffix()
    {
        $res = array_reverse( explode( '.', $this->getPath() ) )[ 0 ];
        return $res;
    }

    /**
     * 保存文件
     * @return bool|int
     */
    public
    function save()
    {
        $res = file_put_contents( $this->getPath(), $this->getContent() );
        return $res;
    }

    /**
     * 删除文件
     * @return bool
     */
    public
    function delete()
    {
        $res = unlink( $this->getName() );
        return $res;
    }

    /**
     * 更名文件
     * @param $new_path
     * @return bool
     */
    public
    function rename( $new_path )
    {
        $res = rename( $this->getPath(), $new_path );
        if ( $res === true ) {
            $this->name = basename( $new_path );
        }
        return $res;
    }

    /**
     * 加载文件
     */
    public
    function require()
    {
        require_once( $this->getPath() );
    }
}