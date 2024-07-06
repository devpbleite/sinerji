<?php

declare(strict_types=1);

namespace App\Libraries\Mongo;

use App\Libraries\Mongo\Basic\ActionModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use MongoDB\BSON\ObjectId;
use MongoDB\Model\BSONDocument;

class CustomerModel extends ActionModel
{
    // Construtor que inicializa a conexão com a coleção 'customers'.
    public function __construct()
    {
        parent::__construct(collectionName: 'customers');
    }
    /**
     * Método para recuperar todos os documentos da coleção 'customers'.
     * Sobrescreve o do Actionmodel. 
     * 
     * */
    public function all(): array
    {

        try {
            // Define o pipeline de agregação.
            $pipeline = $this->setAggregation();
            // Executa a agregação na coleção.
            $cursor = $this->collection->aggregate($pipeline);
            // Converte o cursor em um array de documentos.
            $documents = $cursor->toArray();

            return $documents;
        } catch (\Throwable $th) {
            // Loga a mensagem de erro e termina a execução em caso de falha.
            log_message('error', "Erro ao recuperarzxc os registros no MongoDB: 
            {$th->getMessage()}");
            exit('Erro ao recuperar registrosdsa de no MongoDB');
        }
    }
    // Método para encontrar um documento pelo ID ou lançar uma exceção se não for encontrado.
    public function findOrFail(string $id): BSONDocument
    {
        try {
            // Define o pipeline de agregação.
            $pipeline = $this->setAggregation();
            // Adiciona uma etapa de correspondência para encontrar o documento pelo ID.
            $pipeline[] = ['$match' => ['_id' => new ObjectId($id)]];
            // Executa a agregação na coleção e converte o resultado em um array.
            $document = $this->collection->aggregate($pipeline)->toArray();

            // Retorna o primeiro documento encontrado ou lança uma exceção se não for encontrado.
            return $document[0] ?? throw new PageNotFoundException("Registro não localizado id: {$id}");
        } catch (\Throwable $th) {
            // Loga a mensagem de erro e termina a execução em caso de falha.
            log_message('error', "Erro ao recuperar o registro no MongoDB: 
            {$th->getMessage()}");
            exit('Erro ao recuperar registro de no MongoDB');
        }
    }
    // Método privado para definir o pipeline de agregação.
    private function setAggregation(): array
    {
        // Pipeline de agregação que faz uma junção (lookup) com a coleção 'cars'.
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
