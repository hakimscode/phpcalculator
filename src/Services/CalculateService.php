<?php
namespace Jakmall\Recruitment\Calculator\Services;

use Jakmall\Recruitment\Calculator\Services\StorageService;

class CalculateService extends StorageService {

    public function createHistory($command, $description, $result, $output) {
        $this->setCommand($command);
        $this->setDescription($description);
        $this->setResult($result);
        $this->setOutput($output);
        $this->saveHistory();
    }

    public function add($numbers) {
        $sumNumbers = 0;
        $out = "";
        for($i=0; $i<count($numbers); $i++){
            $sumNumbers += $numbers[$i];
            $out .= $i == count($numbers) - 1 ? 
                $numbers[$i] . ' = ' . $sumNumbers : 
                $numbers[$i] . ' + ';
        }

        $desc = explode(" = ", $out);

        $this->createHistory('Add', $desc[0], $sumNumbers, $out);

        return $out;
    }

    public function subtract($numbers) {
        $result = $numbers[0];
        $out = "";
        for($i=0; $i<count($numbers); $i++){
            $result -= $i != 0 ?
                $numbers[$i] :
                0;
            $out .= $i == count($numbers) - 1 ? 
                $numbers[$i] . ' = ' . $result : 
                $numbers[$i] . ' - ';
        }

        $desc = explode(" = ", $out);

        $this->createHistory('Subtract', $desc[0], $result, $out);

        return $out;
    }

    public function multiply($numbers) {
        $result = 1;
        $out = "";
        for($i=0; $i<count($numbers); $i++){
            $result *= $numbers[$i];
            $out .= $i == count($numbers) - 1 ? 
                $numbers[$i] . ' = ' . $result : 
                $numbers[$i] . ' * ';
        }

        $desc = explode(" = ", $out);

        $this->createHistory('Multiply', $desc[0], $result, $out);

        return $out;
    }

    public function divide($numbers) {
        $result = $numbers[0];
        $out = "";
        for($i=0; $i<count($numbers); $i++){
            $result /= $i != 0 ?
                $numbers[$i] :
                1;
            $out .= $i == count($numbers) - 1 ? 
                $numbers[$i] . ' = ' . $result : 
                $numbers[$i] . ' / ';
        }

        $desc = explode(" = ", $out);

        $this->createHistory('Divide', $desc[0], $result, $out);

        return $out;
    }

    public function pow($base, $exp) {
        $result = pow($base, $exp);
        $out = $base . ' ^ ' . $exp . ' = ' . $result;

        $desc = explode(" = ", $out);

        $this->createHistory('Pow', $desc[0], $result, $out);

        return $out;
    }

}