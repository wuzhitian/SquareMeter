<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: RecommenderCommittee.php
 * Create: 2018/3/17
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\PLATFORM\MODEL\DEPARTMENT;

use SMPlatform\PLATFORM\MODEL\DATA\Department;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\SinglePatternTrait;

/**
 * 推荐委员会类
 * Class RecommenderCommittee
 * @package SMPlatform\PLATFORM\MODEL\DEPARTMENT
 */
class RecommenderCommittee extends Department
{
    use SinglePatternTrait; //加载单例模式
}