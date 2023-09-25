<?php

namespace App\Model;

use App\Entity\ObjectiveEntity;
use App\Repository\ObjectiveRepository;
use App\Util\Message;
use App\Util\Validator;

/**
 * @author João Vitor Botelho
 * Classe responsavel pelo gerenciamento das regras
 */
class ObjectiveModel extends Model
{

    /**
     * @var Validator
     */
    private $validator;

    /**
     * @var ObjectiveRepository
     */
    private $objectiveRepository;

    public function __construct()
    {
        $this->setValidator(new Validator());
        $this->setObjectiveRepository(new ObjectiveRepository());
    }

    /**
     * @param ObjectiveEntity $objectiveEntity
     * @return array
     */
    public function save(ObjectiveEntity $objectiveEntity)
    {
        $save = $this->getObjectiveRepository()->save($objectiveEntity);

        if (!$save) {
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
     * @param ObjectiveEntity $objectiveEntity
     * @return array|false[]
     */
    public function update(ObjectiveEntity $objectiveEntity)
    {
        $objective = $this->getObjectiveRepository()->findObjective($objectiveEntity->getId());
        $alteracao = $this->getValidator()->checkChangeObjective($objective, $objectiveEntity);

        if ($alteracao['result'] === 'error') {
            return [
                'error' => true,
                'message' => Message::RECORD_NOT_CHANGED
            ];
        }

        $update = $this->getObjectiveRepository()->update($objectiveEntity);

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
    public function finish($data)
    {
        $objectiveEntity = new ObjectiveEntity();
        $objectiveEntity->setId($data['id']);
        $objectiveEntity->setStatus(ObjectiveEntity::FINALIZADO);

        $finish = $this->getObjectiveRepository()->finish($objectiveEntity);

        if (!$finish) {
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
     * @return array|false[]
     */
    public function delete($data)
    {
        $objectiveEntity = new ObjectiveEntity();
        $objectiveEntity->setId($data['id']);

        $remove = $this->getObjectiveRepository()->delete($objectiveEntity);

        if (!$remove) {
            return [
                'error' => true,
                'message' => Message::NOT_DELETED
            ];
        }

        return [
            'error' => false
        ];
    }

    /**
     * @param $data
     * @return array|false[]
     */
    public function restore($data)
    {
        $objectiveEntity = new ObjectiveEntity();
        $objectiveEntity->setId($data['id']);

        $restore = $this->getObjectiveRepository()->restore($objectiveEntity);

        if (!$restore) {
            return [
                'error' => true,
                'message' => Message::NOT_RESTORE
            ];
        }

        return [
            'error' => false
        ];
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

    /**
     * @return ObjectiveRepository
     */
    public function getObjectiveRepository(): ObjectiveRepository
    {
        return $this->objectiveRepository;
    }

    /**
     * @param ObjectiveRepository $objectiveRepository
     */
    public function setObjectiveRepository(ObjectiveRepository $objectiveRepository): void
    {
        $this->objectiveRepository = $objectiveRepository;
    }
}