<?php

namespace App\Contract;


interface OperatorCollectionInterface
{
    function existOperator(string $operatorKet) : bool;

    function getOperatorImplementation(string $key) : OperatorInterface;
}