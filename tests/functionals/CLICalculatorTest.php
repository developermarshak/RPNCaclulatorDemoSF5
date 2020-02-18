<?php

use PHPUnit\Framework\TestCase;
use \Symfony\Component\Console\Tester\CommandTester;

class CLICalculatorTest extends TestCase
{
    protected $commandTester;

    protected $questionHelper;

    function setUp(): void
    {
        parent::setUp();
        list(1 => $container) = require(__DIR__.'/../../bootstrap.php');

        /** @var \App\Command\CalcCommand $command */
        $command = $container->get(\App\Command\CalcCommand::class);

        $this->commandTester = new CommandTester($command);
    }

    /**
     * @return array
     */
    function inputsAndExceptedDataProvider(){
        return [
            [['5', '8', '+'], "> 5\n> 8\n> 13\n> "],
            [['5 8 +', '13 -'], "> 13\n> 0\n> "],
            [['-3', '-2', '*', '5', '+'], "> -3\n> -2\n> 6\n> 5\n> 11\n> "],
            [['5', '9', '1', '-', '/'], "> 5\n> 9\n> 1\n> 8\n> 0.625\n> "],
        ];
    }

    /**
     * @param $inputs
     * @param $excepted
     *
     * @dataProvider inputsAndExceptedDataProvider
     */
    function testCalculator($inputs, $excepted){

        $commandTester = $this->commandTester;

        $commandTester->setInputs(array_merge($inputs, ['q']));

        $commandTester->execute([]);

        $data = $commandTester->getDisplay();

        $this->assertSame($excepted, $data);
    }
}
