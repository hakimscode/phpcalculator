<?php
namespace Jakmall\Recruitment\Calculator\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Jakmall\Recruitment\Calculator\Services\CalculateService;

class DivideCommand extends Command {
    protected static $defaultName = 'divide';
    private $calculateService;

    public function configure() {
        $this->calculateService = new CalculateService();
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
        $output->write($this->calculateService->divide($numbers));
    }
}
