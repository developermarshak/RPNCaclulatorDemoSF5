<?php

namespace App\Contract;

interface OperatorInterface
{
    /**
     * Should return operator symbol/word that will be matched to input.
     * For example, it could be: '+', '-', '/', 'pov', '^', etc...
     *
     * @return string
     */
    public function getOperatorKey(): string;

    /**
     * Calculate first and second value by this operator
     *
     * @param  $firstValue
     * @param  $secondValue
     * @return string
     */
    public function calculate($firstValue, $secondValue) : string;
}
