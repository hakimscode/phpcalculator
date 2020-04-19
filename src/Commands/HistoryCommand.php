<?php
namespace Jakmall\Recruitment\Calculator\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;
use Jakmall\Recruitment\Calculator\Services\StorageService;

class HistoryCommand extends Command {
    protected static $defaultName = 'history:list';

    protected $header = ['No', 'Command', 'Description', 'Result', 'Output', 'Time'];

    public function configure() {
        $this
            ->setDescription('Show calculator history')
            ->addArgument(
                'commands',
                InputArgument::IS_ARRAY,
                'Filter the history by commands'
            )
            ->addOption(
                'driver',
                'D',
                InputOption::VALUE_OPTIONAL,
                'Driver for storage connection [default: "database"]'
            );
    }
    
    public function execute(InputInterface $input, OutputInterface $output) {
        $commands = $input->getArgument('commands');
        $driver = $input->getOption('driver') ? $input->getOption('driver') : 'database';
        
        $fileStorage = new StorageService();
        $fileStorage->setFilterCommands($commands);
        $fileStorage->setDriver($driver);
        $data = $fileStorage->readHistory();
        
        if(count($data) > 0){
            $table = new Table($output);
            $table->setHeaders($this->header);
            $table->setRows($data);
            $table->render();
        }else{
            $output->write('History empty.');
        }
    }
}
