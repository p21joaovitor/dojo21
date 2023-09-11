<?php

namespace App\Http\Controllers;

use App\Model\UserModel;
use App\Util\Message;
use App\Util\Validator;

/**
 * @author João Vitor Botelho
 * Classe responsavel pelo fluxo do usuario desde sua criação até o gerenciamento de sua sessão no sistema
 */
class User extends Controller
{
    /**
     * Função responsavel por exibir a view de registro de um novo usuario
     * @return null
     */
    public function register()
    {
        $data = [
            'title' => 'Registrar'
        ];
        return $this->view('Login/register', $data);
    }

    /**
     * Função responsavel por salvar os dados de um novo usuario
     * @return void
     */
    public function save(){
        $isPost = $_SERVER['REQUEST_METHOD'];
        $validator = new Validator();

        if ($isPost !== 'POST') {
            $this->sendJson([
                'result' => 'error',
                'message' => Message::NOT_A_POST
            ]);
        }
        $this->validatorFormUser($_POST, true);

        $user = new \App\Entity\User();
        $user->setName($_POST['name']);
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);

        if(!$validator->checkPassword($user->getPassword(), $_POST['confirmPassword'])){
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

    /**
     * Função responsavel por realizar o login do usuario
     * @return void
     */
    public function login()
    {
        $isPost = $_SERVER['REQUEST_METHOD'];

        if ($isPost !== 'POST') {
            $this->sendJson([
                'result' => 'error',
                'message' => Message::NOT_A_POST
            ]);
        }

        $this->validatorFormUser($_POST);

        $user = new \App\Entity\User();
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);

        $userModel = new UserModel();
        $auth = $userModel->authenticate($user);

        if ($auth['error']) {
            $this->sendJson([
                'result' => 'error',
                'message' => $auth['message']
            ]);
        }

        $this->sendJson([
            'result' => 'success',
        ]);
    }

    /**
     * Função responsavel por dar logout do usuario do sistema
     * @return void
     */
    public function logout()
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();

            header('Location: /');
            exit;
        }
    }

    /**
     * Função responsavel por validar os dados do formulario de usuarios
     * @param $data
     * @param $method
     * @return void
     */
    private function validatorFormUser($data, $method = null)
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