<?php
namespace App\Operators;


use App\Contract\OperatorInterface;
use App\Exception\ValidationException;

class MultiplyOperator implements OperatorInterface
{
    /**
     * @inheritDoc
     */
    function getOperatorKey(): string
    {
        return '*';
    }

    /**
     * @inheritDoc
     */
    public function calculate($value1, $value2): string
    {
        return $value1 * $value2;
    }
}