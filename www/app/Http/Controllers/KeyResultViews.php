<?php

namespace App\Http\Controllers;

use App\Repository\KeyResultRepository;
use App\Repository\ObjectiveRepository;

/**
 * @author João Vitor Botelho
 * Classe responsavel pela exibição das views do fluxo do key result do usuario
 */
class KeyResultViews extends Controller
{
    /**
     * @var KeyResultRepository
     */
    private $keyResultRepository;

    /**
     * @var ObjectiveRepository
     */
    private $objectiveRepository;

    public function __construct()
    {
        $this->setKeyResultRepository(new KeyResultRepository());
        $this->setObjectiveRepository(new ObjectiveRepository());
    }

    /**
     * Função para exibir a view de listagem para o usuario
     * @param int $id
     * @return null
     */
    public function list(int $id)
    {
        $data = [
            'title' => 'Resultados chaves',
            'keyResults' => $this->getKeyResultRepository()->listKeyResultByObjective($id),
            'objective' => $this->getObjectiveRepository()->findObjective($id)
        ];

        return $this->view('Key-result/index', $data);
    }

    /**
     * Função para exibir a view de criação de um novo key result
     * @param int $id
     * @return null
     */
    public function newKeyResult(int $id)
    {
        $data = [
            'title' => 'Novo resultado chaves',
            'objective_id' => $id
        ];

        return $this->view('Key-result/newKeyResult', $data);
    }

    /**
     * Função responsavel por exibir a view de edição de um key result
     * @param int $id
     * @return null
     */
    public function edit(int $id)
    {
        $data = [
            'title' => 'Editando resultado chaves',
            'keyResult' => $this->getKeyResultRepository()->findKeyResult($id),
        ];

        return $this->view('Key-result/editKeyResult', $data);
    }

    /**
     * Função de exibição da view de remoção do key result
     * @param int $id
     * @return null
     */
    public function remove(int $id)
    {
        $data = [
            'title' => 'Removendo resultado chave',
            'keyResult' => $this->getKeyResultRepository()->findKeyResult($id)
        ];

        return $this->view('Key-result/removeKeyResult', $data);
    }

    /**
     * Função responsavel por exibir a view de restauração do key result
     * @param int $id
     * @return null
     */
    public function restoreKeyResult(int $id)
    {
        $data = [
            'title' => 'Restaurando resultado chave',
            'keyResult' => $this->getKeyResultRepository()->findKeyResult($id)
        ];

        return $this->view('Key-result/restoreKeyResult', $data);
    }

    /**
     * @return KeyResultRepository
     */
    public function getKeyResultRepository(): KeyResultRepository
    {
        return $this->keyResultRepository;
    }

    /**
     * @param KeyResultRepository $keyResultRepository
     */
    public function setKeyResultRepository(KeyResultRepository $keyResultRepository): void
    {
        $this->keyResultRepository = $keyResultRepository;
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