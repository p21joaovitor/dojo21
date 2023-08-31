<?php

namespace App\Model;

use App\Entity\DatabaseConnection;
use App\Entity\ObjectiveEntity;

class ObjectiveModel
{
    public function save(ObjectiveEntity $objective){
        $pdoConnection = (new DatabaseConnection())->getConnection();

        /** @var $pdoConnection PDO */
        $statement = $pdoConnection->prepare("INSERT INTO objective (user_id, title, description) values (:user_id, :title, :description)");
        $statement->execute([
            ':user_id' => $objective->getUser(),
            ':title' =>  $objective->getTitle(),
            ':description' => $objective->getDescription(),
        ]);
    }

    public function list(int $userId) {
        $pdoConnection = (new DatabaseConnection())->getConnection();
        $statement = $pdoConnection->prepare("SELECT * FROM objective WHERE objective.user_id = :user_id");
        $statement->bindParam(':user_id', $userId);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}