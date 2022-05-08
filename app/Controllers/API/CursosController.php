<?php

namespace App\Controllers\API;

use App\Models\CursoModel;
use CodeIgniter\RESTful\ResourceController;

class CursosController extends ResourceController
{
  public function __construct()
  {
    $this->model = $this->setModel(new CursoModel());
    // inyeccion de la libreria como servvicio nombrado validation
    $this->validation = \Config\Services::validation();
  }

  public function index()
  {
    try {

      if ($cursos = $this->model->findAll()) {
        return $this->respond($cursos, 200);
      } else {
        return $this->failNotFound('No se encontraron cursos');
      } // code...
    } catch (\Exception $e) {
      return $this->failServerError('Error en el servidor', $e->getMessage());
    }
  }

  public function create()
  {
    try {
      $data = $this->request->getJSON(true);

      if ($this->validation->run($data, 'curso_validation') == false) {
        return $this->fail($this->validation->getErrors());
      } else {

        $this->model->insert($data);
        return $this->respondCreated([
          'status' => 'created',
          'message' => 'curso creado',
          'data' => $data,
        ], 201);
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
          'message' => 'curso encontrado',
          'data' => $id,
        ], 200);
      } else {
        return $this->failNotFound('No se encontró el curso');
      } // code...
    } catch (\Exception $e) {
      return $this->failServerError('Error en el servidor', $e->getMessage());
    }
  }

  public function update($id = null)
  {
    try {
      //code...
      $data = $this->request->getJSON(true);

      if ($this->validation->run($data, 'curso_validation') == false) {
        return $this->fail($this->validation->getErrors());
      } else {
        $this->model->update($id, $data);
        return $this->respondCreated([
          'status' => 'updated',
          'message' => 'curso actualizado',
          'data' => $data,
        ], 201);
      } // code...
    } catch (\Exception $e) {
      return $this->failServerError('Error en el servidor', $e->getMessage());
    }
  }

  public function delete($id = null)
  {
    try {
      //code...
      if ($id = $this->model->find($id)) {
        $this->model->delete($id);
        return $this->respondCreated([
          'status' => 'deleted',
          'message' => 'curso eliminado',
          'data' => $id,
        ], 201);
      } else {
        return $this->failNotFound('No se encontró el curso');
      } // code...
    } catch (\Exception $e) {
      return $this->failServerError('Error en el servidor', $e->getMessage());
    }
  }
}
