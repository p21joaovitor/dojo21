<?php

namespace App\Repository;

use App\Entity\KeyResultEntity;
use PDO;

/**
 * @author Joao Vitor Botelho
 * Classe responsavel pelas querys
 */
class KeyResultRepository extends Repository
{
    /**
     * @param KeyResultEntity $keyResultEntity
     * @return bool
     */
    public function save(KeyResultEntity $keyResultEntity)
    {
        /** @var $pdoConnection PDO */
        $statement = $this->getConn()->prepare("INSERT INTO key_result (objective_id, title, description, `type`) VALUES (:objective_id, :title, :description, :type)");
        $execute = $statement->execute([
            ':objective_id' => $keyResultEntity->getObjectiveId(),
            ':title' =>  $keyResultEntity->getTitle(),
            ':description' => $keyResultEntity->getDescription(),
            ':type' => $keyResultEntity->getType()
        ]);

        if (!$execute) {
            return false;
        }

        return true;
    }

    /**
     * @param KeyResultEntity $keyResultEntity
     * @return bool
     */
    public function update(KeyResultEntity $keyResultEntity)
    {
        $statement = $this->getConn()->prepare("UPDATE key_result SET objective_id = :objective_id, title = :title, description = :description, `type` = :type, updated_at = NOW() WHERE id = :id");

        $execute = $statement->execute([
            ':objective_id' => $keyResultEntity->getObjectiveId(),
            ':title' =>  $keyResultEntity->getTitle(),
            ':description' => $keyResultEntity->getDescription(),
            ':type' => $keyResultEntity->getType(),
            ':id' => $keyResultEntity->getId()
        ]);

        if (!$execute) {
            return false;
        }

        return true;
    }

    /**
     * @param KeyResultEntity $keyResultEntity
     * @return bool
     */
    public function delete(KeyResultEntity $keyResultEntity)
    {
        $statement = $this->getConn()->prepare("UPDATE key_result SET deleted_at = NOW() WHERE id = :id");

        $execute = $statement->execute([
            ':id' => $keyResultEntity->getId()
        ]);

        if (!$execute) {
            return false;
        }

        return true;
    }

    /**
     * @param KeyResultEntity $keyResultEntity
     * @return bool
     */
    public function restore(KeyResultEntity $keyResultEntity)
    {
        $statement = $this->getConn()->prepare("UPDATE key_result SET deleted_at = null WHERE id = :id");

        $execute = $statement->execute([
            ':id' => $keyResultEntity->getId()
        ]);

        if (!$execute) {
            return false;
        }

        return true;
    }

    /**
     * @param int $objectiveId
     * @return array|false
     */
    public function listKeyResultByObjective(int $objectiveId) {
        $statement = $this->getConn()->prepare("SELECT * FROM key_result WHERE key_result.objective_id = :objectiveId");
        $statement->execute([
            ':objectiveId' => $objectiveId
        ]);

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param $id
     * @return array|false
     */
    public function findKeyResult($id) {
        $statement = $this->getConn()->prepare("SELECT * FROM key_result WHERE key_result.id = :id");
        $statement->execute([
            ':id' => $id
        ]);

        return $statement->fetchAll(\PDO::FETCH_ASSOC)[0];
    }
}