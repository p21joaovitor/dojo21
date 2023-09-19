<?php

namespace App\Repository;

use App\Entity\DataBase;
use PDO;

class Repository
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