<?php
namespace App\Operators;

use App\Contract\OperatorInterface;
use App\Exception\ValidationException;

class DivideOperator implements OperatorInterface
{
    /**
     * @inheritDoc
     */
    public function getOperatorKey(): string
    {
        return '/';
    }

    /**
     * @inheritDoc
     */
    public function calculate($value1, $value2): string
    {
        if ($value2 == 0) {
            throw new ValidationException('Cannot division by zero');
        }

        return $value1 / $value2;
    }
}
