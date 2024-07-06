<?php

namespace App\Controllers;

use App\Libraries\Mongo\TesteModel;

class HomeController extends BaseController
{
    // Constante que define o diretório das views para este controlador
    private const VIEWS_DIRECTORY = 'Home/';

    /**
     * Exibe a página inicial.
     *
     * @return string
     */
    public function index(): string
    {
        // Define o título da página
        $this->dataToView['title'] = 'Você está no home';

        // Retorna a view da página inicial
        return view(self::VIEWS_DIRECTORY . 'index', $this->dataToView);
    }
}
