<?php

namespace App;


use App\Contract\CalculatorValuesStackInterface;
use App\Contract\InputDataParserInterface;
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

    protected $inputDataParser;

    function __construct(
        OperatorCollectionInterface $operatorCollection,
        ValueValidatorInterface $valueValidator,
        OneStepCalculatorInterface $oneStepCalculator,
        InputDataParserInterface $inputDataParser
    )
    {
        $this->operatorCollection = $operatorCollection;
        $this->valueValidator = $valueValidator;
        $this->oneStepCalculator = $oneStepCalculator;
        $this->inputDataParser = $inputDataParser;
    }

    function enter($inputData, CalculatorValuesStackInterface $inputStringsStack): string
    {
        $parsedInput = $this->inputDataParser->parse($inputData);

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
}