<?php

namespace App\Entity;

use App\Entity\Entity;

/**
 * @author João Vitor Botelho
 * Entity responsavel pelo objeto Objective
 */
class ObjectiveEntity extends Entity
{
    public const EM_PROGRESSO = 0;
    public const FINALIZADO = 1;

    /**
     * @var $id
     */
    private $id;

    /**
     * @var $user
     */
    private $user;

    /**
     * @var $title
     */
    private $title;

    /**
     * @var $description
     */
    private $description;

    /**
     * @var $status
     */
    private $status;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
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
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

}