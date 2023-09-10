<?php

namespace App\Http\Controllers;

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

    protected function view(string $view, array $args = [])
    {
        include_once '../app/Views/' . $view . '.phtml';
    }
}