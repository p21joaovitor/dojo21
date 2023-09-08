<?php

namespace App\Http\Controllers;

use App\Entity\ObjectiveEntity;
use App\Model\ObjectiveModel;
use App\Http\Controllers\Controller;

class Objective extends Controller
{
    public function index()
    {
        $objectiveModel = new ObjectiveModel();
        $myObjective = $objectiveModel->list($_SESSION['user_id']);

        return $this->view('Objective/index', $myObjective);
    }

    public function newObjective()
    {
        return $this->view('Objective/new-objective');
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
}