<?php

namespace App\Http\Controllers;

/**
 * @author João Vitor Botelho
 * Classe generica de controller que contem as funções usadas pelos controllers
 */
abstract class Controller
{
    /**
     * @param $json
     * @return void
     */
    protected function sendJson ($json){
        echo json_encode($json);
        exit;
    }

    /**
     * Função responsavel por gerenciar a view que vai ser exibida
     * @param string $view
     * @param array $args
     * @return mixed
     */
    protected function view(string $view, array $args = [])
    {
        include_once '../app/Views/' . $view . '.phtml';
    }
}