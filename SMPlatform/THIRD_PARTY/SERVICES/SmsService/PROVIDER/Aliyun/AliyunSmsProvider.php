<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: AliyunSmsProvider.php
 * Create: 2018/4/4
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\THIRD_PARTY\SERVICES\SmsService\PROVIDER\Aliyun;

use SMPlatform\THIRD_PARTY\SERVICES\SmsService\PROVIDER\Provider;
use UmbServer\SwooleFramework\LIBRARY\UTIL\DataHandler;

/**
 * 阿里云短信服务商
 * Class AliyunSmsProvider
 * @package SMPlatform\THIRD_PARTY\SERVICES\SmsService\PROVIDER\Aliyun
 */
class AliyunSmsProvider implements Provider
{
    /**
     * 阿里云短信要求的特殊urlEncode方法
     * @param string $url
     * @return mixed
     */
    public static
    function specialUrlEncode( string $url )
    {
        $url_encode         = DataHandler::urlEncode( $url );
        $special_url_encode = str_replace( '+', '%20', $url_encode );
        $special_url_encode = str_replace( '*', '%2A', $special_url_encode );
        $special_url_encode = str_replace( '~', '%7E', $special_url_encode );
        return $special_url_encode;
    }
}