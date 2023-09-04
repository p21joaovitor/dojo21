<?php

namespace App\Http\Controllers;

class Home extends Controller
{
    public function index()
    {session_destroy();
        if (isset($_SESSION['user_id'])) {
            return $this->view('Home/index');
        }

        return $this->view('Login/index');
    }
}