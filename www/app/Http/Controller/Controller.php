<?php

namespace App\Http\Controller;

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
}