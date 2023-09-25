<?php

namespace App\Http\Controllers;

use App\Repository\ObjectiveRepository;

/**
 * @author João Vitor Botelho
 * Classe responsavel pela exibição das views do fluxo do objective do usuario
 */
class ObjectiveViews extends Controller
{
    /**
     * @var ObjectiveRepository
     */
    private $objectiveRepository;

    public function __construct()
    {
        $this->setObjectiveRepository(new ObjectiveRepository());
    }

    /**
     * Função principal do controller que faz a exibição da view de listagem
     * @return null
     */
    public function index()
    {
        $data = [
            'title' => 'Meus Objetivos',
            'objective' => $this->getObjectiveRepository()->listObjectiveByUser($_SESSION['user_id'])
        ];
        return $this->view('Objective/index', $data);
    }

    /**
     * Função para a exibição da view de novo objective
     * @return null
     */
    public function newObjective()
    {
        $data = [
            'title' => 'Novo Objetivo'
        ];
        return $this->view('Objective/newObjective', $data);
    }

    /**
     * Função responsavel por exibir a view de edição do objective
     * @param int $id
     * @return null
     */
    public function edit(int $id)
    {
        $data = [
            'title' => 'Editando objetivo',
            'objective' => $this->getObjectiveRepository()->findObjective($id)
        ];

        return $this->view('Objective/editObjective', $data);
    }

    /**
     * Função responsavel por exibir a view de finalização do objective
     * @param int $id
     * @return null
     */
    public function finishObjective(int $id)
    {
        $data = [
            'title' => 'Finalizando o objetivo',
            'objective' => $this->getObjectiveRepository()->findObjective($id)
        ];

        return $this->view('Objective/finish', $data);
    }

    /**
     * Função responsavel por exibir a view de remoção do objective
     * @param int $id
     * @return null
     */
    public function remove(int $id)
    {
        $data = [
            'title' => 'Removendo o objetivo',
            'objective' => $this->getObjectiveRepository()->findObjective($id)
        ];

        return $this->view('Objective/removeObjective', $data);
    }

    /**
     * Função responsavel por exibir a view de restauração do objective
     * @param int $id
     * @return null
     */
    public function restoreObjective(int $id)
    {
        $data = [
            'title' => 'Restaurando objetivo',
            'objective' => $this->getObjectiveRepository()->findObjective($id)
        ];

        return $this->view('Objective/restoreObjective', $data);
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