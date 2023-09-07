<?php

namespace App\Model;

use App\Entity\DatabaseConnection;
use App\Entity\User;

class UserModel
{
    public function save(User $user){
        $pdoConnection = (new DatabaseConnection())->getConnection();
        $passwordEncryt = md5($user->password);

        /** @var $pdoConnection PDO */
        $statement = $pdoConnection->prepare("INSERT INTO user (name, email, password) values (:name, :email, :password)");
        $statement->bindParam(':name', $user->name);
        $statement->bindParam(':email', $user->email);
        $statement->bindParam(':password', $passwordEncryt);
        $statement->execute();
    }

    public function authenticate(User $user): bool
    {
        session_destroy();
        $pdoConnection = (new DatabaseConnection())->getConnection();
        $password = md5($user->password);

        $statement = $pdoConnection->prepare("SELECT * FROM user WHERE email = :email");
        $statement->bindParam(':email', $user->email);

        if(!$statement->execute()) {
            session_destroy();
            return false;
        }

        $result = $statement->fetch(\PDO::FETCH_ASSOC);

        if ($result['password'] != $password) {
            return false;
        }

        session_start();

        $_SESSION['user_id'] = $result['id'];

        return true;
    }
}