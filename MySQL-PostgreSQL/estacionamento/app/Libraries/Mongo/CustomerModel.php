<?php

declare(strict_types=1);

namespace App\Libraries\Mongo;

use App\Libraries\Mongo\Basic\ActionModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use MongoDB\BSON\ObjectId;
use MongoDB\Model\BSONDocument;

/**
 * Modelo para interação com a coleção 'customers' no MongoDB, estendendo ActionModel.
 */
class CustomerModel extends ActionModel
{
    /**
     * Construtor da classe. Chama o construtor da classe pai (ActionModel) com o nome da coleção 'customers'.
     */
    public function __construct()
    {
        parent::__construct(collectionName: 'customers');
    }

    /**
     * Retorna todos os documentos da coleção 'customers' com informações agregadas de 'cars'.
     * Utiliza pipeline de agregação para realizar o lookup com a coleção 'cars'.
     * 
     * @return array Array contendo os documentos encontrados.
     */
    public function all(): array
    {
        try {
            $pipeline = $this->setAggregation();
            $cursor = $this->collection->aggregate($pipeline);
            $documents = $cursor->toArray();

            return $documents;
        } catch (\Throwable $th) {
            log_message('error', "Erro ao recuperar registros no MongoDB: {$th->getMessage()}");
            exit('Erro ao recuperar registros no MongoDB');
        }
    }

    /**
     * Busca um documento na coleção 'customers' pelo ID especificado, com informações agregadas de 'cars'.
     * Utiliza pipeline de agregação para realizar o lookup com a coleção 'cars'.
     * Lança uma exceção PageNotFoundException se o documento não for encontrado.
     * 
     * @param string $id ID do documento a ser buscado.
     * @return BSONDocument Documento encontrado.
     * @throws PageNotFoundException Se o documento não for encontrado.
     */
    public function findOrFail(string $id): BSONDocument
    {
        try {
            $pipeline = $this->setAggregation();
            $pipeline[] = ['$match' => ['_id' => new ObjectId($id)]];
            $document = $this->collection->aggregate($pipeline)->toArray();

            return $document[0] ?? throw new PageNotFoundException("Registro não localizado id: {$id}");
        } catch (\Throwable $th) {
            log_message('error', "Erro ao recuperar o registro no MongoDB: {$th->getMessage()}");
            exit('Erro ao recuperar registro no MongoDB');
        }
    }

    /**
     * Define o pipeline de agregação para realizar lookup com a coleção 'cars'.
     * 
     * @return array Pipeline de agregação configurado.
     */
    private function setAggregation(): array
    {
        $pipeline = [];
        $pipeline[] = [
            '$lookup' => [
                'from' => 'cars',
                'localField' => '_id',
                'foreignField' => 'customer_id',
                'as' => 'cars'
            ],
        ];
        return $pipeline;
    }
}
