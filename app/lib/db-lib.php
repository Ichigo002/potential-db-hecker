<?php

class Database {
    /*private $hostname = 'localhost';
    private $password = '';
    private $username = 'root';
    private $dbname   = 'work_time';*/

    //ERRORS NUMBER
    // 0 = Success connect!
    // -3 = Fail to connect. Bad data or db doesn't exist

    private $hostname = 'localhost';
    private $password = '';
    private $username = 'root';
    private $dbname   = 'work_time';

    private $conn;
    private $result = null;

    public function __construct($host=null, $password=null, $username=null, $dbname=null) {
        if($host != null) {
            return $this->change_db($host, $password, $username, $dbname);
        } else {
            return $this->connectdb();
        }
        
    }

    // Change current connected database
    public function change_db($host, $password, $username, $dbname) {
        $this->hostname = $host;
        $this->password = $password;
        $this->username = $username;
        $this->dbname = $dbname;

        return $this->connectdb();
    }

    // Call sql query to db
    public function query($sql) {
        $this->result = $this->conn->query($sql);
        return $this->result;
    }


    // Check has result got any data
    public function check_result()
    {
       return $this->result->num_rows > 0;
    }

    // Get signle row. The best solution is with 
    // while($row = $db->get_single_row()) { #code... }
    public function get_single_row() {
        return $this->result->fetch_assoc();
    }

    // count amount of records at table for specific condition.
    public function count_table($name_of_table, $condition_sql="") {
        //$sql = "SELECT COUNT(*) FROM `$name_of_table` WHERE $condition_sql";
        $sql = "SELECT COUNT(*) FROM `$name_of_table` WHERE ".$condition_sql.";";
        return $this->query($sql)->fetch_column();
    }

    // Before use value to sql, convert teh value into the safety string to avoid sql injections
    public function safety_str($str) {
        return $this->conn->real_escape_string($str);
    }

    public function getConn() {
        return $this->conn;
    }

    protected function connectdb() {
        try {
            $this->conn = new mysqli($this->hostname, $this->username, $this->password, $this->dbname);
        } catch (\Throwable $th) {
            return -3;
        }

        return 0;
    }
}

?>