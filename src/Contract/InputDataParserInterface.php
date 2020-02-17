<?php

namespace App\Contract;


interface InputDataParserInterface
{
    function parse($inputData) : array;
}