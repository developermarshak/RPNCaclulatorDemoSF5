<?php

namespace App\Contract;

interface InputDataParserInterface
{
    /**
     * Explode and trim input data to strings array
     *
     * @param  string|null $inputData
     * @return string[]
     */
    public function parse($inputData) : array;
}
