<?php
namespace App\Operators;

use App\Contract\OperatorInterface;
use App\Exception\ValidationException;

class PlusOperator implements OperatorInterface
{
    /**
     * @inheritDoc
     */
    public function getOperatorKey(): string
    {
        return '+';
    }

    /**
     * @inheritDoc
     */
    public function calculate($value1, $value2): string
    {
        return $value1 + $value2;
    }
}
