<?php

namespace App\Contract;


interface OperatorCollectionInterface
{
    /**
     * Checking exist operator with this key in this collection
     *
     * @param string $operatorKey
     * @return bool
     */
    function existOperator(string $operatorKey) : bool;

    /**
     * Return operator implementation by operator key
     *
     * @param string $operatorKey
     * @return OperatorInterface
     */
    function getOperatorImplementation(string $operatorKey) : OperatorInterface;
}