<?php

namespace App\Util;

use App\Entity\User;

/**
 * @author João Vitor Botelho
 * Classe responsavel por validações genericas
 */
class Validator
{
    public function checkPassword($password, $checkPassword)
    {
        if ($password !== $checkPassword) {
            return false;
        }

        return true;
    }

    public function userForm($data, $method = null)
    {
        if (empty($data['name']) && $method) {
            return [
                'result' => 'error',
                'message' => Message::NAME_REQUIRED
            ];
        }

        if (empty($data['email'])) {
            return [
                'result' => 'error',
                'message' => Message::EMAIL_REQUIRED
            ];
        }

        if (empty($data['password'])) {
            return [
                'result' => 'error',
                'message' => Message::PASSWORD_REQUIRED
            ];
        }
        $user = new User();
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);

        return [
            'result' => 'success',
            'user' => $user
        ];
    }
}