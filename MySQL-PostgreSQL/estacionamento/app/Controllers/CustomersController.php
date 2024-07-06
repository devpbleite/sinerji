<?php

namespace App\Controllers;

use App\Libraries\Mongo\CustomerModel;
use App\Validation\CustomerValidation;
use CodeIgniter\HTTP\RedirectResponse;
use MongoDB\Model\BSONDocument;

class CustomersController extends BaseController
{
    // Diretório de visualizações para este controller.
    private const VIEWS_DIRECTORY = 'Customers/';

    // Instância do modelo de cliente.
    private CustomerModel $customerModel;

    // Construtor que inicializa o modelo de cliente.
    public function __construct()
    {
        $this->customerModel = new CustomerModel();
    }

    // Método para exibir a lista de clientes.
    public function index(): string
    {
        $this->allowedMethod('get');
        $this->dataToView['title'] = 'Gerenciar Mensalistas';
        $this->dataToView['customers'] = $this->customerModel->all();
        return view(self::VIEWS_DIRECTORY . 'index', $this->dataToView);
    }

    // Método para exibir o formulário de criação de um novo cliente.
    public function new(): string
    {
        $this->allowedMethod('get');
        $this->dataToView['title'] = 'Novo Mensalista';
        $this->dataToView['customer'] = new BSONDocument();
        return view(self::VIEWS_DIRECTORY . 'new', $this->dataToView);
    }

    // Método para criar um novo cliente.
    public function create(): RedirectResponse
    {
        $this->allowedMethod('post');

        $rules = (new CustomerValidation)->getRules();

        // Valida os dados do formulário.
        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->with('danger', 'Verifique os erros e tente novamente!')
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        // Tenta criar o novo cliente no banco de dados.
        if (!$this->customerModel->create(data: $this->validator->getValidated())) {
            return redirect()
                ->back()
                ->with('danger', 'Ocorreu um erro interno...')
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        return redirect()
            ->route('customers')
            ->with('success', 'Sucesso!');
    }

    // Método para exibir o formulário de edição de um cliente existente.
    public function edit(string $id): string
    {
        $this->allowedMethod('get');
        $customer = $this->customerModel->findOrFail($id);
        $this->dataToView['title'] = 'Editar Customer';
        $this->dataToView['customer'] = $customer;
        return view(self::VIEWS_DIRECTORY . 'edit', $this->dataToView);
    }

    // Método para exibir os detalhes de um cliente específico.
    public function show(string $id): string
    {
        $this->allowedMethod('get');
        $customer = $this->customerModel->findOrFail($id);
        $this->dataToView['title'] = 'Detalhes do Mensalista';
        $this->dataToView['customer'] = $customer;
        return view(self::VIEWS_DIRECTORY . 'show', $this->dataToView);
    }

    // Método para atualizar um cliente existente.
    public function update(string $id): RedirectResponse
    {
        $this->allowedMethod('put');
        $rules = (new CustomerValidation)->getRules();

        // Valida os dados do formulário.
        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->with('danger', 'Verifique os erros e tente novamente!')
                ->withInput();
        }

        // Tenta atualizar o cliente no banco de dados.
        if (!$this->customerModel->update(id: $id, data: $this->validator->getValidated())) {
            return redirect()
                ->back()
                ->with('danger', 'Ocorreu um erro interno...')
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        return redirect()->route('customers')->with('success', 'Atualizada com sucesso!');
    }

    // Método para deletar um cliente existente.
    public function delete(string $id): RedirectResponse
    {
        $this->allowedMethod('delete');

        // Tenta deletar o cliente no banco de dados.
        if (!$this->customerModel->delete(id: $id)) {
            return redirect()
                ->back()
                ->with('danger', 'Ocorreu um erro interno...')
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        return redirect()->route('customers')->with('success', 'Deletada com sucesso!');
    }
}
