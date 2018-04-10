<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: Amount.php
 * Create: 2018/4/9
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleFramework\LIBRARY\STRUCTURE;

use UmbServer\SwooleFramework\LIBRARY\UTIL\DataHandler;

/**
 * 金额数据结构扩展
 * Class Amount
 * @package UmbServer\SwooleFramework\LIBRARY\STRUCTURE
 */
class Amount
{
    public $value = 0; //整值
    public $decimal_bit = 0; //小数位
    public $precision = 6; //精度
    
    /**
     * 通过pre_value设置值
     * @param float $pre_value
     * @param int $precision
     */
    public
    function setByRealValue( float $pre_value, int $precision = 6 )
    {
        $decimal_bit = DataHandler::getDecimalBit( $pre_value );
        $value       = $pre_value * pow( 10, $decimal_bit );
        $this->setValue( $value );
        $this->setDecimalBit( $decimal_bit );
        $this->setPrecision( $precision );
        $this->checkDecimalBit();
    }
    
    /**
     * 通过小数位数和处理后的数值设置值
     * @param int $decimal_bit
     * @param int $value
     * @param int $precision
     */
    public
    function setByDecimalBitAndValue( int $decimal_bit, int $value, int $precision = 6 )
    {
        $this->setValue( $value );
        $this->setDecimalBit( $decimal_bit );
        $this->setPrecision( $precision );
        $this->checkDecimalBit();
    }
    
    /**
     * 获取真实值
     * @return float
     */
    public
    function getRealValue(): float
    {
        $res = $this->value / pow( 10, $this->decimal_bit );
        return $res;
    }
    
    /**
     * 设置value
     * @param int $value
     */
    private
    function setValue( int $value )
    {
        $this->value = $value;
    }
    
    /**
     * 设置小数位数
     * @param int $decimal_bit
     */
    private
    function setDecimalBit( int $decimal_bit )
    {
        $this->decimal_bit = $decimal_bit;
    }
    
    /**
     * 设置精度
     * @param $precision
     */
    private
    function setPrecision( $precision )
    {
        $this->precision = $precision;
    }
    
    /**
     * value为10的倍数时，将decimal_bit增加
     */
    private
    function checkDecimalBit()
    {
        while ( $this->value % 10 === 0 ) {
            $this->value = $this->value / 10;
            $this->decimal_bit++;
        }
    }
    
    /**
     * 是否相等
     * @param Amount $a
     * @param Amount $b
     * @param bool $is_consider_prevision
     * @return bool
     */
    public static
    function equal( self $a, self $b, bool $is_consider_prevision = false ): bool
    {
        $res = false;
        
    }
    
    /**
     * 比较两者大小，返回大的，如果相等就返回前者
     * @param Amount $a
     * @param Amount $b
     * @return Amount
     */
    public static
    function compare( self $a, self $b ): self
    {
        if ( self::equal( $a, $b ) === true ) {
        
        } else {
        
        }
    }
    
    /**
     * 多值相加
     * @param Amount[] ...$arguments
     * @return Amount
     */
    public static
    function add( self ...$arguments ): self
    {
        $res = new Amount();
        foreach ( $arguments as $amount ) {
            $res = self::_add( $res, $amount );
        }
        return $res;
    }
    
    /**
     * 加法
     * @param Amount $a
     * @param Amount $b
     * @return Amount
     */
    private static
    function _add( self $a, self $b ): self
    {
        $res         = new self();
        $decimal_bit = $a->decimal_bit > $b->decimal_bit ? $a->decimal_bit : $b->decimal_bit;
        $value       = $a->value * pow( 10, $decimal_bit - $a->decimal_bit ) + $b->value * pow( 10, $decimal_bit - $b->decimal_bit );
        $res->setByDecimalBitAndValue( $decimal_bit, $value );
        $res->checkDecimalBit();
        return $res;
    }
    
    /**
     * 减法
     * @param Amount $a
     * @param Amount $b
     * @return Amount
     */
    public static
    function minus( self $a, self $b ): self
    {
        $res         = new self();
        $decimal_bit = $a->decimal_bit > $b->decimal_bit ? $a->decimal_bit : $b->decimal_bit;
        $value       = $a->value * pow( 10, $decimal_bit - $a->decimal_bit ) - $b->value * pow( 10, $decimal_bit - $b->decimal_bit );
        $res->setByDecimalBitAndValue( $decimal_bit, $value );
        $res->checkDecimalBit();
        return $res;
    }
    
    /**
     *
     * @param Amount $a
     * @param float $b
     */
    public static
    function multiply( self $a, float $b )
    {
    
    }
}