<?php

namespace App\Model;

use App\Entity\DatabaseConnection;
use App\Entity\ObjectiveEntity;
use PDO;

/**
 * @author João Vitor Botelho
 * Classe de comunicação com o banco de dados
 */
class ObjectiveModel extends Model
{
    /**
     * @param ObjectiveEntity $objective
     * @return void
     */
    public function save(ObjectiveEntity $objective){

        /** @var $pdoConnection PDO */
        $statement = $this->getConn()->prepare("INSERT INTO objective (user_id, title, description) values (:user_id, :title, :description)");
        $statement->execute([
            ':user_id' => $objective->getUser(),
            ':title' =>  $objective->getTitle(),
            ':description' => $objective->getDescription(),
        ]);
    }

    /**
     * @param int $userId
     * @return array|false
     */
    public function list(int $userId) {
        $statement = $this->getConn()->prepare("SELECT * FROM objective WHERE objective.user_id = :user_id");
        $statement->bindParam(':user_id', $userId);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param int $objectiveId
     * @return array|false
     */
    public function findObjective(int $objectiveId) {
        $statement = $this->getConn()->prepare("SELECT * FROM objective WHERE objective.id = :id");
        $statement->bindParam(':id', $objectiveId);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param ObjectiveEntity $objectiveEntity
     * @return bool
     */
    public function update(ObjectiveEntity $objectiveEntity)
    {
        $statement = $this->getConn()->prepare("UPDATE objective SET title = :title, description = :description, updated_at = NOW() WHERE id = :id");

        $statement->execute([
            ':title' =>  $objectiveEntity->getTitle(),
            ':description' => $objectiveEntity->getDescription(),
            ':id' => $objectiveEntity->getId()
        ]);

        if ($statement->rowCount()) {
            return true;
        }

        return false;
    }

    /**
     * @param ObjectiveEntity $objectiveEntity
     * @return bool
     */
    public function delete(ObjectiveEntity $objectiveEntity)
    {
        $statement = $this->getConn()->prepare("UPDATE objective SET deleted_at = NOW() WHERE id = :id");

        $statement->execute([
            ':id' => $objectiveEntity->getId()
        ]);

        if ($statement->rowCount()) {
            return true;
        }

        return false;
    }

    /**
     * @param ObjectiveEntity $objectiveEntity
     * @return bool
     */
    public function restore(ObjectiveEntity $objectiveEntity)
    {
        $statement = $this->getConn()->prepare("UPDATE objective SET deleted_at = null WHERE id = :id");

        $statement->execute([
            ':id' => $objectiveEntity->getId()
        ]);

        if ($statement->rowCount()) {
            return true;
        }

        return false;
    }

    /**
     * @param ObjectiveEntity $objectiveEntity
     * @return bool
     */
    public function finish(ObjectiveEntity $objectiveEntity)
    {
        $statement = $this->getConn()->prepare("UPDATE objective SET status = :status WHERE id = :id");

        $statement->execute([
            ':status' => $objectiveEntity->getStatus(),
            ':id' => $objectiveEntity->getId()
        ]);

        if ($statement->rowCount()) {
            return true;
        }

        return false;
    }
}