<?php

class Database{

    // Database Parameters
    private $host = "localhost";
    private $dbname = "product_review_api";
    private $dbusername = "root";
    private $dbpassword = "";
    private $conn;

    // Connect to the database
    public function connect(){

        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname, $this->dbusername, $this->dbpassword);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("SET CHARACTER SET utf8");
        } catch (PDOException $th) {
            //throw $th;
            echo "Connection Error: ". $th->getMessage();
        }

        return $this->conn;
    }
}