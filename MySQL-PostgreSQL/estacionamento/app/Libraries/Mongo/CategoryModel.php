<?php

declare(strict_types=1);

namespace App\Libraries\Mongo;

use App\Libraries\Mongo\Basic\ActionModel;

class CategoryModel extends ActionModel
{   
    // Construtor que inicializa a conexão com a coleção 'categories'.
    public function __construct()
    {
        parent::__construct(collectionName: 'categories');
    }
}
