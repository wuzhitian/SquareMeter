<?php declare( strict_types = 1 );
/**
 * Project: UmbServerSwooleFramework
 * File: AlgorithmTester.php
 * Create: 2018/3/16
 * Author: Hugh.Lee
 * Email: umbrellahughlee@gmail.com
 * Copyright: Umbrella Inc.
 */

namespace UmbServer\SwooleDevtools\COMPONENT\TEST;

/**
 * 算法检测器接口类
 * Interface AlgorithmTester
 * @package UmbServer\SwooleDevtools\COMPONENT\TEST
 */
interface AlgorithmTester
{
    public
    function setAlgorithm( $algorithm );

    public
    function input( $request );

    public
    function output( $response );
}