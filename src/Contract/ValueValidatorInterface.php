<?php

namespace App\Contract;

interface ValueValidatorInterface
{
    public function validate(string $value);
}
