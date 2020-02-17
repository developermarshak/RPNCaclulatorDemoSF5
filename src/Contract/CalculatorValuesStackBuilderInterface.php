<?php

namespace App\Contract;


interface CalculatorValuesStackBuilderInterface
{
    /**
     * Build instance of some implementation of CalculatorValuesStackInterface
     *
     * @return CalculatorValuesStackInterface
     */
    function makeValuesStack() : CalculatorValuesStackInterface;
}