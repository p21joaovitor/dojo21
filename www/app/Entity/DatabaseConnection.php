<?php

namespace App\Entity;

use PDO;
use PDOException;

class DatabaseConnection
{
    public $connection;
    
    public function __construct()
    {
        $host = 'mysql';
        $database = 'okr';
        $user = 'root';
        $password = 'root';

        $dsn = "mysql:host=$host;dbname=$database";

        try {
            $pdoConnection = new PDO($dsn, $user, $password);
            $pdoConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdoConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this->connection = $pdoConnection;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    public function getConnection()
    {
        return $this->connection;
    }
}