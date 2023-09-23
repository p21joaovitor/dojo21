<?php

namespace App\Model;

use App\Entity\DatabaseConnection;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Util\Message;
use App\Util\Validator;
use PDO;

class UserModel extends Model
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct()
    {
        $this->setUserRepository(new UserRepository());
    }

    /**
     * Função responsavel por salvar os dados de um novo usuario
     * @param User $user
     * @return array
     */
    public function save(User $user)
    {
        $result = $this->getUserRepository()->getUserByEmail($user->getEmail());

        if ($result) {
            return [
                'error' => true,
                'message' => Message::EMAIL_ALREADY_REGISTERED
            ];
        }

        $register = $this->getUserRepository()->save($user);

        if (!$register) {
            return [
                'error' => true,
                'message' => Message::NOT_SAVE
            ];
        }

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