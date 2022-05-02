<?php

namespace APP\Controllers\API;

use App\Models\UsuarioModel;
use CodeIgniter\RESTful\ResourceController;
use Respuestas;

class UsuariosController extends ResourceController
{
  public function __construct()
  {
    $this->model = $this->setModel(new UsuarioModel());
    // inyeccion de la libreria como servvicio nombrado validation
    $this->validation = \Config\Services::validation();
  }

  public function index()
  {
    try {

      if (!empty($alumno = $this->model->findAll())) {
        return $this->respond($alumno, 200);
      } else {
        return $this->failNotFound('No se encontraron usuarios');
      }
    } catch (\Exception $e) {
      //Exception $e;
      throw new \Exception('Ocurrio un error en el servidor', $e->getMessage());
    }
  }

  public function create()
  {
    try {
      //code...
      $data = $this->request->getJSON(true);

      if ($this->validation->run($data, 'usuario_validaation') == false) {
        return $this->respond('No se pudo crear el usuario', $data, 401);
      } else {
        $this->model->insert($data);
        return $this->respuestas->respuesta('Usuario creado', $data, 201);
      }
    } catch (\Exception $e) {
      //Exception $e;
      throw new \Exception('Ocurrio un error en el servidor', $e->getMessage());
    }
  }
}
