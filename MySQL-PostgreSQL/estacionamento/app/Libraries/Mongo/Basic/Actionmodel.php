<?php

declare(strict_types=1);

namespace App\Libraries\Mongo\Basic;

use CodeIgniter\Exceptions\PageNotFoundException;
use MongoDB\BSON\ObjectId;
use MongoDB\Model\BSONDocument;

/**
 * Classe abstrata que fornece operações básicas de CRUD para modelos MongoDB.
 * Estende a classe ConnectorModel que lida com a conexão MongoDB.
 */
abstract class ActionModel extends ConnectorModel
{
    /**
     * Construtor da classe. Inicializa a coleção MongoDB.
     *
     * @param string $collectionName Nome da coleção MongoDB.
     */
    public function __construct(string $collectionName)
    {
        parent::__construct(collectionName: $collectionName);
    }

    /**
     * Cria um novo documento na coleção.
     *
     * @param array $data Dados do documento a ser inserido.
     * @return bool Retorna verdadeiro se a inserção foi bem-sucedida.
     */
    public function create(array $data): bool
    {
        try {
            $data = esc($data); // Escapa os dados para evitar injeção
            $result = $this->collection->insertOne($data);
            return $result->getInsertedCount() === 1;
        } catch (\Throwable $th) {
            log_message('error', "Erro ao inserir o registro no MongoDB: 
            {$th->getMessage()}");
            exit('Erro ao inserir o registro no MongoDB');
        }
    }

    /**
     * Recupera todos os documentos da coleção.
     *
     * @return array Retorna um array de documentos.
     */
    public function all(): array
    {
        try {
            $cursor = $this->collection->find([]);
            $documents = $cursor->toArray();

            return $documents;
        } catch (\Throwable $th) {
            log_message('error', "Erro ao recuperar os registros no MongoDB: 
            {$th->getMessage()}");
            exit('Erro ao recuperar registros no MongoDB');
        }
    }

    /**
     * Recupera um documento pelo seu ID ou lança uma exceção se não for encontrado.
     *
     * @param string $id ID do documento a ser recuperado.
     * @return BSONDocument Retorna o documento encontrado.
     * @throws PageNotFoundException Se o documento não for encontrado.
     */
    public function findOrFail(string $id): BSONDocument
    {
        try {
            $document = $this->collection->findOne(['_id' => new ObjectId($id)]);
            return $document ?? throw new PageNotFoundException("Registro não localizado id: {$id}");
        } catch (\Throwable $th) {
            log_message('error', "Erro ao recuperar o registro no MongoDB: 
            {$th->getMessage()}");
            exit('Erro ao recuperar registro no MongoDB');
        }
    }

    /**
     * Atualiza um documento na coleção.
     *
     * @param string $id ID do documento a ser atualizado.
     * @param array $data Dados a serem atualizados.
     * @return bool Retorna verdadeiro se a atualização foi bem-sucedida.
     */
    public function update(string $id, array $data): bool
    {
        try {
            $data = esc($data); // Escapa os dados para evitar injeção
            $result = $this->collection->updateOne(['_id' => new ObjectId($id)], ['$set' => $data]);
            return $result->getModifiedCount() ? true : false;
        } catch (\Throwable $th) {
            log_message('error', "Erro ao atualizar o registro no MongoDB: 
            {$th->getMessage()}");
            exit('Erro ao atualizar o registro no MongoDB');
        }
    }

    /**
     * Deleta um documento da coleção.
     *
     * @param string $id ID do documento a ser deletado.
     * @return bool Retorna verdadeiro se a deleção foi bem-sucedida.
     */
    public function delete(string $id): bool
    {
        try {
            $result = $this->collection->deleteOne(['_id' => new ObjectId($id)]);
            return $result->getDeletedCount() === 1;
        } catch (\Throwable $th) {
            log_message('error', "Erro ao deletar o registro no MongoDB: 
            {$th->getMessage()}");
            exit('Erro ao deletar o registro no MongoDB');
        }
    }
}
