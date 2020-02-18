<?php

namespace App;

use App\Contract\OneStepCalculatorInterface;
use App\Contract\OperatorCollectionInterface;

class OneStepCalculator implements OneStepCalculatorInterface
{
    protected $operatorCollection;

    public function __construct(OperatorCollectionInterface $operatorCollection)
    {
        $this->operatorCollection = $operatorCollection;
    }

    public function calculate(string $value1, string $value2, string $operatorKey): string
    {
        $operator = $this->operatorCollection->getOperatorImplementation($operatorKey);
        return $operator->calculate($value1, $value2);
    }
}
