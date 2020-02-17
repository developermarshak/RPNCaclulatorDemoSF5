<?php
namespace App;


use App\Contract\OperatorCollectionInterface;
use App\Contract\OperatorInterface;

class OperatorCollection implements OperatorCollectionInterface
{
    /**
     * Operators array. Key is operator key. Value is operator instance.
     *
     * @var OperatorInterface[]
     */
    protected $operators;

    /**
     * @inheritDoc
     */
    function existOperator(string $operatorKey): bool
    {
        return isset( $this->operators[$operatorKey] );
    }

    /**
     * @inheritDoc
     */
    function getOperatorImplementation(string $operatorKey): OperatorInterface
    {
       return $this->operators[$operatorKey];
    }

    /**
     * Method for injection all configured operators by one
     *
     * @param OperatorInterface $operator
     */
    function addOperator(OperatorInterface $operator){
        $operatorKey = $operator->getOperatorKey();

        if (empty($operatorKey)) {
            throw new \InvalidArgumentException('Operator key should NOT be empty');
        }

        if (isset($this->operators[$operatorKey])) {
            throw new \InvalidArgumentException('Duplicate operator key: ' . $operatorKey);
        }

        $this->operators[$operatorKey] = $operator;
    }
}