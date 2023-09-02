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

    protected function view(string $view)
    {
        $this->tittlePages($view);
        include_once '../app/Views/' . $view . '.phtml';
    }

    private function tittlePages(string $path)
    {
        $folders = [
          'Login/index' => [
              'title' => 'Login'
          ]
        ];

    $_SESSION[array_key_first($folders[$path])] = $folders[$path]['title'];

    }
}