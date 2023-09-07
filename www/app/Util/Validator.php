<?php

namespace App\Util;

class Validator
{
    public function checkPassword($password, $checkPassword)
    {
        if ($password !== $checkPassword) {
            return false;
        }

        return true;
    }
}