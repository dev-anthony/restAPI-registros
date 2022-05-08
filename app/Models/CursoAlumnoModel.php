<?php

namespace App\Models;

use CodeIgniter\Model;

class CursoAlumnoModel extends Model
{
  protected $table = 'cursos_alumnos';
  protected $primaryKey = 'id_registro';
  protected $returnType = 'array';
  protected $allowedFields = ['curso_id', 'alumno_id'];

  protected $useTimestamps = false;
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
}
