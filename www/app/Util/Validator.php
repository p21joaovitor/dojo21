<?php

namespace App\Util;

/**
 * @author João Vitor Botelho
 * Classe responsavel por validações genericas
 */
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