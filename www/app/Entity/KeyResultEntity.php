<?php

namespace App\Entity;

use App\Entity\Entity;

/**
 * @author João Vitor Botelho
 * Entity responsavel pelo objeto keyResult
 */
class KeyResultEntity extends Entity
{
    private $id;
    private $title;
    private $description;
    private $type;
    private $objectiveId;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }/**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getObjectiveId()
    {
        return $this->objectiveId;
    }

    /**
     * @param mixed $objectiveId
     */
    public function setObjectiveId($objectiveId)
    {
        $this->objectiveId = $objectiveId;
    }
}