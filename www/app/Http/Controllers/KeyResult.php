<?php

namespace App\Http\Controllers;

use App\Entity\KeyResultEntity;
use App\Model\KeyResultModel;
use App\Util\Message;
use App\Util\Validator;

/**
 * @author João Vitor Botelho
 * Classe responsavel pelo fluxo do key result do usuario
 */
class KeyResult extends Controller
{
    /** @var KeyResultModel */
    private $keyResultModel;

    /** @var Validator */
    private $validator;

    public function __construct()
    {
        $this->setKeyResultModel(new KeyResultModel());
        $this->setValidator(new Validator());
    }

    /**
     * Função responsavel por salvar os dados de um novo key result
     * @return void
     */
    public function save()
    {
        $isPost = $_SERVER['REQUEST_METHOD'];

        if ($isPost !== 'POST') {
            $this->sendJson([
                'result' => 'error',
                'message' => Message::NOT_A_POST
            ]);
        }

        $validator = $this->getValidator()->validatorFormKeyResult($_POST);

        if ($validator['result'] === 'error') {
            $this->sendJson([
                'result' => $validator['result'],
                'message' => $validator['message']
            ]);
        }

        $save = $this->getKeyResultModel()->save($validator['keyResult']);

        if ($save['error']) {
            $this->sendJson([
                'result' => 'error',
                'message' => $save['message']
            ]);
        }

        $this->sendJson([
            'result' => 'success',
            'objectiveId' => $save['objective']
        ]);
    }

    /**
     * Função responsavel por salvar os dados editados
     * @return void
     */
    public function update()
    {
        $isPost = $_SERVER['REQUEST_METHOD'];

        if ($isPost !== 'POST') {
            $this->sendJson([
                'result' => 'error',
                'message' => Message::NOT_A_POST
            ]);
        }

        $validator = $this->getValidator()->validatorFormKeyResult($_POST, true);

        if ($validator['result'] === 'error') {
            $this->sendJson([
                'result' => $validator['result'],
                'message' => $validator['message']
            ]);
        }

        $update = $this->getKeyResultModel()->update($validator['keyResult']);

        if ($update['error']) {
            $this->sendJson([
                'result' => 'error',
                'message' => $update['message']
            ]);
        }

        $this->sendJson([
            'result' => 'success',
            'message' => Message::SAVED_SUCCESSFULLY
        ]);
    }

    /**
     * Função que salva a remoção do key result
     * @return void
     */
    public function delete()
    {
        $isPost = $_SERVER['REQUEST_METHOD'];

        if ($isPost !== 'POST') {
            $this->sendJson([
                'result' => 'error',
                'message' => Message::NOT_A_POST
            ]);
        }

        $remove = $this->getKeyResultModel()->delete($_POST);

        if ($remove['error']) {
            $this->sendJson([
                'result' => 'error',
                'message' => Message::REGISTER_NOT_FOUND
            ]);
        }

        $this->sendJson([
            'result' => 'success',
            'objectiveId' => $remove['objective_id'],
            'message' => Message::SAVED_SUCCESSFULLY
        ]);
    }

    /**
     * Função para salvar a restauração do key result
     * @return void
     */
    public function restore()
    {
        $isPost = $_SERVER['REQUEST_METHOD'];

        if ($isPost !== 'POST') {
            $this->sendJson([
                'result' => 'error',
                'message' => Message::NOT_A_POST
            ]);
        }

        $restore = $this->getKeyResultModel()->restore($_POST);

        if ($restore['error']) {
            $this->sendJson([
                'result' => 'error',
                'message' => Message::REGISTER_NOT_FOUND
            ]);
        }

        $this->sendJson([
            'result' => 'success',
            'objectiveId' => $restore['objective_id'],
            'message' => Message::SAVED_SUCCESSFULLY
        ]);
    }
    /**
     * @return mixed
     */
    public function getKeyResultModel()
    {
        return $this->keyResultModel;
    }

    /**
     * @param mixed $keyResultModel
     */
    public function setKeyResultModel($keyResultModel): void
    {
        $this->keyResultModel = $keyResultModel;
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