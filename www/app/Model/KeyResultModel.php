<?php

namespace App\Model;

use App\Entity\DatabaseConnection;
use App\Entity\KeyResultEntity;
use App\Entity\ObjectiveEntity;

class KeyResultModel
{
    public function save(KeyResultEntity $keyResultEntity){
        $pdoConnection = (new DatabaseConnection())->getConnection();

        /** @var $pdoConnection PDO */
        $statement = $pdoConnection->prepare("INSERT INTO key_result (objective_id, title, description, `type`) VALUES (:objective_id, :title, :description, :type)");
        $statement->execute([
            ':objective_id' => $keyResultEntity->getObjectiveId(),
            ':title' =>  $keyResultEntity->getTitle(),
            ':description' => $keyResultEntity->getDescription(),
            ':type' => $keyResultEntity->getType()
        ]);
    }

    public function list(int $objectiveId) {
        $pdoConnection = (new DatabaseConnection())->getConnection();
        $statement = $pdoConnection->prepare("SELECT * FROM key_result WHERE key_result.objective_id = :objectiveId");
        $statement->bindParam(':objectiveId', $objectiveId);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

}