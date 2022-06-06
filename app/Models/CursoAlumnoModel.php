<?php

namespace App\Models;

use CodeIgniter\Model;

class CursoAlumnoModel extends Model
{
  protected $table = 'v_cursos_alumnos';
  // protected $primaryKey = '';
  protected $returnType = 'array';
  protected $allowedFields = ['nombre_alumno', 'apellido_p', 'apellido_m', 'nombre_curso'];

  protected $useTimestamps = false;
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
}
