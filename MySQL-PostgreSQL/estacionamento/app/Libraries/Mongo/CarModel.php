<?php

declare(strict_types=1);

namespace App\Libraries\Mongo;

use App\Libraries\Mongo\Basic\ActionModel;
use MongoDB\BSON\ObjectId;

/**
 * Modelo para interação com a coleção 'cars' no MongoDB, estendendo ActionModel.
 */
class CarModel extends ActionModel
{
    /**
     * Construtor da classe. Chama o construtor da classe pai (ActionModel) com o nome da coleção 'cars'.
     */
    public function __construct()
    {
        parent::__construct(collectionName: 'cars');
    }

    /**
     * Obtém todos os carros associados a um cliente específico.
     *
     * @param string $customer_id ID do cliente no formato ObjectId do MongoDB.
     * @return array Array de documentos BSON representando os carros do cliente.
     */
    public function allByCustomerId(string $customer_id): array
    {
        try {
            $filter = ['customer_id' => new ObjectId($customer_id)]; // Filtra por ID do cliente convertido para ObjectId
            $cursor =  $this->collection->find($filter); // Executa a consulta na coleção 'cars'
            $documents = $cursor->toArray(); // Converte os documentos BSON retornados em um array PHP
            return $documents; // Retorna o array de documentos encontrados
        } catch (\Throwable $th) {
            log_message('error', "Erro ao recuperar registros no MongoDB: {$th->getMessage()}");
            exit('Internal Server Error'); // Encerra a execução em caso de erro, registrando no log
        }
    }
}
