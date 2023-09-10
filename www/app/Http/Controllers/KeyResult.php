<?php

namespace App\Http\Controllers;

use App\Entity\KeyResultEntity;
use App\Model\KeyResultModel;
use App\Model\ObjectiveModel;
use App\Util\Message;

class KeyResult extends Controller
{
    /** @var KeyResultModel */
    private $keyResultModel;

    /** @var ObjectiveModel */
    private $objectiveModel;

    public function __construct()
    {
        $this->setKeyResultModel(new KeyResultModel());
        $this->setObjectiveModel(new ObjectiveModel());
    }

    public function list(int $id)
    {
        $keyResultModel = $this->getKeyResultModel();
        $objectiveModel = $this->getObjectiveModel();

        $keyResult = $keyResultModel->list($id);
        $objctive = $objectiveModel->findObjective($id);

        $data = [
          'title' => 'Resultados chaves',
          'keyResults' => $keyResult,
          'objective' => $objctive
        ];

        return $this->view('Key-result/index', $data);
    }

    public function newKeyResult(int $id)
    {
        $data = [
            'title' => 'Novo resultado chaves',
            'objective_id' => $id
        ];

        return $this->view('Key-result/newKeyResult', $data);
    }
    public function edit(int $id)
    {
        $keyResultModel = $this->getKeyResultModel();
        $keyResult = $keyResultModel->findKeyResult($id);

        $data = [
            'title' => 'Editando resultado chaves',
            'keyResult' => $keyResult
        ];

        return $this->view('Key-result/editKeyResult', $data);
    }

    public function save()
    {
        $isPost = $_SERVER['REQUEST_METHOD'];

        if ($isPost !== 'POST') {
            $this->sendJson([
                'result' => 'error',
                'message' => Message::NOT_A_POST
            ]);
        }

        $keyResultEntity = new KeyResultEntity();
        $keyResultEntity->setDescription($_POST['description']);
        $keyResultEntity->setType($_POST['type']);
        $keyResultEntity->setTitle($_POST['title']);
        $keyResultEntity->setObjectiveId($_POST['objective_id']);

        $keyResultModel = $this->getKeyResultModel();
        $keyResultId = $keyResultModel->save($keyResultEntity);

        if (!$keyResultId) {
            $this->sendJson([
                'result' => 'error',
                'message' => Message::NOT_SAVE
            ]);
        }

        $this->sendJson([
            'result' => 'success',
            'objectiveId' => $keyResultEntity->getObjectiveId()
        ]);
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

        $keyResultEntity = new KeyResultEntity();
        $keyResultEntity->setId($_POST['id']);
        $keyResultEntity->setDescription($_POST['description']);
        $keyResultEntity->setType($_POST['type']);
        $keyResultEntity->setTitle($_POST['title']);
        $keyResultEntity->setObjectiveId($_POST['objective_id']);

        $keyResultModel = $this->getKeyResultModel();
        $update = $keyResultModel->update($keyResultEntity);

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
        $keyResultModel = $this->getKeyResultModel();
        $keyResult = $keyResultModel->findKeyResult($id);

        $data = [
            'title' => 'Removendo resultado chave',
            'keyResult' => $keyResult
        ];

        return $this->view('Key-result/removeKeyResult', $data);
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

        $keyResultEntity = new KeyResultEntity();
        $keyResultEntity->setId($_POST['id']);

        $keyResultModel = $this->getKeyResultModel();
        $keyResult = $keyResultModel->findKeyResult($_POST['id']);
        $remove = $keyResultModel->delete($keyResultEntity);

        if (!$remove) {
            $this->sendJson([
                'result' => 'error',
                'message' => Message::NOT_DELETED
            ]);
        }

        $this->sendJson([
            'result' => 'success',
            'objectiveId' => $keyResult[0]['objective_id'],
            'message' => Message::SAVED_SUCCESSFULLY
        ]);
    }

    public function restoreKeyResult(int $id)
    {
        $keyResultModel = $this->getKeyResultModel();
        $keyResult = $keyResultModel->findKeyResult($id);

        $data = [
            'title' => 'Restaurando resultado chave',
            'keyResult' => $keyResult
        ];

        return $this->view('Key-result/restoreKeyResult', $data);
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

        $keyResultEntity = new KeyResultEntity();
        $keyResultEntity->setId($_POST['id']);

        $keyResultModel = $this->getKeyResultModel();
        $keyResult = $keyResultModel->findKeyResult($_POST['id']);
        $restore = $keyResultModel->restore($keyResultEntity);

        if (!$restore) {
            $this->sendJson([
                'result' => 'error',
                'message' => Message::NOT_DELETED
            ]);
        }

        $this->sendJson([
            'result' => 'success',
            'objectiveId' => $keyResult[0]['objective_id'],
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
     * @return mixed
     */
    public function getObjectiveModel()
    {
        return $this->objectiveModel;
    }

    /**
     * @param mixed $objectiveModel
     */
    public function setObjectiveModel($objectiveModel): void
    {
        $this->objectiveModel = $objectiveModel;
    }
}