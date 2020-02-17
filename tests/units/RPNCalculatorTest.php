<?php
namespace Tests\Unit;

use App\Contract\CalculatorValuesStackInterface;
use App\Contract\InputDataParserInterface;
use App\Contract\OneStepCalculatorInterface;
use App\Contract\OperatorCollectionInterface;
use App\Contract\ValueValidatorInterface;
use App\RPNCalculator;

class RPNCalculatorTest extends \PHPUnit\Framework\TestCase
{
    function testOneValidSymbolProcessing(){

        $stack = $this->getMockBuilder(CalculatorValuesStackInterface::class)->getMock();

        $operators = $this->getMockBuilder(OperatorCollectionInterface::class)->getMock();

        $operators->expects($this->once())
            ->method('existOperator')
            ->with('1')
            ->willReturn(false);

        $parser = $this->getMockBuilder(InputDataParserInterface::class)->getMock();

        $parser->expects($this->once())
            ->method('parse')
            ->with('1')
            ->willReturn(['1']);

        $validator = $this->getMockBuilder(ValueValidatorInterface::class)->getMock();

        $validator->expects($this->once())
            ->method('validate')
            ->with('1');

        $stack->expects($this->once())
            ->method('addValue')
            ->with('1');

        $stack->expects($this->once())
            ->method('getCurrentResult')
            ->willReturn('1');

        $calculator = new RPNCalculator(
            $operators,
            $validator,
            $this->getMockBuilder(OneStepCalculatorInterface::class)->getMock(),
            $parser
        );

        $res = $calculator->calculate('1', $stack);

        $this->assertSame('1', $res);
    }
}