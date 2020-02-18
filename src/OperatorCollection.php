<?php
namespace App;

use App\Contract\OperatorCollectionInterface;
use App\Contract\OperatorInterface;

/**
 * Class OperatorCollection
 * @package App
 */
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
    public function existOperator(string $operatorKey): bool
    {
        return isset($this->operators[$operatorKey]);
    }

    /**
     * @inheritDoc
     */
    public function getOperatorImplementation(string $operatorKey): OperatorInterface
    {
        return $this->operators[$operatorKey];
    }

    /**
     * Method for injection all configured operators by one
     *
     * @param OperatorInterface $operator
     */
    public function addOperator(OperatorInterface $operator)
    {
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
