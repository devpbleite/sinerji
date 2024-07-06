<?php

namespace App\Validation;

class CompanyValidation
{
    public function getRules(): array
    {
        return [
            'name' => [
                'label' => 'Nome',
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required' => 'Obrigatório!',
                    'max_length' => 'Informe no máximo 100 caracteres',
                ]
            ],
            'phone' => [
                'label' => 'Telefone',
                'rules' => 'required|max_length[20]',
                'errors' => [
                    'required' => 'Obrigatório!',
                    'max_length' => 'Informe no máximo 20 caracteres',
                ]
            ],
            'address' => [
                'label' => 'Endereço',
                'rules' => 'required|max_length[128]',
                'errors' => [
                    'required' => 'Obrigatório!',
                    'max_length' => 'Informe no máximo 128 caracteres',
                ]
            ],
            'message' => [
                'label' => 'Mensagem',
                'rules' => 'required|max_length[2000]',
                'errors' => [
                    'required' => 'Obrigatório!',
                    'max_length' => 'Informe no máximo 2000 caracteres',
                ]
            ],
        ];
    }
}
