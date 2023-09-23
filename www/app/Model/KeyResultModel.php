<?php

namespace App\Model;

use App\Entity\DatabaseConnection;
use App\Entity\KeyResultEntity;
use App\Entity\ObjectiveEntity;
use App\Repository\KeyResultRepository;
use App\Util\Message;
use App\Util\Validator;

/**
 * @author João Vitor Botelho
 * Classe responsavel pelo gerenciamento das querys
 */
class KeyResultModel extends Model
{
    /**
     * @var Validator
     */
    private $validator;

    /**
     * @var KeyResultRepository
     */
    private $keyResultRepository;

    public function __construct()
    {
        $this->setKeyResultRepository(new KeyResultRepository());
        $this->setValidator(new Validator());
    }

    /**
     * @param KeyResultEntity $keyResultEntity
     * @return array|integer
     */
    public function save(KeyResultEntity $keyResultEntity)
    {
        $save = $this->getKeyResultRepository()->save($keyResultEntity);

        if (!$save) {
            return [
                'error' => true,
                'message' => Message::NOT_SAVE
            ];
        }

        return [
            'error' => false,
            'objective' => $keyResultEntity->getObjectiveId()
        ];
    }

    /**
     * @param KeyResultEntity $keyResultEntity
     * @return array
     */
    public function update(KeyResultEntity $keyResultEntity)
    {
        $keyResult = $this->getKeyResultRepository()->findKeyResult($keyResultEntity->getId());
        $alteracao = $this->getValidator()->checkChangeKeyresult($keyResult, $keyResultEntity);

        if ($alteracao['result'] === 'error') {
            return [
                'error' => true,
                'message' => Message::RECORD_NOT_CHANGED
            ];
        }

        $update = $this->getKeyResultRepository()->update($keyResultEntity);

        if (!$update) {
            return [
                'error' => true,
                'message' => Message::NOT_SAVE
            ];
        }

        return [
            'error' => false
        ];
    }

    /**
     * @param $data
     * @return array
     */
    public function delete($data)
    {
        $keyResultEntity = new KeyResultEntity();
        $keyResultEntity->setId($data['id']);

        $keyResult = $this->getKeyResultRepository()->findKeyResult($keyResultEntity->getId());

        if (!$keyResult) {
            return [
                'error' => true,
                'message' => Message::REGISTER_NOT_FOUND
            ];
        }

        $delete = $this->getKeyResultRepository()->delete($keyResultEntity);

        if (!$delete) {
            return [
                'error' => true,
                'message' => Message::NOT_DELETED
            ];
        }

        return [
            'error' => false,
            'objective_id' => $keyResult['objective_id']
        ];
    }

    /**
     * @param $data
     * @return array
     */
    public function restore($data)
    {
        $keyResultEntity = new KeyResultEntity();
        $keyResultEntity->setId($data['id']);

        $keyResult = $this->getKeyResultRepository()->findKeyResult($keyResultEntity->getId());

        if (!$keyResult) {
            return [
                'error' => true,
                'message' => Message::REGISTER_NOT_FOUND
            ];
        }

        $delete = $this->getKeyResultRepository()->restore($keyResultEntity);

        if (!$delete) {
            return [
                'error' => true,
                'message' => Message::NOT_RESTORE
            ];
        }

        return [
            'error' => false,
            'objective_id' => $keyResult['objective_id']
        ];
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

    /**
     * @return Validator
     */
    public function getValidator(): Validator
    {
        return $this->validator;
    }

    /**
     * @param Validator $validator
     */
    public function setValidator(Validator $validator): void
    {
        $this->validator = $validator;
    }
}