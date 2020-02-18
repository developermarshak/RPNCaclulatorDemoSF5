<?php
namespace Tests\Unit;

use App\CalculatorValuesStackInteractive;
use PHPUnit\Framework\TestCase;

class CalculatorValuesStackInteractiveTest extends TestCase
{
    /**
     * @var CalculatorValuesStackInteractive
     */
    protected $stackInstance;

    protected function setUp(): void
    {
        parent::setUp();
        $this->stackInstance = new CalculatorValuesStackInteractive();
    }

    public function testAddValue()
    {
        $this->stackInstance->addValue('1');
        $this->stackInstance->addValue('2');

        $this->assertSame('2', $this->stackInstance->getCurrentResult());
        $this->assertSame(['1', '2'], $this->stackInstance->getPair());
    }

    public function testAddResult()
    {
        $this->stackInstance->addValue('1');
        $this->stackInstance->addValue('1');
        $this->assertTrue($this->stackInstance->isReadyPair());

        $this->stackInstance->addResult('5');

        $this->assertFalse($this->stackInstance->isReadyPair());
        $this->assertSame('5', $this->stackInstance->getCurrentResult());

    }
}
