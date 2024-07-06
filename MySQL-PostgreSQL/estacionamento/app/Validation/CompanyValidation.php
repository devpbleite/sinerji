<?php

namespace App\Validation;

/**
 * Classe de validação para os dados da empresa.
 */
class CompanyValidation
{
    /**
     * Retorna as regras de validação para os campos de dados da empresa.
     * 
     * @return array Regras de validação para os campos de dados da empresa.
     */
    public function getRules(): array
    {
        return [
            'name' => [
                'label' => 'Nome',
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'O campo :label é obrigatório.',
                    'max_length' => 'O campo :label deve conter no máximo 100 caracteres.',
                ]
            ],
            'phone' => [
                'label' => 'Telefone',
                'rules' => 'required|max_length[20]',
                'errors' => [
                    'required' => 'O campo :label é obrigatório.',
                    'max_length' => 'O campo :label deve conter no máximo 20 caracteres.',
                ]
            ],
            'address' => [
                'label' => 'Endereço',
                'rules' => 'required|max_length[128]',
                'errors' => [
                    'required' => 'O campo :label é obrigatório.',
                    'max_length' => 'O campo :label deve conter no máximo 128 caracteres.',
                ]
            ],
            'message' => [
                'label' => 'Mensagem',
                'rules' => 'required|max_length[2000]',
                'errors' => [
                    'required' => 'O campo :label é obrigatório.',
                    'max_length' => 'O campo :label deve conter no máximo 2000 caracteres.',
                ]
            ],
        ];
    }
}
