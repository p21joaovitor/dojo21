<?php

namespace App\Model;

use App\Entity\DatabaseConnection;
use App\Entity\User;
use App\Util\Message;
use PDO;

class UserModel extends Model
{
    /**
     * Função responsavel por salvar os dados de um novo usuario
     * @param User $user
     * @return void
     */
    public function save(User $user){
        $passwordEncryt = md5($user->getPassword());

        /** @var $pdoConnection PDO */
        $statement = $this->getConn()->prepare("INSERT INTO user (name, email, password) values (:name, :email, :password)");
        $statement->execute([
            ':name' => $user->getName(),
            ':email' =>  $user->getEmail(),
            ':password' => $passwordEncryt
        ]);
    }

    /**
     * Função responsavel por realizar a validação para o login do usuario
     * @param User $user
     * @return array|bool
     */
    public function authenticate(User $user): array|bool
    {
        session_destroy();
        $password = md5($user->getPassword());



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