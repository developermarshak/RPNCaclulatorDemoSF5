<?php

namespace App\Contract;

//> 5
//5
//> 9
//9
//> 1
//1
//> -
//8
//> /
//0.625

//5
//9
//1

//5
//8

//0.625

/**
 * Should be remove
 *
 * Interface InputStringsStack
 * @package App
 */
interface CalculatorValuesStackInterface
{
    /**
     * Add string (value or operator) to calculation stack
     *
     * @param string $value
     * @return void
     */
    function addValue(string $value) : void;

    /**
     * @return bool
     */
    function isReadyPair() : bool;

    function getPair() : array;

    /**
     * @param string $string
     */
    function addResult(string $string) : void;

    /**
     * Get current calculated result or last value
     *
     * @return string
     */
    function getCurrentResult() : string;
}