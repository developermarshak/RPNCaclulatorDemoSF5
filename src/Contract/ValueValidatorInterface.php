<?php

namespace App\Contract;


interface ValueValidatorInterface
{
    function validate(string $value);
}