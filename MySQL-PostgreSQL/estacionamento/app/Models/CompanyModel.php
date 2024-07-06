<?php

namespace App\Models;

use App\Entities\Company;
use CodeIgniter\Model;

/**
 * Modelo para interação com a tabela 'information' relacionada à empresa.
 */
class CompanyModel extends Model
{
    protected $DBGroup = 'company';

    protected $table            = 'information';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = Company::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'phone',
        'address',
        'message',
    ];
    protected bool $allowEmptyInserts = false;

    /**
     * Retorna a primeira empresa encontrada na tabela 'information'.
     * Se não houver registros, retorna uma nova instância de Company vazia.
     * 
     * @return Company Instância de Company encontrada ou uma nova instância vazia.
     */
    public function getCompany(): Company
    {
        return $this->first() ?? new Company();
    }
}
