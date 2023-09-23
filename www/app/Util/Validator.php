<?php

namespace App\Util;

use App\Entity\KeyResultEntity;
use App\Entity\ObjectiveEntity;
use App\Entity\User;

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

    public function userForm($data, $method = null)
    {
        $user = new User();

        if (empty($data['name']) && $method) {
            return [
                'result' => 'error',
                'message' => Message::NAME_REQUIRED
            ];
        }

        if (empty($data['email'])) {
            return [
                'result' => 'error',
                'message' => Message::EMAIL_REQUIRED
            ];
        }

        if (empty($data['password'])) {
            return [
                'result' => 'error',
                'message' => Message::PASSWORD_REQUIRED
            ];
        }

        if ($method) {
            $user->setName($data['name']);
            if(!$this->checkPassword($data['password'], $data['confirmPassword'])){
                return [
                    'result' => 'error',
                    'message' => Message::DIFFERENT_PASSWORD
                ];
            }
        }

        $user->setEmail($data['email']);
        $user->setPassword($data['password']);

        return [
            'result' => 'success',
            'user' => $user
        ];
    }

    /**
     * Função para validar o formulario dos objetivos
     * @param $data
     * @return array
     */
    public function validatorFormObjective($data, $method = null)
    {
        if (empty($data['title'])) {
            return [
                'result' => 'error',
                'message' => Message::TITLE_REQUIRED
            ];
        }

        if (empty($data['description'])) {
            return [
                'result' => 'error',
                'message' => Message::DESCRIPTION_REQUIRED
            ];
        }

        $objective = new ObjectiveEntity();

        if (isset($data['id'])) {
            $objective->setId($data['id']);
        }

        if (!$method) {
            $objective->setUser($_SESSION['user_id']);
        }

        $objective->setTitle($data['title']);
        $objective->setDescription($data['description']);

        return [
            'result' => 'success',
            'objective' => $objective
        ];
    }

    /**
     * @param $objective
     * @param ObjectiveEntity $postObjective
     * @return array
     */
    public function checkChangeObjective($objective, $postObjective)
    {
        $title = $objective['title'] === $postObjective->getTitle();
        $description = $objective['description'] === $postObjective->getDescription();

        if ($title && $description) {
            return [
                'result' => 'error',
                'message' => Message::RECORD_NOT_CHANGED
            ];
        }

        return [
            'result' => 'success',
        ];
    }

    /**
     * Função responsavel por validar os dados do formulario do keyresult
     * @param $data
     * @param $method
     * @return array
     */
    public function validatorFormKeyResult($data, $method = null)
    {
        if (empty($data['title'])) {
            return[
                'result' => 'error',
                'message' => Message::TITLE_REQUIRED
            ];
        }

        if (empty($data['type'])) {
            return [
                'result' => 'error',
                'message' => Message::TYPE_REQUIRED
            ];
        }

        if (empty($data['description'])) {
            return [
                'result' => 'error',
                'message' => Message::DESCRIPTION_REQUIRED
            ];
        }

        $keyResult = new KeyResultEntity();

        if ($method) {
            $keyResult->setId($data['id']);
        }
        $keyResult->setDescription($data['description']);
        $keyResult->setType($data['type']);
        $keyResult->setTitle($data['title']);
        $keyResult->setObjectiveId($data['objective_id']);

        return [
            'result' => 'success',
            'keyResult' => $keyResult
        ];
    }

    /**
     * @param $keyresult
     * @param KeyResultEntity $postKeyResult
     * @return array
     */
    public function checkChangeKeyresult($keyresult, $postKeyResult)
    {
        $title = $keyresult['title'] === $postKeyResult->getTitle();
        $description = $keyresult['description'] === $postKeyResult->getDescription();
        $type = $keyresult['type'] === $postKeyResult->getType();

        if ($title && $description && $type) {
            return [
                'result' => 'error',
                'message' => Message::RECORD_NOT_CHANGED
            ];
        }

        return [
            'result' => 'success',
        ];
    }
}