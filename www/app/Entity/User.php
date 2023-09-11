<?php

namespace App\Entity;

/**
 * @author João Vitor Botelho
 * Entity responsavel pelo objeto User
 */
class User extends DataBase
{
    /**
     * @var $email
     */
    public $email;

    /**
     * @var $password
     */
    public $password;

    /**
     * @var $name
     */
    public $name;

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }
}