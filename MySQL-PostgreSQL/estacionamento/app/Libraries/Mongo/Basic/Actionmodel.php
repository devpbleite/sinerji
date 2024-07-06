<?php

declare(strict_types=1);

namespace App\Libraries\Mongo\Basic;

use CodeIgniter\Exceptions\PageNotFoundException;
use MongoDB\BSON\ObjectId;
use MongoDB\Model\BSONDocument;

abstract class ActionModel extends ConnectorModel
{
    // Construtor que inicializa a conexão com a coleção MongoDB especificada.
    public function __construct(string $collectionName)
    {
        parent::__construct(collectionName: $collectionName);
    }

    // Método para criar um novo documento na coleção MongoDB.
    public function create(array $data): bool
    {
        try {
            // Escapa os dados antes de inserir.
            $data = esc($data);
            // Insere o documento na coleção.
            $result = $this->collection->insertOne($data);
            // Retorna true se a inserção foi bem sucedida.
            return $result->getInsertedCount() === 1;
        } catch (\Throwable $th) {
            // Loga a mensagem de erro e termina a execução em caso de falha.
            log_message('error', "Erro ao inserir o registro no MongoDB: 
            {$th->getMessage()}");
            exit('Erro ao inserir o registro no MongoDB');
        }
    }
    // Método para recuperar todos os documentos da coleção MongoDB.
    public function all(): array
    {
        try {
            // Busca todos os documentos na coleção.
            $cursor = $this->collection->find([]);
            // Converte o cursor em um array de documentos.
            $documents = $cursor->toArray();

            return $documents;
        } catch (\Throwable $th) {
            // Loga a mensagem de erro e termina a execução em caso de falha.
            log_message('error', "Erro ao recuperar os registros no MongoDB: 
            {$th->getMessage()}");
            exit('Erro ao recuperar registros de no MongoDB');
        }
    }
    // Método para encontrar um documento pelo ID ou lançar uma exceção se não for encontrado.
    public function findOrFail(string $id): BSONDocument
    {
        try {
            // Busca o documento na coleção pelo ID
            $document = $this->collection->findOne(['_id' => new ObjectId($id)]);
            // Retorna o documento encontrado ou lança uma exceção se não for encontrado.
            return $document ?? throw new PageNotFoundException("Registro não localizado id: {$id}");
        } catch (\Throwable $th) {
            // Loga a mensagem de erro e termina a execução em caso de falha.
            log_message('error', "Erro ao recuperar o registro no MongoDB: 
            {$th->getMessage()}");
            exit('Erro ao recuperar registro de no MongoDB');
        }
    }
    // Método para atualizar um documento na coleção MongoDB pelo ID.
    public function update(string $id, array $data): bool
    {
        try {
            // Escapa os dados antes de atualizar.
            $data = esc($data);
            // Atualiza o documento na coleção.
            $result = $this->collection->updateOne(['_id' => new ObjectId($id)], ['$set' => $data]);
            // Retorna true se a atualização foi bem sucedida.
            return $result->getModifiedCount() ? true : false;
        } catch (\Throwable $th) {
            // Loga a mensagem de erro e termina a execução em caso de falha.
            log_message('error', "Erro ao atualizar o registro no MongoDB: 
            {$th->getMessage()}");
            exit('Erro ao atualizar o registro no MongoDB');
        }
    }
    // Método para deletar um documento na coleção MongoDB pelo ID.
    public function delete(string $id): bool
    {
        try {
            // Deleta o documento na coleção pelo ID.
            $result = $this->collection->deleteOne(['_id' => new ObjectId($id)]);
            // Retorna true se a deleção foi bem sucedida.
            return $result->getDeletedCount() === 1;
        } catch (\Throwable $th) {
            // Loga a mensagem de erro e termina a execução em caso de falha.
            log_message('error', "Erro ao deletar o registro no MongoDB: 
            {$th->getMessage()}");
            exit('Erro ao deletar o registro no MongoDB');
        }
    }
}
