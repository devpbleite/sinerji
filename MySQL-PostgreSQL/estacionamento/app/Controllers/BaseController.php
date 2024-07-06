<?php

namespace App\Controllers;

use App\Models\CompanyModel;
use CodeIgniter\Controller;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = ['form', 'app', 'number',];


    protected $dataToView = [];
    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Recebe a company que está cadastrada.
        $company = model(CompanyModel::class)->getCompany();

        // Todos as views terão acesso a propriedades passadas por aqui.
        $this->dataToView['title'] = $company->name ?? 'Projeto Capacitação';
        $view = \Config\Services::renderer();
        $view->setVar(name: 'company', value: $company);
    }

    # Verifica se o método enviado na requisição é o mesmo do permitido no controller(enviado na chamada da função).
    protected function allowedMethod(string $method): void
    {
        $method =   strtolower($method);
        if (!$this->request->is($method)) {
            throw new PageNotFoundException("Verbo HTTP {$method} não permitido");
        }
    }
}
