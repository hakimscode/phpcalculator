<?php
namespace Jakmall\Recruitment\Calculator\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AddCommand extends Command {
    protected static $defaultName = 'add';

    public function configure() {
        $this
            ->setDescription('Add all given numbers')
            ->addArgument(
                'numbers',
                InputArgument::IS_ARRAY,
                'The numbers to be added (separate with space)'
            );
    }
    
    public function execute(InputInterface $input, OutputInterface $output) {
        $numbers = $input->getArgument('numbers');
        $sumNumbers = 0;
        $out = "";
        for($i=0; $i<count($numbers); $i++){
            $sumNumbers += $numbers[$i];
            $out .= $i == count($numbers) - 1 ? 
                $numbers[$i] . ' = ' . $sumNumbers : 
                $numbers[$i] . ' + ';
        }

        $output->write($out);
    }
}
