<?php

namespace App\Models;

use CodeIgniter\Model;

class CursoModel extends Model
{
  protected $table = 'cursos';
  protected $primaryKey = 'id_curso';
  protected $returnType = 'array';
  protected $allowedFields = ['nombre_curso', 'descripcion', 'hora_inicio', 'hora_fin', 'imagen'];

  protected $useTimestamps = false;
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
}
