<?php

namespace App\Http\Controllers;

use App\Entity\ObjectiveEntity;
use App\Model\ObjectiveModel;
use App\Util\Message;

/**
 * @author João Vitor Botelho
 * Classe responsavel pelo fluxo do objective do usuario
 */
class Objective extends Controller
{
    /** @var ObjectiveModel */
    private $objectiveModel;

    public function __construct()
    {
        $this->setObjectiveModel(new ObjectiveModel());
    }

    /**
     * Função principal do controller que faz a exibição da view de listagem
     * @return null
     */
    public function index()
    {
        $objectiveModel = new ObjectiveModel();
        $myObjective = $objectiveModel->list($_SESSION['user_id']);

        $data = [
          'title' => 'Meus Objetivos',
          'objective' => $myObjective
        ];
        return $this->view('Objective/index', $data);
    }

    /**
     * Função para a exibição da view de novo objective
     * @return null
     */
    public function newObjective()
    {
        $data = [
            'title' => 'Novo Objetivo'
        ];
        return $this->view('Objective/newObjective', $data);
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

        $this->validatorFormObjective($_POST);

        $objective = new ObjectiveEntity();
        $objective->setUser($_SESSION['user_id']);
        $objective->setTitle($_POST['title']);
        $objective->setDescription($_POST['description']);

        (new ObjectiveModel())->save($objective);

        $this->sendJson([
            'result' => 'success',
        ]);
    }

    /**
     * Função responsavel por exibir a view de edição do objective
     * @param int $id
     * @return null
     */
    public function edit(int $id)
    {
        $objectivetModel = $this->getObjectiveModel();
        $objective = $objectivetModel->findObjective($id);

        $data = [
            'title' => 'Editando objetivo',
            'objective' => $objective
        ];

        return $this->view('Objective/editObjective', $data);
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

        $this->validatorFormObjective($_POST);

        $objectiveEntity = new ObjectiveEntity();
        $objectiveEntity->setId($_POST['id']);
        $objectiveEntity->setDescription($_POST['description']);
        $objectiveEntity->setTitle($_POST['title']);

        $objectiveModel = $this->getObjectiveModel();
        $update = $objectiveModel->update($objectiveEntity);

        if (!$update) {
            $this->sendJson([
                'result' => 'error',
                'message' => Message::NOT_SAVE
            ]);
        }

        $this->sendJson([
            'result' => 'success',
            'message' => Message::SAVED_SUCCESSFULLY
        ]);
    }

    /**
     * Função responsavel por exibir a view de finalização do objective
     * @param int $id
     * @return null
     */
    public function finishObjective(int $id)
    {
        $objectiveModel = $this->getObjectiveModel();
        $objective = $objectiveModel->findObjective($id);

        $data = [
            'title' => 'Finalizando o objetivo',
            'objective' => $objective
        ];

        return $this->view('Objective/finish', $data);
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

        $objectiveEntity = new ObjectiveEntity();
        $objectiveEntity->setId($_POST['id']);
        $objectiveEntity->setStatus(ObjectiveEntity::FINALIZADO);

        $objectiveModel = $this->getObjectiveModel();
        $update = $objectiveModel->finish($objectiveEntity);

        if (!$update) {
            $this->sendJson([
                'result' => 'error',
                'message' => Message::NOT_SAVE
            ]);
        }

        $this->sendJson([
            'result' => 'success',
            'message' => Message::SAVED_SUCCESSFULLY
        ]);
    }

    /**
     * Função responsavel por exibir a view de remoção do objective
     * @param int $id
     * @return null
     */
    public function remove(int $id)
    {
        $objectiveModel = $this->getObjectiveModel();
        $objective = $objectiveModel->findObjective($id);

        $data = [
            'title' => 'Removendo o objetivo',
            'objective' => $objective
        ];

        return $this->view('Objective/removeObjective', $data);
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

        $objectivetEntity = new ObjectiveEntity();
        $objectivetEntity->setId($_POST['id']);

        $objectiveModel = $this->getObjectiveModel();
        $remove = $objectiveModel->delete($objectivetEntity);

        if (!$remove) {
            $this->sendJson([
                'result' => 'error',
                'message' => Message::NOT_DELETED
            ]);
        }

        $this->sendJson([
            'result' => 'success',
            'message' => Message::SAVED_SUCCESSFULLY
        ]);
    }

    /**
     * Função responsavel por exibir a view de restauração do objective
     * @param int $id
     * @return null
     */
    public function restoreObjective(int $id)
    {
        $objectiveModel = $this->getObjectiveModel();
        $objective = $objectiveModel->findObjective($id);

        $data = [
            'title' => 'Restaurando objetivo',
            'objective' => $objective
        ];

        return $this->view('Objective/restoreObjective', $data);
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

        $objectivetEntity = new ObjectiveEntity();
        $objectivetEntity->setId($_POST['id']);

        $objectiveModel = $this->getObjectiveModel();
        $restore = $objectiveModel->restore($objectivetEntity);

        if (!$restore) {
            $this->sendJson([
                'result' => 'error',
                'message' => Message::NOT_DELETED
            ]);
        }

        $this->sendJson([
            'result' => 'success',
            'message' => Message::SAVED_SUCCESSFULLY
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

    private function validatorFormObjective($data, $method = null)
    {
        if (empty($data['title'])) {
            $this->sendJson([
                'result' => 'error',
                'message' => Message::TITLE_REQUIRED
            ]);
        }

        if (empty($data['description'])) {
            $this->sendJson([
                'result' => 'error',
                'message' => Message::DESCRIPTION_REQUIRED
            ]);
        }
    }
}