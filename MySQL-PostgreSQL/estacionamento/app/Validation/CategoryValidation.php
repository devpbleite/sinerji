<?php

namespace App\Validation;

/**
 * Classe de validação para as categorias.
 */
class CategoryValidation
{
    /**
     * Retorna as regras de validação para os campos de categoria.
     * 
     * @return array Regras de validação para os campos de categoria.
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

            'price_hour' => [
                'label' => 'Preço por hora',
                'rules' => 'required|is_natural_no_zero',
                'errors' => [
                    'required' => 'O campo :label é obrigatório.',
                    'is_natural_no_zero' => 'Informe um valor maior que zero para o campo :label.',
                ]
            ],

            'price_day' => [
                'label' => 'Preço por dia',
                'rules' => 'required|is_natural_no_zero',
                'errors' => [
                    'required' => 'O campo :label é obrigatório.',
                    'is_natural_no_zero' => 'Informe um valor maior que zero para o campo :label.',
                ]
            ],

            'price_month' => [
                'label' => 'Preço por mês',
                'rules' => 'required|is_natural_no_zero',
                'errors' => [
                    'required' => 'O campo :label é obrigatório.',
                    'is_natural_no_zero' => 'Informe um valor maior que zero para o campo :label.',
                ]
            ],

            'spots' => [
                'label' => 'Número de vagas',
                'rules' => 'required|is_natural_no_zero',
                'errors' => [
                    'required' => 'O campo :label é obrigatório.',
                    'is_natural_no_zero' => 'Informe um valor maior que zero para o campo :label.',
                ]
            ],
        ];
    }
}
