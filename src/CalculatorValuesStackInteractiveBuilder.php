<?php

namespace App;

use App\Contract\CalculatorValuesStackBuilderInterface;
use App\Contract\CalculatorValuesStackInterface;

class CalculatorValuesStackInteractiveBuilder implements CalculatorValuesStackBuilderInterface
{
    public function makeValuesStack(): CalculatorValuesStackInterface
    {
        return new CalculatorValuesStackInteractive();
    }
}
