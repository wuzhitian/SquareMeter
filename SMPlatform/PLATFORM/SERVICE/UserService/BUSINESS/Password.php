<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: Password.php
 * Create: 2018/3/30
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\PLATFORM\SERVICES\AccountService\BUSINESS;

use SMPlatform\PLATFORM\SERVICES\UserService\ERROR\UserError;
use UmbServer\SwooleFramework\LIBRARY\ENUM\_Config;
use UmbServer\SwooleFramework\LIBRARY\UTIL\ConfigLoader;

/**
 * 密码业务类
 * Class Password
 * @package SMPlatform\PLATFORM\SERVICES\AccountService\BUSINESS
 */
abstract class Password
{
    /**
     * 判断密码是否符合规则
     * @param string $password
     * @return bool
     * @throws UserError
     */
    public function checkPasswordFormat( string $password ): bool
    {
        $res            = true;
        $rule_file_path = __DIR__ . '/../RESOURCE/password_rule.json';
        $rule           = ConfigLoader::parse( $rule_file_path, _Config::JSON );
        $format_rule    = $rule->format;
        
        //检查长度
        $password_length = strlen( $password );
        if ( $password_length < $format_rule->min_length ) {
            throw new UserError( UserError::PASSWORD_TOO_SHORT );
        }
        if ( $password_length > $format_rule->max_length ) {
            throw new UserError( UserError::PASSWORD_TOO_LONG );
        }
        
        //检查是否包含必须字符
        if ( $format_rule->is_must_figure === true ) {
            preg_match( '/[0-9]+/', $password, $figure_array );
            if ( sizeof( $figure_array ) < 1 ) {
                throw new UserError( UserError::PASSWORD_NEED_FIGURE );
            }
        }
        if ( $format_rule->is_must_uppercase === true ) {
            throw new UserError( UserError::PASSWORD_NEED_UPPERCASE );
        }
        if ( $format_rule->is_must_lowercase === true ) {
            throw new UserError( UserError::PASSWORD_NEED_LOWERCASE );
        }
        if ( $format_rule->is_must_special_character === true ) {
            throw new UserError( UserError::PASSWORD_NEED_SPECIAL_CHARACTER );
        }
        
        return $res;
    }
}