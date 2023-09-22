<?php

namespace App\Model;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Util\Message;

class AuthModel extends Model
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct()
    {
        $this->setUserRepository(new UserRepository());
    }

    /** Função responsavel por realizar a validação para o login do usuario
     * @param User $user
     * @return array
     */
    public function authenticate($user)
    {
        session_destroy();
        $password = md5($user->getPassword());

        $result = $this->getUserRepository()->getUserByEmail($user->email);

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

    /**
     * @return UserRepository
     */
    public function getUserRepository(): UserRepository
    {
        return $this->userRepository;
    }

    /**
     * @param UserRepository $userRepository
     */
    public function setUserRepository(UserRepository $userRepository): void
    {
        $this->userRepository = $userRepository;
    }

}