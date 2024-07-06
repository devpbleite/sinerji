<?php

namespace App\Models;

use App\Entities\Company;
use CodeIgniter\Model;

class CompanyModel extends Model
{
    protected $DBGroup = 'company';

    protected $table            = 'information'; // Nome da tabela
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = Company::class; // Tipo do retorno
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'phone',
        'address',
        'message',
    ];
    // Permite ou não inserções com todos os campos vazios
    protected bool $allowEmptyInserts = false;

    /**
     * Método para obter a primeira empresa da
     * tabela ou uma nova instância de Company.
     */
    public function getCompany(): Company
    {
        return $this->first() ?? new Company();
    }
}
