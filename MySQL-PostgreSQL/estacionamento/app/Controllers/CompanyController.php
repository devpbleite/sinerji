<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CompanyModel;
use App\Validation\CompanyValidation;
use CodeIgniter\HTTP\RedirectResponse;

class CompanyController extends BaseController
{
    // Instância do modelo de empresa
    private CompanyModel $companyModel;

    public function __construct()
    {
        // Inicializa o modelo de empresa
        $this->companyModel = model(CompanyModel::class);
    }

    /**
     * Exibe a página de gerenciamento das informações da empresa.
     *
     * @return string
     */
    public function index(): string
    {
        // Define o título da página
        $this->dataToView['title'] = 'Gerenciar informações da empresa';

        // Retorna a view para gerenciar as informações da empresa
        return view('Company/index', $this->dataToView);
    }

    /**
     * Processa o formulário para atualizar as informações da empresa.
     *
     * @return RedirectResponse
     */
    public function process(): RedirectResponse
    {
        // Obtém as regras de validação
        $rules = (new CompanyValidation)->getRules();

        // Valida os dados da requisição
        if (!$this->validate($rules)) {
            // Redireciona de volta com erros se a validação falhar
            return redirect()
                ->back()
                ->with('danger', 'Verifique os erros e tente novamente!')
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        // Obtém as informações da empresa
        $company = $this->companyModel->getCompany();

        // Preenche a entidade da empresa com os dados validados
        $company->fill($this->validator->getValidated());

        // Verifica se houve alterações nas informações da empresa
        if ($company->hasChanged()) {
            // Salva as alterações no banco de dados
            $this->companyModel->save($company);
        }

        // Redireciona de volta com mensagem de sucesso
        return redirect()
            ->back()
            ->with('success', 'Sucesso!')
            ->with('errors', $this->validator->getErrors())
            ->withInput();
    }
}
