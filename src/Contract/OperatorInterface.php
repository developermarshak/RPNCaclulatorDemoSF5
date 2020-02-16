<?php

namespace App\Contract;


interface OperatorInterface
{
    function getOperatorKey(): string;

    function calculate($value1, $value2) : string;
}