<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: Project.php
 * Create: 2018/4/9
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\PLATFORM\MODEL\DATA;

use UmbServer\SwooleFramework\LIBRARY\INSTANCE\Instance;

/**
 * 项目类
 * Class Project
 * @package SMPlatform\PLATFORM\MODEL\DATA
 */
class Project extends Instance
{
    const TABLE_NAME = 'Project';
    
    const SCHEMA = [
        'name'              => STRING_TYPE,
        'type'              => STRING_TYPE,
        'number'            => STRING_TYPE,
        'alias'             => STRING_TYPE,
        'is_digitalized'    => BOOL_TYPE,
        'token_id'          => STRING_TYPE,
        'position_id'       => STRING_TYPE,
        'digital_estate_id' => STRING_TYPE,
        'statue'            => STRING_TYPE,
    ];
    
    public $name; //项目名称
    public $type; //项目类型
    public $number; //项目编号
    public $alias; //项目别名
    public $is_digitalized; //是否已经数字化
    public $token_id; //token id
    public $position_id; //头寸id
    public $digital_estate_id; //数字资产id
    public $statue; //项目状态
    
    /**
     * 数字化
     */
    public
    function digital()
    {
        if ( $this->is_digitalized === false ) {
            $position             = $this->getPosition();
            $initial_issue_amount = $position->target_amount;
            $digital_estate       = new DigitalEstate();
            $this->setDigitalEstate( $digital_estate );
            $digital_estate->issue( $initial_issue_amount );
            $this->is_digitalized = true;
            $this->update();
        } else {
            //TODO 业务错误，已经数字化，不可再次数字化
        }
    }
    
    /**
     * 获取头寸
     * @return Position
     */
    private
    function getPosition(): Position
    {
        return Position::getById( $this->position_id );
    }
    
    /**
     * 设置头寸
     * @param Position $position
     */
    private
    function setPosition( Position $position )
    {
        $this->position_id = $position->id;
    }
    
    /**
     * 获取数字资产
     * @return DigitalEstate
     */
    private
    function getDigitalEstate(): DigitalEstate
    {
        return DigitalEstate::getById( $this->digital_estate_id );
    }
    
    /**
     * 设置数字资产
     * @param DigitalEstate $digital_estate
     */
    private
    function setDigitalEstate( DigitalEstate $digital_estate )
    {
        $this->digital_estate_id = $digital_estate->id;
    }
}