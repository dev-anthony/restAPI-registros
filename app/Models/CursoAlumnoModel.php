<?php

namespace App\Models;

use CodeIgniter\Model;

class CursoAlumnoModel extends Model
{
  protected $table = 'v_cursos_alumnos';
  protected $primaryKey = 'id_curso';
  protected $returnType = 'array';
  protected $allowedFields = ['alumno_id', 'curso_id'];

  protected $useTimestamps = false;
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';

  public function v_cursos_alumnos ()
  {
    $view = $this->db->table('v_cursos_alumnos')->get()->getResultArray();

    return $view;
  }
}
