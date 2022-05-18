<?php
namespace App\Database;
/**
 * survewon Class 'SUWON' for db of 'phq_db' which will store data during data collection
 *
 */
class SUWONDB {
    // DB params
    private $servername = "localhost"; 
    private $username   = "root";
    private $password   = "";
    private $dbname     = "phq_db";
    protected $conn;

    //get connected
    public function connect() {      
        try {
            $this->conn = new \PDO("mysql:host=" . $this->servername . ";dbname=" .$this->dbname, $this->username, $this->password);
            $this->conn->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );
            // echo "Connected successfully";
        } catch ( \PDOException $e ) {
            echo "Connection error: " . $e->getMessage();
        }
        return $this->conn;
    }
}