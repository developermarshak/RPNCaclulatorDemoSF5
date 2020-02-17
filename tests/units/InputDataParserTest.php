<?php
namespace Tests\Unit;

use App\InputDataParser;
use PHPUnit\Framework\TestCase;

class InputDataParserTest extends TestCase
{

    /**
     * @return array
     */
    public function parserDataProvider(){
        return [
            ['', []],
            [null, []],
            ['   ', []],
            ["\t",[]],
            ['1 ', ['1']],
            ['1   2   ', ['1', '2']],
            ['1 asdf ', ['1', 'asdf']],
            ["\t1\n 2", ['1','2']],
            ['   1  2  +- " 33 2', ['1', '2', '+-', '"', '33', '2']]

        ];
    }

    /**
     * @param $input
     * @param $expectedOutput
     *
     * @dataProvider parserDataProvider
     */
    public function testParse($input, $expectedOutput)
    {
        $inputDataParser = new InputDataParser();
        $result = $inputDataParser->parse($input);
        $this->assertSame($expectedOutput, $result);
    }
}
