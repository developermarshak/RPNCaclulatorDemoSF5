<?php

namespace App;

use App\Contract\CalculatorValuesStackInterface;

class CalculatorValuesStackInteractive implements CalculatorValuesStackInterface
{
    /**
     * Stack with values
     *
     * @var array
     */
    protected $stack = [];

    /**
     * @inheritDoc
     */
    public function addValue(string $value): void
    {
        $this->stack[] = $value;
    }

    /**
     * @inheritDoc
     */
    public function isReadyPair(): bool
    {
        return count($this->stack) >= 2;
    }

    /**
     * @inheritDoc
     */
    public function getPair(): array
    {
        return array_slice($this->stack, -2);
    }

    /**
     * @inheritDoc
     */
    public function addResult(string $result): void
    {
        array_pop($this->stack);
        array_pop($this->stack);
        $this->addValue($result);
    }

    /**
     * @inheritDoc
     */
    public function getCurrentResult(): string
    {
        return end($this->stack);
    }
}
