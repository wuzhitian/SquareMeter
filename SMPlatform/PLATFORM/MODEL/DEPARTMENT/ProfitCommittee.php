<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: ProfitCommittee.php
 * Create: 2018/4/10
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\PLATFORM\MODEL\DEPARTMENT;

use SMPlatform\PLATFORM\MODEL\DATA\Department;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\SinglePatternTrait;

/**
 * 平台利润委会员类
 * Class ProfitCommittee
 * @package SMPlatform\PLATFORM\MODEL\DEPARTMENT
 */
class ProfitCommittee extends Department
{
    use SinglePatternTrait; //加载单例模式
}