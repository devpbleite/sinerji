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
    // Diretório das views relacionadas aos carros
    private const VIEWS_DIRECTORY = 'Cars/';

    // Modelos de cliente e carro
    private CustomerModel $customerModel;
    private CarModel $carModel;

    public function __construct()
    {
        // Inicializa os modelos de cliente e carro
        $this->customerModel = new CustomerModel();
        $this->carModel = new CarModel();
    }

    /**
     * Exibe todos os carros de um cliente específico.
     *
     * @param string $customer_id
     * @return string
     */
    public function all(string $customer_id): string
    {
        // Busca o cliente pelo ID
        $customer = $this->customerModel->findOrFail($customer_id);

        // Configura os dados para a view
        $this->dataToView['title'] = "Carros do mensalista: {$customer['name']}";
        $this->dataToView['customer'] = $customer;
        $this->dataToView['cars'] = $this->carModel->allByCustomerId($customer_id);

        // Retorna a view com todos os carros do cliente
        return view(self::VIEWS_DIRECTORY . 'all', $this->dataToView);
    }

    /**
     * Exibe o formulário para adicionar um novo carro.
     *
     * @param string $customer_id
     * @return string
     */
    public function new(string $customer_id): string
    {
        // Configura os dados para a view
        $this->dataToView['title'] = 'Novo Carro';
        $this->dataToView['customer_id'] = $customer_id;
        $this->dataToView['car'] = new BSONDocument();

        // Retorna a view para adicionar um novo carro
        return view(self::VIEWS_DIRECTORY . 'new', $this->dataToView);
    }

    /**
     * Cria um novo carro no banco de dados.
     *
     * @return RedirectResponse
     */
    public function create(): RedirectResponse
    {
        // Verifica se o método HTTP é POST
        $this->allowedMethod('post');

        // Obtém as regras de validação
        $rules = (new CarsValidation)->getRules();

        // Valida os dados da requisição
        if (!$this->validate($rules)) {
            // Redireciona de volta com erros se a validação falhar
            return redirect()
                ->back()
                ->with('danger', 'Verifique os erros e tente novamente!')
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        // Obtém os dados validados
        $data = $this->validator->getValidated();
        $data['customer_id'] = new ObjectId($data['customer_id']);

        // Tenta criar um novo carro no banco de dados
        if (!$this->carModel->create(data: $data)) {
            // Redireciona de volta com erros se ocorrer um erro na criação
            return redirect()
                ->back()
                ->with('danger', 'Ocorreu um erro interno...')
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        // Redireciona de volta com mensagem de sucesso
        return redirect()->back()->with('success', 'Sucesso!');
    }

    /**
     * Exibe o formulário para editar um carro existente.
     *
     * @param string $id
     * @return string
     */
    public function edit(string $id): string
    {
        // Verifica se o método HTTP é GET
        $this->allowedMethod('get');

        // Busca o carro pelo ID
        $car = $this->carModel->findOrFail($id);

        // Configura os dados para a view
        $this->dataToView['title'] = 'Editar carro';
        $this->dataToView['customer_id'] = (string) $car['customer_id'];
        $this->dataToView['car'] = $car;

        // Retorna a view para editar o carro
        return view(self::VIEWS_DIRECTORY . 'edit', $this->dataToView);
    }

    /**
     * Atualiza os dados de um carro existente no banco de dados.
     *
     * @param string $car_id
     * @return RedirectResponse
     */
    public function update(string $car_id): RedirectResponse
    {
        // Verifica se o método HTTP é PUT
        $this->allowedMethod('put');

        // Obtém as regras de validação
        $rules = (new CarsValidation)->getRules();

        // Valida os dados da requisição
        if (!$this->validate($rules)) {
            // Redireciona de volta com erros se a validação falhar
            return redirect()
                ->back()
                ->with('danger', 'Verifique os erros e tente novamente!')
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        // Obtém os dados validados
        $data = $this->validator->getValidated();
        $customer_id = (string) $data['customer_id'];

        // Remove o campo 'customer_id' dos dados a serem atualizados
        unset($data['customer_id']);

        // Tenta atualizar o carro no banco de dados
        if (!$this->carModel->update(id: $car_id, data: $data)) {
            // Redireciona de volta com erros se ocorrer um erro na atualização
            return redirect()
                ->back()
                ->with('danger', 'Ocorreu um erro interno...')
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        // Redireciona para a rota 'customers.cars' com mensagem de sucesso
        return redirect()->route('customers.cars', [$customer_id])->with('success', 'Sucesso!');
    }

    /**
     * Deleta um carro existente no banco de dados.
     *
     * @param string $id
     * @return RedirectResponse
     */
    public function delete(string $id): RedirectResponse
    {
        // Verifica se o método HTTP é DELETE
        $this->allowedMethod('delete');

        // Tenta deletar o carro no banco de dados
        if (!$this->carModel->delete(id: $id)) {
            // Redireciona de volta com erros se ocorrer um erro na deleção
            return redirect()
                ->back()
                ->with('danger', 'Ocorreu um erro interno...')
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        // Redireciona de volta com mensagem de sucesso
        return redirect()->back()->with('success', 'Deletada com sucesso!');
    }
}
