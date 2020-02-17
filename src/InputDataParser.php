<?php

namespace App;


use App\Contract\InputDataParserInterface;

class InputDataParser implements InputDataParserInterface
{
    function parse($inputData): array
    {
        if (empty($inputData)) {
            return [];
        }

        $inputArray = explode(' ', $inputData);

        return array_filter($inputArray, function ($value) {
            return !empty($value);
        });
    }

}