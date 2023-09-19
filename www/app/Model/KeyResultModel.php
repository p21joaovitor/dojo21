<?php

namespace App\Model;

use App\Entity\DatabaseConnection;
use App\Entity\KeyResultEntity;
use App\Entity\ObjectiveEntity;
use App\Repository\KeyResultRepository;

/**
 * @author João Vitor Botelho
 * Classe responsavel pelo gerenciamento das querys
 */
class KeyResultModel extends Model
{
    /**
     * @var KeyResultRepository
     */
    private $keyResultRepository;

    public function __construct()
    {
        $this->setKeyResultRepository(new KeyResultRepository());
    }

    /**
     * @param KeyResultEntity $keyResultEntity
     * @return false|string
     */
    public function save($data)
    {
        $keyResultEntity = new KeyResultEntity();
        $keyResultEntity->setDescription($data['description']);
        $keyResultEntity->setType($data['type']);
        $keyResultEntity->setTitle($data['title']);
        $keyResultEntity->setObjectiveId($data['objective_id']);

        $keyResultId = $this->getKeyResultRepository()->save($keyResultEntity);

        if (!$keyResultId) {
            return false;
        }

        return $keyResultEntity->getObjectiveId();
    }

    /**
     * @param KeyResultEntity $keyResultEntity
     * @return bool
     */
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

    /**
     * @param KeyResultEntity $keyResultEntity
     * @return bool
     */
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

    /**
     * @param KeyResultEntity $keyResultEntity
     * @return bool
     */
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

    /**
     * @param int $objectiveId
     * @return array|false
     */
    public function list(int $objectiveId) {
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

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @return mixed
     */
    public function getKeyResultRepository()
    {
        return $this->keyResultRepository;
    }

    /**
     * @param mixed $keyResultRepository
     */
    public function setKeyResultRepository($keyResultRepository): void
    {
        $this->keyResultRepository = $keyResultRepository;
    }
}