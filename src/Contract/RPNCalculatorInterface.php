<?php

namespace App\Contract;


interface RPNCalculatorInterface
{
    function enter(string $inputString, CalculatorValuesStackInterface $inputStringsStack) : string;
}