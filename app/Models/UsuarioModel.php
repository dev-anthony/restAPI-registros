<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
  protected $table = 'usuarios';
  protected $primaryKey = 'id_usuario';
  protected $returnType = 'array';
  protected $allowedFields = ['name', 'username', 'password', 'rol_id'];

  // Control de fechas de auditacion
  protected $useTimestamps = false;
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
}
