<?php

namespace App\Validation;

/**
 * Classe de validação para os dados do cliente.
 */
class CustomerValidation
{
    /**
     * Retorna as regras de validação para os campos de dados do cliente.
     * 
     * @return array Regras de validação para os campos de dados do cliente.
     */
    public function getRules(): array
    {
        return [
            'name' => [
                'label' => 'Nome',
                'rules' => 'required|max_length[128]',
                'errors' => [
                    'required' => 'O campo :label é obrigatório.',
                    'max_length' => 'O campo :label deve conter no máximo 128 caracteres.',
                ]
            ],

            'cpf' => [
                'label' => 'CPF',
                'rules' => 'required|exact_length[14]',
                'errors' => [
                    'required' => 'O campo :label é obrigatório.',
                    'exact_length' => 'O campo :label deve conter exatamente 14 caracteres.',
                ]
            ],

            'email' => [
                'label' => 'E-mail',
                'rules' => 'required|max_length[128]',
                'errors' => [
                    'required' => 'O campo :label é obrigatório.',
                    'max_length' => 'O campo :label deve conter no máximo 128 caracteres.',
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
        ];
    }
}
