<?php

namespace App\Models;

use CodeIgniter\Model;

class CursoAlumnoModel extends Model
{
  protected $table = 'cursos_alumnos';
  protected $primaryKey = 'id_alumno';
  protected $returnType = 'array';
  protected $allowedFields = ['id_alumno', 'id_curso'];


  /**
   * *esta es una vista y muestra en el frontend
   */
  public function v_cursos_alumnos ()
  {
    $view = $this->db->table('v_cursos_alumnos')->get()->getResultArray();
    return $view;
  }
}
