<?php declare( strict_types = 1 );
/**
 * Project: SMPlatform
 * File: DigitalEstate.php
 * Create: 2018/4/9
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: SMBC Inc.
 */

namespace SMPlatform\PLATFORM\MODEL\DATA;

use SMPlatform\PLATFORM\MODEL\ENUM\_DigitalEstateLiquidateMode;
use SMPlatform\PLATFORM\MODEL\ENUM\_DigitalEstateIssueMode;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\Instance;
use UmbServer\SwooleFramework\LIBRARY\INSTANCE\InstanceTrait;

/**
 * 数字资产类，项目数字化成功以后就变成了数字资产
 * Class DigitalEstate
 * @package SMPlatform\PLATFORM\MODEL\DATA
 */
class DigitalEstate extends Instance
{
    use InstanceTrait;
    
    const TABLE_NAME = 'Estate';
    
    const SCHEMA = [
        'project_id'     => STRING_TYPE,
        'token_id'       => STRING_TYPE,
        'position_id'    => STRING_TYPE,
        'publish_mode'   => STRING_TYPE,
        'liquidate_mode' => STRING_TYPE,
    ];
    
    public $project_id; //项目id
    public $token_id; //token id
    public $position_id; //头寸_id
    public $publish_mode = _DigitalEstateIssueMode::DYNAMIC; //发行模式
    public $liquidate_mode = _DigitalEstateLiquidateMode::VOTE; //清算模式
    
    /**
     * 发行
     * @param $amount
     */
    public
    function issue( $amount )
    {
        $token = new Token();
        $this->setToken( $token );
    }
    
    /**
     * 增发
     * @param $increase_amount
     */
    public
    function increase( $increase_amount )
    {
    
    }
    
    /**
     * 减发
     * @param $decrease_amount
     */
    public
    function decrease( $decrease_amount )
    {
    
    }
    
    /**
     * 设置token
     * @param Token $token
     */
    private
    function setToken( Token $token )
    {
        $this->token_id = $token->id;
    }
    
    /**
     * 获取token
     * @return Token
     */
    private
    function getToken(): Token
    {
        return Token::getById( $this->token_id );
    }
}