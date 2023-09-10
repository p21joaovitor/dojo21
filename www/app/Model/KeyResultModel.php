<?php

namespace App\Model;

use App\Entity\DatabaseConnection;
use App\Entity\KeyResultEntity;
use App\Entity\ObjectiveEntity;

class KeyResultModel extends Model
{
    public function save(KeyResultEntity $keyResultEntity){

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

    public function update(KeyResultEntity $keyResultEntity)
    {
        $statement = $this->getConn()->prepare("UPDATE key_result SET objective_id = :objective_id, title = :title, description = :description, `type` = :type, updated_at = NOW() WHERE id = :id");

        $statement->execute([
            ':objective_id' => $keyResultEntity->getObjectiveId(),
            ':title' =>  $keyResultEntity->getTitle(),
            ':description' => $keyResultEntity->getDescription(),
            ':type' => $keyResultEntity->getType(),
            ':id' => $keyResultEntity->getId()
        ]);

        if ($statement->rowCount()) {
            return true;
        }

        return false;
    }

    public function delete(KeyResultEntity $keyResultEntity)
    {
        $statement = $this->getConn()->prepare("UPDATE key_result SET deleted_at = NOW() WHERE id = :id");

        $statement->execute([
            ':id' => $keyResultEntity->getId()
        ]);

        if ($statement->rowCount()) {
            return true;
        }

        return false;
    }

    public function restore(KeyResultEntity $keyResultEntity)
    {
        $statement = $this->getConn()->prepare("UPDATE key_result SET deleted_at = null WHERE id = :id");

        $statement->execute([
            ':id' => $keyResultEntity->getId()
        ]);

        if ($statement->rowCount()) {
            return true;
        }

        return false;
    }

    public function list(int $objectiveId) {
        $statement = $this->getConn()->prepare("SELECT * FROM key_result WHERE key_result.objective_id = :objectiveId");
        $statement->execute([
            ':objectiveId' => $objectiveId
        ]);

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function findKeyResult($id) {
        $statement = $this->getConn()->prepare("SELECT * FROM key_result WHERE key_result.id = :id");
        $statement->execute([
            ':id' => $id
        ]);

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}