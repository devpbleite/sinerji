<?php

declare(strict_types=1);

namespace App\Libraries\Mongo;

use App\Libraries\Mongo\Basic\ActionModel;
use MongoDB\BSON\ObjectId;

class CarModel extends ActionModel
{
    // Construtor que inicializa a conexão com a coleção 'cars'.
    public function __construct()
    {
        parent::__construct(collectionName: 'cars');
    }

    // Método para recuperar todos os carros por ID de cliente.
    public function allByCustomerId(string $customer_id): array
    {
        try {
            // Define o filtro para buscar carros pelo ID do cliente.
            $filter = ['customer_id' => new ObjectId($customer_id)];
            // Busca os documentos na coleção com base no filtro.
            $cursor =  $this->collection->find($filter);
            // Converte o cursor em um array de documentos.
            $documents = $cursor->toArray();
            return $documents;
        } catch (\Throwable $th) {
            // Loga a mensagem de erro e termina a execução em caso de falha.
            log_message('error', "Erro ao recuperar registros no mongoDB {$th->getMessage()}");
            exit('Internal Server Error');
        }
    }
}
