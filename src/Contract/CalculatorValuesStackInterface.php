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

interface CalculatorValuesStackInterface
{
    /**
     * Add string (value or operator) to calculation stack
     *
     * @param  string $value
     * @return void
     */
    public function addValue(string $value) : void;

    /**
     * Check existing minimum 2 values for make some operation
     *
     * @return bool
     */
    public function isReadyPair() : bool;

    /**
     * Return swapped last 2 values from stack
     *
     * @return array
     */
    public function getPair() : array;

    /**
     * Remove last pair from stack and add result to stack
     *
     * @param string $string
     */
    public function addResult(string $string) : void;

    /**
     * Get current result (last value)
     *
     * @return string
     */
    public function getCurrentResult() : string;
}
