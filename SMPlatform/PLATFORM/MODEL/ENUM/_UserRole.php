<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: _UserRole.php
 * Create: 2018/4/9
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\PLATFORM\MODEL\ENUM;

/**
 * 用户角色
 * Class _UserRole
 * @package SMPlatform\PLATFORM\MODEL\ENUM
 */
class _UserRole
{
    const INVESTOR    = 'investor';
    const INSTITUTION = 'institution';
    const STAFF       = 'staff';
    const EXCHANGE    = 'exchange';
    const PAWNSHOP    = 'pawnshop';
}