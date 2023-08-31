<?php

namespace App\Entity;

class User extends DatabaseConnection
{
    public $email;
    public $password;
    public $name;
}