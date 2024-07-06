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
 * Classe BaseController
 *
 * BaseController fornece um local conveniente para carregar componentes
 * e executar funções que são necessárias para todos os seus controladores.
 * Estenda esta classe em qualquer novo controlador:
 *     class Home extends BaseController
 *
 * Por segurança, certifique-se de declarar quaisquer novos métodos como protected ou private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instância do objeto principal Request.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * Um array de helpers a serem carregados automaticamente na
     * instanciação da classe. Esses helpers estarão disponíveis
     * para todos os outros controladores que estendem BaseController.
     *
     * @var list<string>
     */
    protected $helpers = ['form', 'app', 'number'];

    /**
     * Array de dados que serão passados para as views.
     */
    protected $dataToView = [];

    /**
     * Certifique-se de declarar propriedades para qualquer propriedade que você inicializou.
     * A criação de propriedades dinâmicas está obsoleta no PHP 8.2.
     */
    // protected $session;

    /**
     * Método initController
     * 
     * Este método é chamado automaticamente quando o controlador é inicializado.
     * 
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param LoggerInterface $logger
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Não edite esta linha
        parent::initController($request, $response, $logger);

        // Obtém informações da empresa usando o modelo CompanyModel
        $company = model(CompanyModel::class)->getCompany();

        // Todos as views terão acesso a propriedades passadas por aqui.
        $this->dataToView['title'] = $company->name ?? 'Projeto Capacitação';
        $view = \Config\Services::renderer();

        // Define a variável 'company' disponível para todas as views
        $view->setVar(name: 'company', value: $company);
    }

    /**
     * Método allowedMethod
     * 
     * Verifica se o método HTTP permitido é o mesmo do método atual da requisição.
     * Se não for, lança uma exceção PageNotFoundException.
     *
     * @param string $method O método HTTP permitido (ex: 'post', 'get')
     * @return void
     * @throws PageNotFoundException
     */
    protected function allowedMethod(string $method): void
    {
        // Converte o método para minúsculas
        $method = strtolower($method);

        // Verifica se o método da requisição é o mesmo que o permitido
        if (!$this->request->is($method)) {
            // Lança exceção se o método não for permitido
            throw new PageNotFoundException("Verbo HTTP {$method} não permitido");
        }
    }
}
