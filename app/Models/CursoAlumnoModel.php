<?php

namespace App\Models;

use CodeIgniter\Model;

class CursoAlumnoModel extends Model
{
  protected $table = 'cursos_alumnos';
  protected $primaryKey = 'id_registro, id_curso, id_alumno';
  protected $returnType = 'array';
  protected $allowedFields = ['id_alumno', 'nombre_alumno', 'id_curso', 'nombre_curso'];

  protected $useTimestamps = false;
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
}
