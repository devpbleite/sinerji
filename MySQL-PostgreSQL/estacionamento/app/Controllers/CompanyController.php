<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CompanyModel;
use App\Validation\CompanyValidation;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Model;

class CompanyController extends BaseController
{
    private CompanyModel $companyModel;

    public function __construct()
    {
        $this->companyModel = model(CompanyModel::class);
    }

    public function index(): string
    {
        // Define o título da página de gerência da compania.
        $this->dataToView['title'] = 'Gerenciar informações da empresa';

        return view('Company/index', $this->dataToView);
    }

    public function process(): RedirectResponse
    {
        # Define o validator dos campos do formulário.
        $rules = (new CompanyValidation)->getRules();

        # Verifica a validação.
        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->with('danger', 'Verifique os erros e tente novamente!')
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }
        # Recupera o objeto da empresa.
        $company = $this->companyModel->getCompany();

        # Irá popular os dados em $company com os valores recebidos no argumento.
        $company->fill($this->validator->getValidated());

        # Verifica se houve uma mudança com relação ao estado inicial de $company.
        if ($company->hasChanged()) {

            # Este save serve tanto para cadastrar quanto para update(No PostgreSQL). 
            $this->companyModel->save($company);
        }
        return redirect()
            ->back()
            ->with('success', 'Sucesso!')
            ->with('errors', $this->validator->getErrors())
            ->withInput();
    }
}
