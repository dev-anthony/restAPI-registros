<?php namespace App\Models;

use CodeIgniter\Model;

class RolModel extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'id_rol';
    protected $returnType = 'array';
    protected $allowedFields = ['tipo_rol'];

    // Control de fechas de auditacion
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

}
