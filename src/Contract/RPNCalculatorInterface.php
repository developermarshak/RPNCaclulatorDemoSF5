<?php

namespace App\Contract;

use App\Exception\ValidationException;

interface RPNCalculatorInterface
{
    /**
     * Calculate result by input value or operator and values stack.
     * Change values stack after calculated result.
     *
     * Return last input value in this cases:
     *  - If stack not exist pair for operation
     *  - If last input is value
     * In other cases return result or throw validation error.
     *
     * @param string|null                    $inputString
     * @param CalculatorValuesStackInterface $inputStringsStack
     *
     * @return string
     *
     * @throws ValidationException
     */
    public function calculate($inputString, CalculatorValuesStackInterface $inputStringsStack) : string;
}
