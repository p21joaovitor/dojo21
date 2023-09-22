<?php

namespace App\Repository;

class UserRepository extends Repository
{
    /**
     * Responsavel por pegar o usuario atravez do email passado
     * @param $email
     * @return mixed
     */
    public function getUserByEmail($email)
    {
        $statement = $this->getConn()->prepare("SELECT * FROM user WHERE email = :email");
        $statement->execute([
            ':email' =>  $email
        ]);

        return $statement->fetch(\PDO::FETCH_ASSOC);
    }
}