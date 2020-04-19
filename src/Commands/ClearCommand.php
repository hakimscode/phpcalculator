<?php
namespace Jakmall\Recruitment\Calculator\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Jakmall\Recruitment\Calculator\Services\StorageService;

class ClearCommand extends Command {
    protected static $defaultName = 'history:clear';

    public function configure() {
        $this->setDescription('Clear saved history');
    }
    
    public function execute(InputInterface $input, OutputInterface $output) {
        $fileStorage = new StorageService();
        $fileStorage->clearHistory();
        $output->write('History cleared!');
    }
}
