<?php

namespace App\Model;

use App\Entity\DatabaseConnection;
use App\Entity\User;
use App\Util\Message;
use PDO;

class UserModel extends Model
{
    public function save(User $user){
        $passwordEncryt = md5($user->password);

        /** @var $pdoConnection PDO */
        $statement = $this->getConn()->prepare("INSERT INTO user (name, email, password) values (:name, :email, :password)");
        $statement->bindParam(':name', $user->name);
        $statement->bindParam(':email', $user->email);
        $statement->bindParam(':password', $passwordEncryt);
        $statement->execute();
    }

    public function authenticate(User $user): array|bool
    {
        session_destroy();
        $password = md5($user->password);

        $statement = $this->getConn()->prepare("SELECT * FROM user WHERE email = :email");
        $statement->bindParam(':email', $user->email);
        $statement->execute();

        $result = $statement->fetch(\PDO::FETCH_ASSOC);

        if (!$result) {
            return [
                'error' => true,
                'message' => Message::REGISTER_NOT_FOUND
            ];
        }

        if ($result['password'] != $password) {
            return [
                'error' => true,
                'message' => Message::INCORRECT_PASSWORD
            ];
        }

        session_start();

        $_SESSION['user_id'] = $result['id'];

        return [
            'error' => false
        ];
    }
}