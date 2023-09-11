<?php

namespace App\Entity;

use PDO;
use PDOException;

/**
 * @author João Vitor Botelho
 * Classe responsavel por conectar ao banco de dados
 */
class DataBase
{
    /** @var PDO|null $connection */
    public ?PDO $connection = null;

    /**
     * Constructor
     */
    public function __construct()
    {
        $host = 'mysql';
        $database = 'okr';
        $user = 'root';
        $password = 'root';

        $dsn = "mysql:host=$host;dbname=$database;charset=utf8";

        try {
            $pdoConnection = new PDO($dsn, $user, $password);
            $pdoConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdoConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            $this->connection = $pdoConnection;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @return DataBase|PDO|null
     */
    public function getConnection(): DataBase|PDO|null
    {
        if (!$this->connection) {
            $this->connection = new self();
        }

        return $this->connection;
    }
}