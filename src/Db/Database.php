<?php

namespace SMS\Db;

use PDO;

class Database {

    private $host;
    private $username;
    private $password; 
    private $port;
    private $dbName;

    private $conn;

    public function __construct($host, $username, $password, $port, $dbName) 
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->port = $port;
        $this->dbName = $dbName;
    }

    public function connect()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbName;port=$this->port", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            // echo "Connection failed: " . $e->getMessage();
        }
    }

    public function fetch($sql) 
    {
        $sth = $this->conn->query($sql, PDO::FETCH_OBJ);
        return $sth->fetchAll();
    }

    public function insert($sql, $params)
    {
        $stmnt = $this->conn->prepare($sql)->execute($params);
        return $this->conn->lastInsertId();
    }

}