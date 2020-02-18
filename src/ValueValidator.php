<?php

namespace App;

use App\Contract\ValueValidatorInterface;
use App\Exception\ValidationException;

class ValueValidator implements ValueValidatorInterface
{
    public function validate(string $value)
    {
        if (!is_numeric($value)) {
            throw new ValidationException('Input value should be numeric');
        }
    }
}
