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

    protected function view(string $view, $args = null)
    {
        $this->tittlePages($view);
        include_once '../app/Views/' . $view . '.phtml';
    }

    private function tittlePages(string $path)
    {
        $_SESSION['title'] = '';
        $folders = [
          'Login/index' => [
              'title' => 'Login'
          ],
          'Login/register' => [
              'title' => 'Register'
          ],
          'Home/index' => [
              'title' => 'Home'
          ]
        ];

        if (!array_key_exists($path, $folders)){
            return false;
        }

        $_SESSION[array_key_first($folders[$path])] = $folders[$path]['title'];
    }
}