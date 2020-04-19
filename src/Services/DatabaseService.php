<?php
namespace Jakmall\Recruitment\Calculator\Services;

use \PDO;

class DatabaseService {

    private $host = '127.0.0.1:3306';
    private $user = 'root';
    private $pass = '';
    private $dbName = 'phpcalculator';
    private $dbConn;
    private $statement;
    private $error;

    public function __construct() {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;

        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        
        try {
            $this->dbConn = new PDO($dsn, $this->user, $this->pass, $options);
        } catch(PDOException $e){
            $this->error = $e->getMessage();
        }
    }

    public function resultSet() {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function query($query) {
        $this->statement = $this->dbConn->prepare($query);
    }

    public function execute() {
        return $this->statement->execute();
    }

}