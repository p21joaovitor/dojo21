<?php

namespace App\Http\Controller;

use App\Entity\ObjectiveEntity;
use App\Model\ObjectiveModel;
use App\Model\UserModel;
use App\Http\Controller\Controller;

class Objective extends Controller
{
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