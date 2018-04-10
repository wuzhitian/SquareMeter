<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: EstimatorCommittee.php
 * Create: 2018/3/17
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\PLATFORM\MODEL\DEPARTMENT;

use SMPlatform\PLATFORM\MODEL\DATA\Department;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\SinglePatternTrait;

/**
 * 评审委员会类
 * Class EstimatorCommittee
 * @package SMPlatform\PLATFORM\MODEL\DEPARTMENT
 */
class EstimatorCommittee extends Department
{
    use SinglePatternTrait; //加载单例模式
}