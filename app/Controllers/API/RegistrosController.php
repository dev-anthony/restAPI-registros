<?php

namespace App\Controllers\API;

use CodeIgniter\RESTful\ResourceController;
use App\Models\CursoAlumnoModel;

class RegistrosController extends ResourceController
{
  public function __construct()
  {
    $this->model = $this->setModel(new CursoAlumnoModel());
    // inyeccion de la libreria como servvicio nombrado validation
    $this->validation = \Config\Services::validation();
  }

  public function index()
  {
    try {

      if ($cursos = $this->model->findAll()) {
        return $this->respond($cursos, 200);
      } else {
        return $this->failNotFound('No se encontraron regiistros');
      } // code...
    } catch (\Exception $e) {
      return $this->failServerError('Error en el servidor', $e->getMessage());
    }
  }

  public function show($id = null)
  {
    try {
      //code...
      if ($id = $this->model->find($id)) {
        return $this->respond([
          'status' => 'success',
          'message' => 'registro encontrado',
          'data' => $id,
        ], 200);
      } else {
        return $this->failNotFound('No se encontró el registro');
      } // code...
    } catch (\Exception $e) {
      return $this->failServerError('Error en el servidor', $e->getMessage());
    }
  }

  public function v_cursos_alumnos ()
  {
    $vista_cursos_alumnos = $this->model->v_cursos_alumnos();
    return $this->respond($vista_cursos_alumnos, 200);
  }

  
}
