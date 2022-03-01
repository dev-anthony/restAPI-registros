<?php namespace App\Models;

use CodeIgniter\Model;

class AlumnoModel extends Model
{
  protected $table = 'alumnos';
  protected $primaryKey = 'id_alumno';
  protected $returnType = 'array';
  protected $allowedFields = ['nombre_alumno', 'apellido_p', 'apellido_m', 'telefono_1', 'telefono_2'];

  // Control de fechas de auditacion
  protected $useTimestamps = false;
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';

}
