<?php

namespace App\Http\Controllers;

use App\Model\UserModel;
use App\Http\Controllers\Controller;

class User extends Controller
{
    public function save(){
        $isPost = $_SERVER['REQUEST_METHOD'];

        if ($isPost === 'POST') {
            $name = $_POST['name'] ?: '';
            $email = $_POST['email'] ?: '';
            $password = $_POST['password'] ?: '';

            if(empty($name)) {
                $this->sendJson([
                    'result' => 'error',
                    'message' => 'Invalid name'
                ]);
            }

            (new UserModel())->save($name, $email, $password);

            $this->sendJson([
                'result' => 'success',
            ]);
        }
    }

    public function login()
    {
        $isPost = $_SERVER['REQUEST_METHOD'];

        if ($isPost === 'POST') {
            $email = $_POST['email'] ?: '';
            $password = $_POST['password'] ?: '';

            if (!$email || !$password) {
                $this->sendJson([
                    'result' => 'error',
                    'message' => 'Usuário ou senha inválidos'
                ]);
            }
        }

        $user = new \App\Entity\User();
        $user->email = $email;
        $user->password = $password;

        $userModel = new UserModel();
        if ($userModel->authenticate($user));
    }
}