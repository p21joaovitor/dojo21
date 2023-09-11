<?php

namespace App\Model;

use App\Entity\DataBase;
use PDO;

/**
 * João Vitor Botelho
 * Classe generica de banco de dados
 */
class Model
{
    private PDO $conn;

    /**
     * Constructor to define conn content
     */
    public function __construct()
    {
        $this->conn = (new DataBase())->getConnection();
    }

    /**
     * @return PDO
     */
    public function getConn(): PDO
    {
        return $this->conn;
    }
}