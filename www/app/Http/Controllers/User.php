<?php

namespace App\Http\Controllers;

use App\Model\UserModel;
use App\Util\Message;
use App\Util\Validator;

class User extends Controller
{
    public function register()
    {
        return $this->view('Login/register');
    }

    public function save(){
        $isPost = $_SERVER['REQUEST_METHOD'];
        $validator = new Validator();

        if ($isPost !== 'POST') {
            $this->sendJson([
                'result' => 'error',
                'message' => Message::NOT_A_POST
            ]);
        }
        $this->validatorForm($_POST, true);

        $user = new \App\Entity\User();
        $user->name = $_POST['name'];
        $user->email = $_POST['email'];
        $user->password = $_POST['password'];

        if(!$validator->checkPassword($user->password, $_POST['confirmPassword'])){
            $this->sendJson([
                'result' => 'error',
                'message' => Message::DIFFERENT_PASSWORD
            ]);
        }

        (new UserModel())->save($user);

        $this->sendJson([
            'result' => 'success',
        ]);
    }

    public function login()
    {
        $isPost = $_SERVER['REQUEST_METHOD'];

        if ($isPost !== 'POST') {
            $this->sendJson([
                'result' => 'error',
                'message' => Message::NOT_A_POST
            ]);
        }

        $this->validatorForm($_POST);

        $user = new \App\Entity\User();
        $user->email = $_POST['email'];
        $user->password = $_POST['password'];

        $userModel = new UserModel();
        $userModel->authenticate($user);

        $this->sendJson([
            'result' => 'success',
        ]);
    }

    private function validatorForm($data, $method = null)
    {
        if (empty($data['name']) && $method) {
            $this->sendJson([
                'result' => 'error',
                'message' => Message::NAME_REQUIRED
            ]);
        }

        if (empty($data['email'])) {
            $this->sendJson([
                'result' => 'error',
                'message' => Message::EMAIL_REQUIRED
            ]);
        }

        if (empty($data['password'])) {
            $this->sendJson([
                'result' => 'error',
                'message' => Message::PASSWORD_REQUIRED
            ]);
        }
    }
}