<?php

namespace App\Contract;

use App\Exception\ValidationException;

interface OneStepCalculatorInterface
{
    /**
     * Calculate two value by operator
     *
     * @param string $value1
     * @param string $value2
     * @param string $operatorKey
     *
     * @return string
     * @throws ValidationException
     */
    public function calculate(string $value1, string $value2, string $operatorKey): string;
}
