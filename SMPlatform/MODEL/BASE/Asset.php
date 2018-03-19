<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: Asset.php
 * Create: 2018/3/17
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\MODEL\BASE;

use UmbServer\SwooleFramework\LIBRARY\INSTANCE\Instance;

/**
 * 资产基类
 * Class Asset
 * @package SMPlatform\MODEL\BASE
 */
class Asset extends Instance
{
    public $id;
    public $pre_owner; //资产原持有人
    public $owner; //持有人
    public $project_id; //项目id
    public $id_digital = false; //是否已经数字化

    /**
     * 资产数字化
     */
    public
    function digital()
    {

    }

    /**
     * 资产清算
     */
    public
    function clear()
    {

    }
}