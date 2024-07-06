<?php

namespace App\Controllers;

use App\Libraries\Mongo\CategoryModel;
use App\Validation\CategoryValidation;
use CodeIgniter\HTTP\RedirectResponse;

class CategoriesController extends BaseController
{
    // Diretório das views relacionadas às categorias
    private const VIEWS_DIRECTORY = 'Categories/';

    // Modelo de categoria
    private CategoryModel $categoryModel;

    public function __construct()
    {
        // Inicializa o modelo de categoria
        $this->categoryModel = new CategoryModel();
    }

    /**
     * Exibe a lista de todas as categorias.
     *
     * @return string
     */
    public function index(): string
    {
        // Verifica se o método HTTP é GET
        $this->allowedMethod('get');

        // Configura os dados para a view
        $this->dataToView['title'] = 'Gerenciar categorias';
        $this->dataToView['categories'] = $this->categoryModel->all();

        // Retorna a view com a lista de categorias
        return view(self::VIEWS_DIRECTORY . 'index', $this->dataToView);
    }

    /**
     * Exibe o formulário para criar uma nova categoria.
     *
     * @return string
     */
    public function new(): string
    {
        // Verifica se o método HTTP é GET
        $this->allowedMethod('get');

        // Configura os dados para a view
        $this->dataToView['title'] = 'Nova Categoria';

        // Retorna a view para criar uma nova categoria
        return view(self::VIEWS_DIRECTORY . 'new', $this->dataToView);
    }

    /**
     * Exibe o formulário para editar uma categoria existente.
     *
     * @param string $id
     * @return string
     */
    public function edit(string $id): string
    {
        // Verifica se o método HTTP é GET
        $this->allowedMethod('get');

        // Busca a categoria pelo ID
        $category = $this->categoryModel->findOrFail($id);

        // Configura os dados para a view
        $this->dataToView['title'] = 'Editar Categoria';
        $this->dataToView['category'] = $category;

        // Retorna a view para editar a categoria
        return view(self::VIEWS_DIRECTORY . 'edit', $this->dataToView);
    }

    /**
     * Cria uma nova categoria no banco de dados.
     *
     * @return RedirectResponse
     */
    public function create(): RedirectResponse
    {
        // Verifica se o método HTTP é POST
        $this->allowedMethod('post');

        // Obtém as regras de validação
        $rules = (new CategoryValidation)->getRules();

        // Valida os dados da requisição
        if (!$this->validate($rules)) {
            // Redireciona de volta com erros se a validação falhar
            return redirect()
                ->back()
                ->with('danger', 'Verifique os erros e tente novamente!')
                ->withInput();
        }

        // Prepara os dados para inserção
        $data = $this->prepareData();

        // Tenta criar uma nova categoria no banco de dados
        if (!$this->categoryModel->create($data)) {
            // Redireciona de volta com erros se ocorrer um erro na criação
            return redirect()
                ->back()
                ->with('danger', 'Ocorreu um erro interno...')
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        // Redireciona para a rota 'categories' com mensagem de sucesso
        return redirect()->route('categories')->with('success', 'Criada com sucesso!');
    }

    /**
     * Atualiza os dados de uma categoria existente no banco de dados.
     *
     * @param string $id
     * @return RedirectResponse
     */
    public function update(string $id): RedirectResponse
    {
        // Verifica se o método HTTP é PUT
        $this->allowedMethod('put');

        // Obtém as regras de validação
        $rules = (new CategoryValidation)->getRules();

        // Valida os dados da requisição
        if (!$this->validate($rules)) {
            // Redireciona de volta com erros se a validação falhar
            return redirect()
                ->back()
                ->with('danger', 'Verifique os erros e tente novamente!')
                ->withInput();
        }

        // Prepara os dados para atualização
        $data = $this->prepareData();

        // Tenta atualizar a categoria no banco de dados
        if (!$this->categoryModel->update(id: $id, data: $data)) {
            // Redireciona de volta com erros se ocorrer um erro na atualização
            return redirect()
                ->back()
                ->with('danger', 'Ocorreu um erro interno...')
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        // Redireciona para a rota 'categories' com mensagem de sucesso
        return redirect()->route('categories')->with('success', 'Atualizada com sucesso!');
    }

    /**
     * Deleta uma categoria existente no banco de dados.
     *
     * @param string $id
     * @return RedirectResponse
     */
    public function delete(string $id): RedirectResponse
    {
        // Verifica se o método HTTP é DELETE
        $this->allowedMethod('delete');

        // Tenta deletar a categoria no banco de dados
        if (!$this->categoryModel->delete(id: $id)) {
            // Redireciona de volta com erros se ocorrer um erro na deleção
            return redirect()
                ->back()
                ->with('danger', 'Ocorreu um erro interno...')
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        // Redireciona para a rota 'categories' com mensagem de sucesso
        return redirect()->route('categories')->with('success', 'Deletada com sucesso!');
    }

    /**
     * Prepara os dados para inserção ou atualização no banco de dados.
     *
     * @return array
     */
    private function prepareData(): array
    {
        // Escapa e valida os dados
        $data = esc($this->validator->getValidated());

        // Prepara os dados para serem salvos no banco de dados
        return [
            'name' => $data['name'],
            'spots' => intval($data['spots']),
            'price_hour' => intval($data['price_hour']),
            'price_day' => intval($data['price_day']),
            'price_month' => intval($data['price_month']),
        ];
    }
}
