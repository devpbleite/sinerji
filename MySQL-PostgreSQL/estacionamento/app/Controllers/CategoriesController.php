<?php

namespace App\Controllers;

use App\Libraries\Mongo\CategoryModel;
use App\Validation\CategoryValidation;
use CodeIgniter\HTTP\RedirectResponse;

class CategoriesController extends BaseController
{
    // Diretório de visualizações para o controller.
    private const VIEWS_DIRECTORY = 'Categories/';

    // Instância do modelo de categoria.
    private CategoryModel $categoryModel;

    // Construtor que inicializa o modelo de categoria.
    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    // Método para exibir a lista de categorias.
    public function index(): string
    {
        $this->allowedMethod('get');
        $this->dataToView['title'] = 'Gerenciar categorias';
        $this->dataToView['categories'] = $this->categoryModel->all();
        return view(self::VIEWS_DIRECTORY . 'index', $this->dataToView);
    }

    // Método para exibir o formulário de criação de uma nova categoria.
    public function new(): string
    {
        $this->allowedMethod('get');
        $this->dataToView['title'] = 'Nova Categoria';
        return view(self::VIEWS_DIRECTORY . 'new', $this->dataToView);
    }

    // Método para exibir o formulário de edição de uma categoria existente.
    public function edit(string $id): string
    {
        $this->allowedMethod('get');
        $category = $this->categoryModel->findOrFail($id);
        $this->dataToView['title'] = 'Editar Categoria';
        $this->dataToView['category'] = $category;
        return view(self::VIEWS_DIRECTORY . 'edit', $this->dataToView);
    }

    // Método para criar uma nova categoria.
    public function create(): RedirectResponse
    {
        $this->allowedMethod('post');
        $rules = (new CategoryValidation)->getRules();

        // Valida os dados do formulário.
        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->with('danger', 'Verifique os erros e tente novamente!')
                ->withInput();
        }

        // Prepara os dados validados para inserção no banco de dados(MongoDB).
        $data = $this->prepareData();

        // Tenta criar a nova categoria no banco de dados.
        if (!$this->categoryModel->create($data)) {
            return redirect()
                ->back()
                ->with('danger', 'Ocorreu um erro interno...')
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        return redirect()->route('categories')->with('success', 'Criada com sucesso!');
    }

    // Método para atualizar uma categoria existente.
    public function update(string $id): RedirectResponse
    {
        $this->allowedMethod('put');
        $rules = (new CategoryValidation)->getRules();

        // Valida os dados do formulário.
        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->with('danger', 'Verifique os erros e tente novamente!')
                ->withInput();
        }

        // Prepara os dados validados para atualização no banco de dados(MongoDB).
        $data = $this->prepareData();

        // Tenta atualizar a categoria no banco de dados.
        if (!$this->categoryModel->update(id: $id, data: $data)) {
            return redirect()
                ->back()
                ->with('danger', 'Ocorreu um erro interno...')
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        return redirect()->route('categories')->with('success', 'Atualizada com sucesso!');
    }

    // Método para deletar uma categoria existente.
    public function delete(string $id): RedirectResponse
    {
        $this->allowedMethod('delete');

        // Tenta deletar a categoria no banco de dados.
        if (!$this->categoryModel->delete(id: $id)) {
            return redirect()
                ->back()
                ->with('danger', 'Ocorreu um erro interno...')
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        return redirect()->route('categories')->with('success', 'Deletada com sucesso!');
    }

    // Método privado para preparar os dados validados para 
    // inserção/atualização no banco de dados.
    private function prepareData(): array
    {
        $data = esc($this->validator->getValidated());
        return [
            'name' => $data['name'],
            'spots' => intval($data['spots']),
            'price_hour' => intval($data['price_hour']),
            'price_day' => intval($data['price_day']),
            'price_month' => intval($data['price_month']),
        ];
    }
}
