<?php

namespace App\Contract;


interface RPNCalculatorInterface
{
    function enter($inputString, CalculatorValuesStackInterface $inputStringsStack) : string;
}