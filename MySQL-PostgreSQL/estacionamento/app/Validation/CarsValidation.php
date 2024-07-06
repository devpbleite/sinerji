<?php

namespace App\Validation;

class CarsValidation
{
    public function getRules(): array
    {
        return [
            'plate' => [
                'label' => 'Placa',
                'rules' => 'required|max_length[128]',
                'errors' => [
                    'required' => 'Obrigatório!',
                    'max_length' => 'Informe no máximo 128 caracteres',
                ]
            ],
            'vehicle' => [
                'label' => 'Descrição do veículo',
                'rules' => 'required|max_length[128]',
                'errors' => [
                    'required' => 'Obrigatório!',
                    'max_length' => 'Informe no máximo 128 caracteres',
                ]
            ],
            'customer_id' => [
                'label' => 'Cliente',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Obrigatório!',
                ]
            ],
        ];
    }
}
