<?php

declare(strict_types=1);

namespace App\Libraries\Mongo;

use App\Libraries\Mongo\Basic\ActionModel;

/**
 * Modelo para interação com a coleção 'categories' no MongoDB, estendendo ActionModel.
 */
class CategoryModel extends ActionModel
{
    /**
     * Construtor da classe. Chama o construtor da classe pai (ActionModel) com o nome da coleção 'categories'.
     */
    public function __construct()
    {
        parent::__construct(collectionName: 'categories');
    }
}
