<?php

declare(strict_types=1);

namespace App\Libraries\Mongo\Basic;

use Exception;
use MongoDB\Client;

/**
 * Classe abstrata que fornece uma conexão básica com o MongoDB.
 */
abstract class ConnectorModel
{
    protected $collection; // Atributo protegido para armazenar a coleção MongoDB

    /**
     * Construtor da classe. Inicializa a conexão com o MongoDB e seleciona a coleção especificada.
     *
     * @param string $collectionName Nome da coleção MongoDB a ser utilizada.
     */
    public function __construct(string $collectionName)
    {
        $uri = env('MONGO_URI'); // Obtém a URI do MongoDB do arquivo .env
        $database = env('MONGO_DATABASE'); // Obtém o nome do banco de dados do MongoDB do arquivo .env

        try {
            // Verifica se a URI e o nome do banco de dados estão definidos
            if (empty($uri) || empty($database)) {
                throw new Exception('Por favor defina os dados de acesso no arquivo .env');
            }

            // Cria um novo cliente MongoDB com a URI fornecida
            $client = new Client($uri);

            // Seleciona a coleção no banco de dados especificado
            $this->collection = $client->$database->$collectionName;
        } catch (\Throwable $th) {
            // Em caso de erro ao conectar ou selecionar a coleção, registra o erro e encerra a execução
            log_message('error', "Erro ao se conectar com o MongoDB: {$th->getMessage()}");
            exit('Internal Server Error');
        }
    }
}
