<?php

namespace App;

use App\Contract\InputDataParserInterface;

class InputDataParser implements InputDataParserInterface
{
    /**
     * @inheritdoc
     */
    public function parse($inputData): array
    {
        if (empty($inputData)) {
            return [];
        }

        $inputArray = explode(' ', $inputData);

        $preparedInputValues = array_map(
            function ($value) {
                return trim($value);
            },
            $inputArray
        );

        $filteredValues = array_filter(
            $preparedInputValues,
            function ($value) {
                return !empty($value);
            }
        );

        return array_values($filteredValues);
    }
}
