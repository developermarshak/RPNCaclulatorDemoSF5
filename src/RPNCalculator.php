<?php

namespace App;


use App\Contract\CalculatorValuesStackInterface;
use App\Contract\OneStepCalculatorInterface;
use App\Contract\OperatorCollectionInterface;
use App\Contract\RPNCalculatorInterface;
use App\Contract\ValueValidatorInterface;

class RPNCalculator implements RPNCalculatorInterface
{
    protected $stack = [];

    protected $operatorCollection;

    protected $valueValidator;

    protected $oneStepCalculator;

    protected $inputStringsStack;

    function __construct(
        OperatorCollectionInterface $operatorCollection,
        ValueValidatorInterface $valueValidator,
        OneStepCalculatorInterface $oneStepCalculator
    )
    {
        $this->operatorCollection = $operatorCollection;
        $this->valueValidator = $valueValidator;
        $this->oneStepCalculator = $oneStepCalculator;
    }

    function enter($inputData, CalculatorValuesStackInterface $inputStringsStack): string
    {
        $parsedInput = $this->parseInput($inputData);

        foreach ($parsedInput as $inputValue) {
            if ($this->operatorCollection->existOperator($inputValue)) {
                $this->processOperatorKey($inputValue, $inputStringsStack);
            } else {
                $this->valueValidator->validate($inputValue);
                $inputStringsStack->addValue($inputValue);
            }
        }

        return $inputStringsStack->getCurrentResult();
    }

    protected function processOperatorKey($operatorKey, CalculatorValuesStackInterface $inputStringsStack) {
        if (!$inputStringsStack->isReadyPair()) {
            return;
        }

        list($first, $second) = $inputStringsStack->getPair();

        $result = $this->oneStepCalculator->calculate($first, $second, $operatorKey);

        $inputStringsStack->addResult($result);
    }

    protected function parseInput($inputData) : array {
        if (empty($inputData)) {
           return [];
        }

        $inputArray = explode(' ', $inputData);

        return array_filter($inputArray, function ($value) {
            return !empty($value);
        });
    }
}