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
     * @var Validator
     */
    private $validator;

    /**
     * @var UserModel
     */
    private $userModel;

    public function __construct()
    {
        $this->setUserModel(new UserModel());
        $this->setValidator(new Validator());
    }

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

        if ($isPost !== 'POST') {
            $this->sendJson([
                'result' => 'error',
                'message' => Message::NOT_A_POST
            ]);
        }

        $validator = $this->getValidator()->userForm($_POST, true);

        if ($validator['result'] === 'error') {
            $this->sendJson([
                'result' => $validator['result'],
                'message' => $validator['message']
            ]);
        }

        $register = $this->getUserModel()->save($validator['user'], $_POST['confirmPassword']);

        if ($register['error']) {
            $this->sendJson([
                'result' => 'error',
                'message' => $register['message']
            ]);
        }

        $this->sendJson([
            'result' => 'success',
        ]);
    }

    /**
     * @return Validator
     */
    public function getValidator(): Validator
    {
        return $this->validator;
    }

    /**
     * @param Validator $validator
     */
    public function setValidator(Validator $validator): void
    {
        $this->validator = $validator;
    }

    /**
     * @return UserModel
     */
    public function getUserModel(): UserModel
    {
        return $this->userModel;
    }

    /**
     * @param UserModel $userModel
     */
    public function setUserModel(UserModel $userModel): void
    {
        $this->userModel = $userModel;
    }
}