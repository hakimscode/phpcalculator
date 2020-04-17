<?php
namespace Jakmall\Recruitment\Calculator\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MultiplyCommand extends Command {
    protected static $defaultName = 'multiply';

    public function configure() {
        $this
            ->setDescription('Multiply all given numbers')
            ->addArgument(
                'numbers',
                InputArgument::IS_ARRAY,
                'The numbers to be multiplied (separate with space)'
            );
    }
    
    public function execute(InputInterface $input, OutputInterface $output) {
        $numbers = $input->getArgument('numbers');
        $result = 1;
        $out = "";
        for($i=0; $i<count($numbers); $i++){
            $result *= $numbers[$i];
            $out .= $i == count($numbers) - 1 ? 
                $numbers[$i] . ' = ' . $result : 
                $numbers[$i] . ' * ';
        }

        $output->write($out);
    }
}
