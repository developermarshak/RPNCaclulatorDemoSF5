<?php
/*
 * This file is part of the OpCart software.
 *
 * (c) 2019, Ecentria, Inc
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Unit;

use App\Contract\OperatorInterface;
use App\OperatorCollection;
use PHPUnit\Framework\TestCase;

class OperatorCollectionTest extends TestCase
{

    public function testFillingCorrectOperator()
    {
        $collection = new OperatorCollection();

        $operator = $this->getOperatorMock('+');

        $collection->addOperator($operator);

        $result = $collection->getOperatorImplementation('+');

        $this->assertSame($result, $operator);
    }

    public function testFillingNotCorrectOperator()
    {
        $this->expectException(\InvalidArgumentException::class);

        $collection = new OperatorCollection();

        $operator = $this->getOperatorMock('');

        $collection->addOperator($operator);
    }

    public function testFillingDoubleOperators()
    {
        $this->expectException(\InvalidArgumentException::class);

        $collection = new OperatorCollection();

        $operator = $this->getOperatorMock('-');
        $operator2 = $this->getOperatorMock('+');
        $operator3 = $this->getOperatorMock('-');

        $collection->addOperator($operator);
        $collection->addOperator($operator2);
        $collection->addOperator($operator3);
    }

    /**
     * @param $operatorKey
     * @return \PHPUnit\Framework\MockObject\MockObject|OperatorInterface
     */
    protected function getOperatorMock($operatorKey) {
        $operator = $this->getMockBuilder(OperatorInterface::class)->getMock();

        $operator->method('getOperatorKey')->willReturn($operatorKey);

        return $operator;
    }
}
