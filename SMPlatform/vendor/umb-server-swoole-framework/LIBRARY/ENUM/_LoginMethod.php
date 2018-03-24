<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: _LoginMethod.php
 * Create: 2018/3/24
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\ENUM;

/**
 * 登录方法枚举类
 * Class _LoginMethod
 * @package UmbServer\SwooleFramework\LIBRARY\ENUM
 */
class _LoginMethod
{
    const USERNAME_PASSWORD       = 'username_password'; //用户名密码登录
    const CELLPHONE_SMS_AUTH_CODE = 'cellphone_sms_auth_code'; //手机号短信验证码登录
    const EMAIL_EMAIL_AUTH_CODE   = 'email_email_auth_code'; //邮箱邮箱验证码登录
    const THIRD_PARTY_WECHAT      = 'third_party_wechat'; //微信三方登录
    const THIRD_PARTY_QQ          = 'third_party_qq'; //QQ三方登录
    const THIRD_PARTY_FACEBOOK    = 'third_party_facebook'; //Facebook三方登录
    const THIRD_PARTY_TWRITTER    = 'third_party_twritter'; //Twritter三方登录
}