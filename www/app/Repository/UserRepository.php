<?php

namespace App\Repository;

use App\Entity\User;

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

    /**
     * @param User $user
     * @return boolean
     */
    public function save(User $user)
    {
        $passwordEncryt = md5($user->getPassword());

        /** @var $pdoConnection PDO */
        $statement = $this->getConn()->prepare("INSERT INTO user (name, email, password) values (:name, :email, :password)");
        $execute = $statement->execute([
            ':name' => $user->getName(),
            ':email' =>  $user->getEmail(),
            ':password' => $passwordEncryt
        ]);

        if (!$execute) {
            return false;
        }

        return true;
    }
}