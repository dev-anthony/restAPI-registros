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

      if ($user = $this->model->findAll()) {
        return $this->respond($user, 200);
      } else {
        return $this->failNotFound('No se encontraron usuarios');
      }
    } catch (\Exception $e) {
      return $this->failServerError('Error en el servidor', $e->getMessage());
    }
  }

  public function show($id = null)
  {
    try {
      //code...
      if ($id = $this->model->find($id)) {
        return $this->respond(
          [
            'msg' => 'El usuario se encontro correctamente',
            'usuario' => $id
          ],
          200
        );
      } else {
        return $this->respond(
          ['error' => 'No se puede encontrar el usuario'],
          500
        );
      }
    } catch (\Exception $e) {
      //Exception $e;
      return $this->failServerError('Error en el servidor', $e->getMessage());
    }
  }

  public function create()
  {
    try {
      //  estaa paarte lo que hace es guardar los datos validados y haseha el password
      $data = $this->request->getJSON(true);
      $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

      if ($this->validation->run($data, 'usuario_validation') == false) {
        return $this->fail($this->validation->getErrors());
      } else {

        $this->model->insert($data);
        return $this->respondCreated([
          'status' => 'created',
          'message' => 'Usuario creado',
          'data' => $data,
        ], 201);
      }
    } catch (\Exception $e) {
      return $this->failServerError('Error en el servidor', $e->getMessage());
    }
  }

  public function edit($id = null)
  {
    try {
      //code...
      if ($id == null) {
        return $this->respond(
          ['error' => 'No se puede editar el usuario'],
          500
        );
      } else {
        $user = $this->model->find($id);
        if ($user) {
          $user = $this->request->getJSON();
          if ($this->model->update($id, $user)) {
            return $this->respond(
              [
                'msg' => 'El usuario se edito correctamente',
                'usuario' => $user
              ],
              200
            );
          } else {
            return $this->respond(
              ['error' => 'No se puede editar el usuario'],
              500
            );
          }
        } else {
          return $this->respond(
            ['error' => 'El usuario no existe!!'],
            500
          );
        }
      }
    } catch (\Exception $e) {
      //Exception $e;
      return $this->failServerError('Error en el servidor', $e->getMessage());
    }
  }

  public function delete($id = null)
  {
    try {
      //code...
      if ($id == null) {
        return $this->respond(
          ['error' => 'No se puede eliminar el usuario'],
          500
        );
      } else {
        $user = $this->model->find($id);
        if ($user) {
          if ($this->model->delete($id)) {
            return $this->respond(
              [
                'msg' => 'El usuario se elimino correctamente',
                'usuario' => $user
              ],
              200
            );
          } else {
            return $this->respond(
              ['error' => 'No se puede eliminar el usuario'],
              500
            );
          }
        } else {
          return $this->respond(
            ['error' => 'El usuario no existe!!'],
            500
          );
        }
      }
    } catch (\Exception $e) {
      //Exception $e;
      return $this->failServerError('Error en el servidor', $e->getMessage());
    }
  }
}
