<?php declare( strict_types = 1 );
/**
 * Project: EOSS
 * File: ContractVisitor.php
 * Create: 2018/4/10
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace EOSS\COMPONENT\VISITOR;

/**
 * 合约访问器类
 * Class ContractVisitor
 * @package EOSS\COMPONENT\VISITOR
 */
class ContractVisitor extends Visitor
{
    private $contract;

    public
    function setContract( $contract )
    {
        $this->contract = $contract;
    }

    public
    function select( string $method )
    {

    }

    public
    function execute()
    {

    }
}