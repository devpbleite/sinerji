<?php

declare(strict_types=1);

namespace App\Libraries\Mongo\Basic;

use Exception;
use MongoDB\Client;

abstract class ConnectorModel
{
    // Propriedade que irá armazenar a coleção MongoDB
    protected $collection;

    public function __construct(string $collectionName)
    {
        // Obtém a URI do MongoDB do arquivo .env
        $uri = env('MONGO_URI');
        // Obtém o nome do banco de dados do arquivo .env
        $database = env('MONGO_DATABASE');

        try {

            // Verifica se a URI e o nome do banco de dados estão definidos
            if (empty($uri) || empty($database)) {
                throw new Exception('Por favor defina os dados de acesso no arquivo .env');
            }
            
            // Cria um novo cliente MongoDB com a URI fornecida
            $client = new Client($uri);

            // Atribui a coleção especificada à propriedade $collection
            $this->collection = $client->$database->$collectionName;
        } catch (\Throwable $th) {

            // Loga a mensagem de erro e termina a execução em caso de falha na conexão
            log_message('error', "Erro ao se conectar com o MongoDB: {$th->getMessage()}");
            exit('Internal Server Error');
        }
    }
}
