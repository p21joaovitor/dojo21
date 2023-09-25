<?php

namespace App\Http\Controllers;

use App\Model\ObjectiveModel;
use App\Util\Message;
use App\Util\Validator;

/**
 * @author João Vitor Botelho
 * Classe responsavel pelo fluxo do objective do usuario
 */
class Objective extends Controller
{
    /** @var ObjectiveModel */
    private $objectiveModel;

    /**
     * @var Validator
     */
    private $validator;

    public function __construct()
    {
        $this->setObjectiveModel(new ObjectiveModel());
        $this->setValidator(new Validator());
    }

    /**
     * Função responsavel por salvar os dados de um novo objective
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

        $validator = $this->getValidator()->validatorFormObjective($_POST);

        if ($validator['result'] === 'error') {
            $this->sendJson([
                'result' => $validator['result'],
                'message' => $validator['message']
            ]);
        }

        $register = $this->getObjectiveModel()->save($validator['objective']);

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
     * Função para salvar os dados da edição
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

        $validator = $this->getValidator()->validatorFormObjective($_POST);

        if ($validator['result'] === 'error') {
            $this->sendJson([
                'result' => $validator['result'],
                'message' => $validator['message']
            ]);
        }

        $update = $this->getObjectiveModel()->update($validator['objective']);

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
     * Função responsavel por salvar os dados de finalização
     * @return void
     */
    public function finish()
    {
        $isPost = $_SERVER['REQUEST_METHOD'];

        if ($isPost !== 'POST') {
            $this->sendJson([
                'result' => 'error',
                'message' => Message::NOT_A_POST
            ]);
        }

        $finish = $this->getObjectiveModel()->finish($_POST);

        if ($finish['error']) {
            $this->sendJson([
                'result' => 'error',
                'message' => $finish['message']
            ]);
        }

        $this->sendJson([
            'result' => 'success'
        ]);
    }

    /**
     * Função responsavel por salvar os dados da remoção
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

        $delete = $this->getObjectiveModel()->delete($_POST);

        if ($delete['error']) {
            $this->sendJson([
                'result' => 'error',
                'message' => $delete['message']
            ]);
        }

        $this->sendJson([
            'result' => 'success'
        ]);
    }

    /**
     * Função responsavel por salvar os dados de restauração
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

        $restore = $this->getObjectiveModel()->restore($_POST);

        if ($restore['error']) {
            $this->sendJson([
                'result' => 'error',
                'message' => $restore['message']
            ]);
        }

        $this->sendJson([
            'result' => 'success'
        ]);
    }

    /**
     * @return ObjectiveModel
     */
    public function getObjectiveModel(): ObjectiveModel
    {
        return $this->objectiveModel;
    }

    /**
     * @param ObjectiveModel $objectiveModel
     */
    public function setObjectiveModel(ObjectiveModel $objectiveModel): void
    {
        $this->objectiveModel = $objectiveModel;
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