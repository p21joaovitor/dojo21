<?php

namespace App\Http\Controllers;

class Home extends Controller
{
    public function index()
    {
        if (isset($_SESSION['user_id'])) {
            $data = [
              'title' => 'Inicio'
            ];
            return $this->view('Home/index', $data);
        }

        $data = [
            'title' => 'Login'
        ];
        return $this->view('Login/index', $data);
    }
}