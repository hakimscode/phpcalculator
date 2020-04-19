<?php
namespace Jakmall\Recruitment\Calculator\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Jakmall\Recruitment\Calculator\Services\CalculateService;

class PowCommand extends Command {
    protected static $defaultName = 'pow';
    private $calculateService;

    public function configure() {
        $this->calculateService = new CalculateService();
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
        $output->write($this->calculateService->pow($base, $exp));
    }
}
