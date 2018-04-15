<?php declare( strict_types = 1 );
/**
 * Project: SMBCMiddletier
 * File: SMBCResponse.php
 * Create: 2018/4/11
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMBCMiddletier\MODEL\BASE;

use SMBCMiddletier\MODEL\DATA\SMBCBusinessHost;

/**
 * SMBC响应
 * Class SMBCResponse
 * @package SMBCMiddletier\MODEL\BASE
 */
class SMBCResponse
{
    public $responser; //响应的业务机对象
    public $success = false;
    public $data;
    public $error;

    /**
     * 设置响应的主机
     * @param SMBCBusinessHost $responser
     */
    public
    function setResponser( SMBCBusinessHost $responser )
    {
        $this->responser = $responser;
    }

    /**
     * 设置curl返回结果
     * @param $data
     */
    public
    function setData( $data )
    {
        $data = (object)$data;
        foreach ( $data as $key => $value ) {
            if ( property_exists( $this, $key ) ) {
                $this->$key = $value;
            }
        }
    }
}