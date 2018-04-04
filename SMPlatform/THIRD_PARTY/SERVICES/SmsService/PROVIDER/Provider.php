<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: Provider.php
 * Create: 2018/4/4
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\THIRD_PARTY\SERVICES\SmsService\PROVIDER;

/**
 * 短信服务提供商接口
 * Interface Provider
 * @package SMPlatform\THIRD_PARTY\SERVICES\SmsService\PROVIDER
 */
interface Provider
{
    public
    function sendSms( string $cellphone, string $sign, string $template_id, string $template_params );
}