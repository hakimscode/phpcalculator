<?php
namespace Jakmall\Recruitment\Calculator\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PowCommand extends Command {
    protected static $defaultName = 'pow';

    public function configure() {
        $this
            ->setDescription('Exponent given numbers')
            ->addArgument(
                'base',
                InputArgument::REQUIRED,
                'The base number'
            )
            ->addArgument(
                'exp',
                InputArgument::REQUIRED,
                'The exponent number'
            );

    }
    
    public function execute(InputInterface $input, OutputInterface $output) {
        $base = $input->getArgument('base');
        $exp = $input->getArgument('exp');
        $out = $base . ' ^ ' . $exp . ' = ' . pow($base, $exp);

        $output->write($out);
    }
}
