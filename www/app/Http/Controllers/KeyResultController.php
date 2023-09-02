<?php

namespace App\Http\Controllers;

use App\Entity\KeyResultEntity;
use App\Model\KeyResultModel;

class KeyResultController extends Controller
{
    public function index()
    {
        echo 'aki dentro do keyresults';
    }
    public function save()
    {
        $isPost = $_SERVER['REQUEST_METHOD'];

        if ($isPost === 'POST') {
            $title = $_POST['title'] ?: '';
            $objetiveId = $_POST['objective_id'] ?: '';
            $description = $_POST['description'] ?: '';
            $type = $_POST['type'] ?: '';

            $keyResultEntity = new KeyResultEntity();
            $keyResultEntity->setDescription($description);
            $keyResultEntity->setType($type);
            $keyResultEntity->setTitle($title);
            $keyResultEntity->setObjectiveId($objetiveId);

            (new KeyResultModel())->save($keyResultEntity);

            $this->sendJson([
                'result' => 'success',
            ]);
        }
    }
}