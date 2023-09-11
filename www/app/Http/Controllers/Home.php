<?php

namespace App\Http\Controllers;

/**
 * @author João Vitor Botelho
 * Controller inicial do sistema
 */
class Home extends Controller
{
    /**
     * Função principal de exibição do sistema de acordo com a sessão
     * @return null
     */
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