<?php
namespace Jakmall\Recruitment\Calculator\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Jakmall\Recruitment\Calculator\Services\CalculateService;

class MultiplyCommand extends Command {
    protected static $defaultName = 'multiply';
    private $calculateService;

    public function configure() {
        $this->calculateService = new CalculateService();
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
        $output->write($this->calculateService->multiply($numbers));
    }
}
