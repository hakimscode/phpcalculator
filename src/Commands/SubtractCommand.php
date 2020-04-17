<?php
namespace Jakmall\Recruitment\Calculator\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SubtractCommand extends Command {
    protected static $defaultName = 'subtract';

    public function configure() {
        $this
            ->setDescription('Subtract all given numbers')
            ->addArgument(
                'numbers',
                InputArgument::IS_ARRAY,
                'The numbers to be subtracted (separate with space)'
            );
    }
    
    public function execute(InputInterface $input, OutputInterface $output) {
        $numbers = $input->getArgument('numbers');
        $sumNumbers = $numbers[0];
        $out = "";
        for($i=0; $i<count($numbers); $i++){
            $sumNumbers -= $i != 0 ?
                $numbers[$i] :
                0;
            $out .= $i == count($numbers) - 1 ? 
                $numbers[$i] . ' = ' . $sumNumbers : 
                $numbers[$i] . ' - ';
        }

        $output->write($out);
    }
}
