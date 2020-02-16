<?php

namespace App\Contract;


interface OneStepCalculatorInterface
{
    function calculate(string $value1, string $value2, string $operatorKey) : string;
}