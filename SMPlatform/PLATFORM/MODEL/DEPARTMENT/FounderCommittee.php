<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: FounderCommittee.php
 * Create: 2018/3/17
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\PLATFORM\MODEL\DEPARTMENT;

use SMPlatform\PLATFORM\MODEL\DATA\Department;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\SinglePatternTrait;

/**
 * 创世委员会类
 * Class FounderCommittee
 * @package SMPlatform\PLATFORM\MODEL\DEPARTMENT
 */
class FounderCommittee extends Department
{
    use SinglePatternTrait; //加载单例模式
}