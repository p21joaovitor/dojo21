<?php

namespace App\Http\Controllers;

use App\Model\AuthModel;
use App\Util\Message;
use App\Util\Validator;

class Auth extends Controller
{
    /**
     * @var AuthModel
     */
    private $authModel;

    /**
     * @var Validator
     */
    private $validator;

    public function __construct()
    {
        $this->setAuthModel(new AuthModel());
        $this->setValidator(new Validator());
    }
    public function authenticate()
    {
        $isPost = $_SERVER['REQUEST_METHOD'];

        if ($isPost !== 'POST') {
            $this->sendJson([
                'result' => 'error',
                'message' => Message::NOT_A_POST
            ]);
        }

        $validator = $this->getValidator()->userForm($_POST);

        if ($validator['result'] === 'error') {
            $this->sendJson([
                'result' => $validator['result'],
                'message' => $validator['message']
            ]);
        }

        $auth = $this->getAuthModel()->authenticate($validator['user']);

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

    public function logout()
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();

            header('Location: /');
            exit;
        }
    }

    /**
     * @return AuthModel
     */
    public function getAuthModel()
    {
        return $this->authModel;
    }

    /**
     * @param $authModel
     * @return void
     */
    public function setAuthModel($authModel): void
    {
        $this->authModel = $authModel;
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
}