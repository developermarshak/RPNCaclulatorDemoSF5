<?php

namespace App\Contract;


interface CalculatorValuesStackBuilderInterface
{
    function makeValuesStack() : CalculatorValuesStackInterface;
}