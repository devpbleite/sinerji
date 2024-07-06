<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Mongo\CarModel;
use App\Libraries\Mongo\CustomerModel;
use App\Validation\CarsValidation;
use CodeIgniter\HTTP\RedirectResponse;
use MongoDB\BSON\ObjectId;
use MongoDB\Model\BSONDocument;

class CarsController extends BaseController
{
    // Diretório de visualizações paro o controller dos carros.
    private const VIEWS_DIRECTORY = 'Cars/';

    // Instâncias dos modelos de cliente e carro.
    private CustomerModel $customerModel;
    private CarModel $carModel;

    // Construtor que inicializa os modelos de cliente e carro.
    public function __construct()
    {
        $this->customerModel = new CustomerModel();
        $this->carModel = new CarModel();
    }

    // Método para listar todos os carros de um cliente.
    public function all(string $customer_id): string
    {
        $customer = $this->customerModel->findOrFail($customer_id);
        $this->dataToView['title'] = "Carros do mensalista: {$customer['name']}";
        $this->dataToView['customer'] = $customer;
        $this->dataToView['cars'] = $this->carModel->allByCustomerId($customer_id);

        return view(self::VIEWS_DIRECTORY . 'all', $this->dataToView);
    }

    // Método para exibir o formulário de criação de um novo carro.
    public function new(string $customer_id): string
    {
        $this->dataToView['title'] = 'Novo Carro';
        $this->dataToView['customer_id'] = $customer_id;
        $this->dataToView['car'] = new BSONDocument();

        return view(self::VIEWS_DIRECTORY . 'new', $this->dataToView);
    }

    // Método para criar um novo carro.
    public function create(): RedirectResponse
    {
        $this->allowedMethod('post');

        $rules = (new CarsValidation)->getRules();

        // Valida os dados do formulário.
        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->with('danger', 'Verifique os erros e tente novamente!')
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        // Prepara os dados para inserção no banco de dados.
        $data = $this->validator->getValidated();
        $data['customer_id'] = new ObjectId($data['customer_id']);
        if (!$this->carModel->create(data: $data)) {
            return redirect()
                ->back()
                ->with('danger', 'Ocorreu um erro interno...')
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }
        return redirect()->back()->with('success', 'Sucesso!');
    }

    // Método para exibir o formulário de edição de um carro existente.
    public function edit(string $id): string
    {
        $this->allowedMethod('get');
        $car = $this->carModel->findOrFail($id);
        $this->dataToView['title'] = 'Editar carro';
        $this->dataToView['customer_id'] = (string) $car['customer_id'];
        $this->dataToView['car'] =  $car;

        return view(self::VIEWS_DIRECTORY . 'edit', $this->dataToView);
    }

    // Método para atualizar um carro existente.
    public function update(string $car_id): RedirectResponse
    {
        $this->allowedMethod('put');

        $rules = (new CarsValidation)->getRules();

        // Valida os dados do formulário.
        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->with('danger', 'Verifique os erros e tente novamente!')
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        // Prepara os dados para atualização no banco de dados.
        $data = $this->validator->getValidated();
        $customer_id = (string) $data['customer_id'];

        unset($data['customer_id']);
        if (!$this->carModel->update(id: $car_id, data: $data)) {
            return redirect()
                ->back()
                ->with('danger', 'Ocorreu um erro interno...')
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }
        return redirect()->route('customers.cars', [$customer_id])->with('success', 'Sucesso!');
    }

    // Método para deletar um carro existente.
    public function delete(string $id): RedirectResponse
    {
        $this->allowedMethod('delete');

        // Tenta deletar o carro no banco de dados.
        if (!$this->carModel->delete(id: $id)) {
            return redirect()
                ->back()
                ->with('danger', 'Ocorreu um erro interno...')
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        return redirect()->back()->with('success', 'Deletada com sucesso!');
    }
}
