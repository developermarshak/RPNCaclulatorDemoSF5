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
    function testOneValueProcessing(){
        $operators = $this->getOperatorCollectionMock([
            '1' => false
        ]);

        $stack = $this->getCalculatorValuesMock();

        $stack->expects($this->once())
            ->method('addValue')
            ->with('1');

        $stack->expects($this->once())
            ->method('getCurrentResult')
            ->willReturn('1');

        $calculator = new RPNCalculator(
            $operators,
            $this->getValidatorValueMock(['1']),
            $this->getOneStepCalculatorMock(),
            $this->getInputDataParserMock('1', ['1'])
        );

        $res = $calculator->calculate('1', $stack);

        $this->assertSame('1', $res);
    }

    function testTwoValuesProcessing(){

        $operators = $this->getOperatorCollectionMock([
            '1' => false,
            '2' => false
        ]);

        $parser = $this->getInputDataParserMock('1 2', ['1', '2']);

        $validator = $this->getValidatorValueMock(['1', '2']);

        $stack = $this->getCalculatorValuesMock();

        $stack->expects($this->at(0))
            ->method('addValue')
            ->with('1');

        $stack->expects($this->at(1))
            ->method('addValue')
            ->with('2');

        $stack->expects($this->once())
            ->method('getCurrentResult')
            ->willReturn('2');

        $calculator = new RPNCalculator(
            $operators,
            $validator,
            $this->getOneStepCalculatorMock(),
            $parser
        );

        $res = $calculator->calculate('1 2', $stack);

        $this->assertSame('2', $res);
    }

    function testTwoValuesAndOneOperatorProcessing(){

        $operators = $this->getOperatorCollectionMock([
            '1' => false,
            '2' => false,
            '+' => true
        ]);

        $parser = $this->getInputDataParserMock('1 2 +', ['1', '2', '+']);

        $parser->expects($this->once())
            ->method('parse')
            ->with('1 2 +')
            ->willReturn(['1', '2', '+']);

        $validator = $this->getValidatorValueMock(['1', '2']);

        $stack = $this->getCalculatorValuesMock();

        $stack->expects($this->at(0))
            ->method('addValue')
            ->with('1');

        $stack->expects($this->at(1))
            ->method('addValue')
            ->with('2');

        $stack->expects($this->once())
            ->method('addResult')
            ->with('3');

        $stack->expects($this->once())
            ->method('isReadyPair')
            ->willReturn(true);

        $stack->expects($this->once())
            ->method('getPair')
            ->willReturn(['2', '1']);

        $stack->expects($this->once())
            ->method('getCurrentResult')
            ->willReturn('3');

        $oneStepCalc = $this->getOneStepCalculatorMock();

        $oneStepCalc->expects($this->once())
            ->method('calculate')
            ->with('2', '1', '+')
            ->willReturn('3');

        $calculator = new RPNCalculator(
            $operators,
            $validator,
            $oneStepCalc,
            $parser
        );

        $res = $calculator->calculate('1 2 +', $stack);

        $this->assertSame('3', $res);
    }

    function testOneValueAndOneOperatorProcessing() {
        $operators = $this->getOperatorCollectionMock([
            '1' => false,
            '+' => true
        ]);

        $parser = $this->getInputDataParserMock('1 +', ['1', '+']);

        $validator = $this->getValidatorValueMock(['1']);

        $stack = $this->getCalculatorValuesMock();

        $stack->expects($this->at(0))
            ->method('addValue')
            ->with('1');

        $stack->expects($this->never())
            ->method('addResult');

        $stack->expects($this->once())
            ->method('isReadyPair')
            ->willReturn(false);

        $stack->expects($this->never())
            ->method('getPair');

        $stack->expects($this->once())
            ->method('getCurrentResult')
            ->willReturn('1');

        $oneStepCalc = $this->getOneStepCalculatorMock();

        $oneStepCalc->expects($this->never())
            ->method('calculate');

        $calculator = new RPNCalculator(
            $operators,
            $validator,
            $oneStepCalc,
            $parser
        );

        $res = $calculator->calculate('1 +', $stack);

        $this->assertSame('1', $res);
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|CalculatorValuesStackInterface
     */
    protected function getCalculatorValuesMock(){
        return $this->getMockBuilder(CalculatorValuesStackInterface::class)->getMock();
    }

    /**
     * @param string $exceptedInput
     * @param array  $output
     * @return \PHPUnit\Framework\MockObject\MockObject|InputDataParserInterface
     */
    protected function getInputDataParserMock($exceptedInput, $output){
        $parser = $this->getMockBuilder(InputDataParserInterface::class)->getMock();

        $parser->expects($this->once())
            ->method('parse')
            ->with($exceptedInput)
            ->willReturn($output);

        return $parser;
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|OneStepCalculatorInterface
     */
    protected function getOneStepCalculatorMock(){
        return $this->getMockBuilder(OneStepCalculatorInterface::class)->getMock();
    }

    /**
     * @param array $existOperatorsExcepted
     * @return \PHPUnit\Framework\MockObject\MockObject|OperatorCollectionInterface
     */
    protected function getOperatorCollectionMock(array $existOperatorsExcepted) {
        $operators = $this->getMockBuilder(OperatorCollectionInterface::class)->getMock();

        $i = 0;
        foreach ($existOperatorsExcepted as $argument => $returnValue){
            $operators->expects($this->at($i))
                ->method('existOperator')
                ->with($argument)
                ->willReturn($returnValue);
            $i++;
        }

        return $operators;
    }

    /**
     * Return ValueValidatorInterface mock with excepted method
     *
     * @param array $exceptedCallsArgument
     * @return \PHPUnit\Framework\MockObject\MockObject|ValueValidatorInterface
     */
    protected function getValidatorValueMock(array $exceptedCallsArgument){
        $validator = $this->getMockBuilder(ValueValidatorInterface::class)->getMock();
        $i = 0;
        foreach ($exceptedCallsArgument as $callArg){
            $validator->expects($this->at($i))
                ->method('validate')
                ->with($callArg);
            $i++;
        }
        return $validator;
    }
}