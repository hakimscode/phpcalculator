<?php
namespace Jakmall\Recruitment\Calculator\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DivideCommand extends Command {
    protected static $defaultName = 'divide';

    public function configure() {
        $this
            ->setDescription('Divide all given numbers')
            ->addArgument(
                'numbers',
                InputArgument::IS_ARRAY,
                'The numbers to be divided (separate with space)'
            );
    }
    
    public function execute(InputInterface $input, OutputInterface $output) {
        $numbers = $input->getArgument('numbers');
        $result = $numbers[0];
        $out = "";
        for($i=0; $i<count($numbers); $i++){
            $result /= $i != 0 ?
                $numbers[$i] :
                1;
            $out .= $i == count($numbers) - 1 ? 
                $numbers[$i] . ' = ' . $result : 
                $numbers[$i] . ' - ';
        }

        $output->write($out);
    }
}
