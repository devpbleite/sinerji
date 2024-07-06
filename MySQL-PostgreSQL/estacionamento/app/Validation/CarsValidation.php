<?php

namespace App\Validation;

/**
 * Classe de validação para os dados de veículos (cars).
 */
class CarsValidation
{
    /**
     * Retorna as regras de validação para os campos de veículo.
     * 
     * @return array Regras de validação para os campos de veículo.
     */
    public function getRules(): array
    {
        return [
            'plate' => [
                'label' => 'Placa',
                'rules' => 'required|max_length[128]',
                'errors' => [
                    'required' => 'O campo :label é obrigatório.',
                    'max_length' => 'O campo :label deve conter no máximo 128 caracteres.',
                ]
            ],
            'vehicle' => [
                'label' => 'Descrição do veículo',
                'rules' => 'required|max_length[128]',
                'errors' => [
                    'required' => 'O campo :label é obrigatório.',
                    'max_length' => 'O campo :label deve conter no máximo 128 caracteres.',
                ]
            ],
            'customer_id' => [
                'label' => 'Cliente',
                'rules' => 'required',
                'errors' => [
                    'required' => 'O campo :label é obrigatório.',
                ]
            ],
        ];
    }
}
