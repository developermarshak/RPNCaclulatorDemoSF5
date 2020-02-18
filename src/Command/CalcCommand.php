<?php
namespace App\Command;

use App\Contract\CalculatorValuesStackBuilderInterface;
use App\Contract\RPNCalculatorInterface;
use App\Exception\ValidationException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\StreamableInputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class CalcCommand extends Command
{
    protected static $defaultName = 'calc';

    protected $calculator;

    protected $valuesStack;

    public function __construct(
        RPNCalculatorInterface $calculator,
        CalculatorValuesStackBuilderInterface $calculatorValuesStackBuilder
    ) {
        $this->calculator = $calculator;
        $this->valuesStack = $calculatorValuesStackBuilder->makeValuesStack();

        parent::__construct(null);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $questionHelper = $this->getHelper('question');

        if (!$input instanceof StreamableInputInterface) {
            throw new \InvalidArgumentException('$input should be instance of StreamableInputInterface');
        }

        $input->setInteractive(true);

        while (true) {
            $q = new Question('> ');

            $inputString = $questionHelper->ask($input, $output, $q);

            if ($inputString === 'q') {
                return 0;
            }

            try {
                $result = $this->calculator->calculate($inputString, $this->valuesStack);
                $output->writeln($result);
            } catch (ValidationException $exception) {
                $output->writeln($exception->getMessage().', please try again.');
                continue;
            } catch (\Exception $exception) {
                $output->writeln(
                    'Inner application error, please try again or contact support (support@help-yourself.com)'
                );
                continue;
            }
        }


        return 0;
    }
}
