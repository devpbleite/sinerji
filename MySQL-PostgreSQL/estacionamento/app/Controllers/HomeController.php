<?php

namespace App\Controllers;

use App\Libraries\Mongo\TesteModel;

class HomeController extends BaseController
{
    // Diretório de visualizações para este controlador.
    private const VIEWS_DIRECTORY = 'Home/';

    // Método para exibir a página inicial.
    public function index(): string
    {
        // Define o título da página inicial.
        $this->dataToView['title'] = 'Você está no home';
        // Retorna a visualização da página inicial com os dados.
        return view(self::VIEWS_DIRECTORY . 'index', $this->dataToView);
    }
}
