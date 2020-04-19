<?php
namespace Jakmall\Recruitment\Calculator\Services;

use Jakmall\Recruitment\Calculator\Services\DatabaseService;

class StorageService {

    protected $fileUrl = 'log.txt';

    private $db;

    private $command;
    private $description;
    private $result;
    private $output;
    private $time;
    private $filterCommands = [];
    private $driver = 'database';

    public function setCommand($command) {
        $this->command = $command;
    }

    public function getCommand() {
        return $this->command;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setResult($result) {
        $this->result = $result;
    }

    public function getResult(){
        return $this->result;
    }

    public function setOutput($output) {
        $this->output = $output;
    }

    public function getOutput() {
        return $this->output;
    }

    public function setFilterCommands($filterCommands) {
        $this->filterCommands = $filterCommands;
    }

    public function getFilterCommands() {
        return $this->filterCommands;
    }

    public function setDriver($driver) {
        $this->driver = $driver;
    }

    public function getDriver() {
        return $this->driver;
    }

    function __construct() {
        $this->db = new DatabaseService();
    }

    public function saveHistory() {
        $this->db->query('INSERT INTO histories (command, description, result, output, time) VALUES 
            (
                "' . $this->getCommand() . '",
                "' . $this->getDescription() . '",
                "' . $this->getResult() . '",
                "' . $this->getOutput() . '",
                "'.date("Y-m-d h:i:s").'"
            )
        ');
        $this->db->execute();

        $body = $this->getCommand() . ',' . 
            $this->getDescription() . ',' . 
            $this->getResult() . ',' . 
            $this->getOutput() . ',' .
            date('Y-m-d h:i:s');

        if(file_exists($this->fileUrl)){
            $read = file($this->fileUrl);
            if(count($read) > 0){
                $body = PHP_EOL . $body;
            }
        }

        file_put_contents($this->fileUrl, $body, FILE_APPEND);
    }

    public function readHistory() {
        $filterCommands = $this->getFilterCommands();

        if($this->getDriver() == 'database'){
            $where = "";
            if(count($filterCommands) > 0){
                $strCommands = implode('","', $filterCommands);
                $strCommands = '"' . $strCommands . '"';
                $where = ' WHERE command IN ('.$strCommands.')';
            }
            $this->db->query('SELECT * FROM histories' . $where);
            $read = $this->db->resultSet();
            if(count($read) == 0){
                return array();
            }else{
                return $read;
            }
        }else{
            if(!file_exists($this->fileUrl)){
                return array();
            }else{
                $read = file($this->fileUrl);
                if(count($read) == 0){
                    return array();
                }else{
                    $data = [];
                    $no = 1;
                    foreach($read as $val){
                        $rows = explode(",", $val);
                        if(count($filterCommands) > 0){
                            if(!in_array(strtolower($rows[0]), $filterCommands)){
                                continue;
                            }
                        }
                        array_unshift($rows, $no);
                        array_push($data, $rows);
                        $no++;
                    }
                    return $data;
                }
            }
        }
    }

    public function clearHistory() {
        $this->db->query('DELETE FROM histories');
        $this->db->execute();
        file_put_contents($this->fileUrl, "");
    }

}