<?php

namespace App\Http\Controllers;

use App\Entity\ObjectiveEntity;
use App\Model\ObjectiveModel;
use App\Util\Message;

class Objective extends Controller
{
    /** @var ObjectiveModel */
    private $objectiveModel;

    public function __construct()
    {
        $this->setObjectiveModel(new ObjectiveModel());
    }

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

    public function newObjective()
    {
        $data = [
            'title' => 'Novo Objetivo'
        ];
        return $this->view('Objective/newObjective', $data);
    }

    public function save(){
        $isPost = $_SERVER['REQUEST_METHOD'];

        if ($isPost === 'POST') {
            $title = $_POST['title'] ?: '';
            $description = $_POST['description'] ?: '';

            $objective = new ObjectiveEntity();
            $objective->setUser($_SESSION['user_id']);
            $objective->setTitle($title);
            $objective->setDescription($description);

            (new ObjectiveModel())->save($objective);

            $this->sendJson([
                'result' => 'success',
            ]);
        }
    }

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

    public function update()
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
}