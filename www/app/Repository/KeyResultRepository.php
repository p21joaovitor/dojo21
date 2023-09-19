<?php

namespace App\Repository;

use App\Entity\KeyResultEntity;
use PDO;

class KeyResultRepository extends Repository
{
    public function save(KeyResultEntity $keyResultEntity)
    {
        /** @var $pdoConnection PDO */
        $statement = $this->getConn()->prepare("INSERT INTO key_result (objective_id, title, description, `type`) VALUES (:objective_id, :title, :description, :type)");
        $statement->execute([
            ':objective_id' => $keyResultEntity->getObjectiveId(),
            ':title' =>  $keyResultEntity->getTitle(),
            ':description' => $keyResultEntity->getDescription(),
            ':type' => $keyResultEntity->getType()
        ]);

        return $this->getConn()->lastInsertId();
    }
}