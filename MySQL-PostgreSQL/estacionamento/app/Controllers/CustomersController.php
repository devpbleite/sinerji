<?php

namespace App\Controllers;

use App\Libraries\Mongo\CustomerModel;
use App\Validation\CustomerValidation;
use CodeIgniter\HTTP\RedirectResponse;
use MongoDB\Model\BSONDocument;

class CustomersController extends BaseController
{
    // Constante que define o diretório das views para este controlador
    private const VIEWS_DIRECTORY = 'Customers/';

    // Instância do modelo de clientes
    private CustomerModel $customerModel;

    public function __construct()
    {
        // Inicializa o modelo de clientes
        $this->customerModel = new CustomerModel();
    }

    /**
     * Exibe a página de gerenciamento dos mensalistas.
     *
     * @return string
     */
    public function index(): string
    {
        // Permite somente o método GET
        $this->allowedMethod('get');

        // Define o título da página
        $this->dataToView['title'] = 'Gerenciar Mensalistas';

        // Obtém todos os mensalistas e armazena na variável de dados para a view
        $this->dataToView['customers'] = $this->customerModel->all();

        // Retorna a view com a lista de mensalistas
        return view(self::VIEWS_DIRECTORY . 'index', $this->dataToView);
    }

    /**
     * Exibe a página para criar um novo mensalista.
     *
     * @return string
     */
    public function new(): string
    {
        // Permite somente o método GET
        $this->allowedMethod('get');

        // Define o título da página
        $this->dataToView['title'] = 'Novo Mensalista';

        // Cria um novo documento BSON vazio para o formulário
        $this->dataToView['customer'] = new BSONDocument();

        // Retorna a view de criação de novo mensalista
        return view(self::VIEWS_DIRECTORY . 'new', $this->dataToView);
    }

    /**
     * Processa o formulário para criar um novo mensalista.
     *
     * @return RedirectResponse
     */
    public function create(): RedirectResponse
    {
        // Permite somente o método POST
        $this->allowedMethod('post');

        // Obtém as regras de validação para clientes
        $rules = (new CustomerValidation)->getRules();

        // Valida os dados do formulário
        if (!$this->validate($rules)) {
            // Redireciona de volta com erros se a validação falhar
            return redirect()
                ->back()
                ->with('danger', 'Verifique os erros e tente novamente!')
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        // Cria um novo mensalista com os dados validados
        if (!$this->customerModel->create(data: $this->validator->getValidated())) {
            // Redireciona de volta com mensagem de erro se a criação falhar
            return redirect()
                ->back()
                ->with('danger', 'Ocorreu um erro interno...')
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        // Redireciona para a lista de mensalistas com mensagem de sucesso
        return redirect()
            ->route('customers')
            ->with('success', 'Sucesso!');
    }

    /**
     * Exibe a página para editar um mensalista existente.
     *
     * @param string $id ID do mensalista a ser editado
     * @return string
     */
    public function edit(string $id): string
    {
        // Permite somente o método GET
        $this->allowedMethod('get');

        // Obtém o mensalista pelo ID ou lança uma exceção se não encontrado
        $customer = $this->customerModel->findOrFail($id);

        // Define o título da página
        $this->dataToView['title'] = 'Editar Customer';

        // Armazena o mensalista na variável de dados para a view
        $this->dataToView['customer'] = $customer;

        // Retorna a view de edição de mensalista
        return view(self::VIEWS_DIRECTORY . 'edit', $this->dataToView);
    }

    /**
     * Exibe a página de detalhes de um mensalista.
     *
     * @param string $id ID do mensalista a ser exibido
     * @return string
     */
    public function show(string $id): string
    {
        // Permite somente o método GET
        $this->allowedMethod('get');

        // Obtém o mensalista pelo ID ou lança uma exceção se não encontrado
        $customer = $this->customerModel->findOrFail($id);

        // Define o título da página
        $this->dataToView['title'] = 'Detalhes do Mensalista';

        // Armazena o mensalista na variável de dados para a view
        $this->dataToView['customer'] = $customer;

        // Retorna a view de detalhes do mensalista
        return view(self::VIEWS_DIRECTORY . 'show', $this->dataToView);
    }

    /**
     * Processa o formulário para atualizar um mensalista existente.
     *
     * @param string $id ID do mensalista a ser atualizado
     * @return RedirectResponse
     */
    public function update(string $id): RedirectResponse
    {
        // Permite somente o método PUT
        $this->allowedMethod('put');

        // Obtém as regras de validação para clientes
        $rules = (new CustomerValidation)->getRules();

        // Valida os dados do formulário
        if (!$this->validate($rules)) {
            // Redireciona de volta com erros se a validação falhar
            return redirect()
                ->back()
                ->with('danger', 'Verifique os erros e tente novamente!')
                ->withInput();
        }

        // Atualiza o mensalista com os dados validados
        if (!$this->customerModel->update(id: $id, data: $this->validator->getValidated())) {
            // Redireciona de volta com mensagem de erro se a atualização falhar
            return redirect()
                ->back()
                ->with('danger', 'Ocorreu um erro interno...')
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        // Redireciona para a lista de mensalistas com mensagem de sucesso
        return redirect()->route('customers')->with('success', 'Atualizada com sucesso!');
    }

    /**
     * Processa a exclusão de um mensalista.
     *
     * @param string $id ID do mensalista a ser excluído
     * @return RedirectResponse
     */
    public function delete(string $id): RedirectResponse
    {
        // Permite somente o método DELETE
        $this->allowedMethod('delete');

        // Exclui o mensalista pelo ID
        if (!$this->customerModel->delete(id: $id)) {
            // Redireciona de volta com mensagem de erro se a exclusão falhar
            return redirect()
                ->back()
                ->with('danger', 'Ocorreu um erro interno...')
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        // Redireciona para a lista de mensalistas com mensagem de sucesso
        return redirect()->route('customers')->with('success', 'Deletada com sucesso!');
    }
}
