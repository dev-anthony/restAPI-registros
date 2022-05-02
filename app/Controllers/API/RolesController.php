<?php

namespace App\Controllers\API;


use App\Models\RolModel;
use CodeIgniter\RESTful\ResourceController;

class RolesController extends ResourceController
{
  public function __construct()
  {
    $this->model = $this->setModel(new RolModel());
    // inyeccion de la libreria como servvicio nombrado validation
    $this->validation = \Config\Services::validation();
    // inyeccion para la subida de imagenes
    $this->upload = \Config\Services::upload();
  }

  public function index()
  {
    try {

      if ($rol = $this->model->findAll()) {
        return $this->respond($rol, 200);

        $rol->paginate(10);
        $paginador = $this->model->pager;
        $paginador->setPath('api/alumnos');
        return $this->respond($paginador);
      } else {
        return $this->failNotFound('No se encontraron roles');
      }
    } catch (\Exception $e) {
      return $this->failServerError('Error en el servidor', $e->getMessage());
    }
  }

  // método para guardar un nuevo rol con su avatar
  public function create()
  {
    try {
      $data = $this->request->getJSON();
      // trae el archivo de la peticion form-data
      $file = $this->request->getFile('avatar');

      // validaciones
      if (!$this->validation->run($data, 'rol_validation')) {
        return $this->respond($this->validation->getErrors());
      } else {
        // subida de imagen
        $upload = $this->upload->file($file, 'avatar');
        // pasar la imagen a base64
        $data['avatar'] = base64_encode(file_get_contents($upload->getTempName()));
        if ($upload->isValid()) {
          $upload->setName('avatar_' . $data['nombre']);
          $upload->setPrefix('avatar_');
          $upload->setDirectory('./uploads/avatar');
          $upload->setExtension('jpg | png | jpeg');
          $upload->setMaxFilesize('5MB');
          $upload->setAllowedTypes(['jpg', 'png', 'jpeg']);
          $upload->setOverwrite(true);
          $upload->setRemoveFileOnUpdate(true);
          $upload->upload();
          $data['avatar'] = $upload->getFileName();
        } else {
          return $this->respond($upload->getErrors());
        } // fin subida de imagen

        // guardar el rol
        $rol = $this->model->insert($data);
        if ($rol) {
          return $this->respondCreated('Rol creado correctamente');
        } else {
          return $this->respond('Error al crear el rol');
        } // fin guardar el rol

      } // fin validaciones
    } catch (\Exception $e) {
      return $this->failServerError('Error en el servidor', $e->getMessage());
    }
  }


  //       $upload = $this->upload->file($files['avatar']);
  //       if ($upload->isValid()) {
  //         $upload->setName('avatar_' . $data['avatar']);
  //         $upload->setPrefix('avatar_');
  //         $upload->setDirectory('uploads/roles');
  //         $upload->setExtension('jpg | jpeg | png');
  //         $upload->setMaxFilesize('1MB');
  //         $upload->setAllowedTypes(['jpg', 'png', 'jpeg']);
  //         $upload->setOverwrite(true);
  //         $upload->setRemoveFileOnUpdate(true);
  //         $upload->setFileName($upload->getName());
  //         $upload->upload();
  //         $data['avatar'] = $upload->getFileName();
  //         // creacion de rol
  //         $rol = $this->model->insert($data);
  //         if ($rol) {
  //           return $this->respondCreated('Rol creado correctamente');
  //         } else {
  //           return $this->respond('Error al crear el rol');
  //         }
  //       } else {
  //         return $this->respond('Error al subir la imagen');
  //       } // fin subida de imagen
  //     } // fin validaciones

  //   } catch (\Exception $e) {
  //     return $this->failServerError('Error en el servidor', $e->getMessage());
  //   }
  // }



  // método para actualizar un rol con su avatar y pasarlo a base64
  // public function edit($id)
  // {
  //   try {
  //     $data = $this->request->getRawInput();
  //     $data['avatar'] = $this->upload->data('avatar');
  //     $data['avatar'] = base64_encode($data['avatar']);
  //     if ($this->validation->run($data, 'roles') === false) {
  //       return $this->respond($this->validation->getErrors());
  //     } else {
  //       $this->model->update($id, $data);
  //       return $this->respondCreated('Rol actualizado correctamente');
  //     }
  //   } catch (\Exception $e) {
  //     return $this->failServerError('Error en el servidor', $e->getMessage());
  //   }
  // }



  // public function create()
  // {
  //   try {
  //     $data = $this->request->getJSON();

  //     if ($this->validation->run($data, 'rol_validation') == false) {
  //       return $this->respond('No se pudo crear el rol', 400);
  //     } else {
  //       $data['avatar'] = $this->upload->file('avatar', [
  //         'upload_path' => './uploads/',
  //         'allowed_types' => 'jpg|png|jpeg',
  //         'max_size' => '2048',
  //         'overwrite' => true,
  //         'file_name' => bin2hex(random_bytes(10)),
  //       ]);
  //       if ($this->model->insert($data)) {
  //         return $this->respondCreated(
  //           [
  //             'status' => 'created',
  //             'message' => 'Rol creado',
  //             'data' => $data,
  //           ],
  //           201
  //         );
  //       } else {
  //         return $this->respond('Error al crear el rol');
  //       }
  //     }
  //   } catch (\Exception $e) {
  //     return $this->failServerError('Error en el servidor', $e->getMessage());
  //   }
  // }


  public function show($id = null)
  {
    try {
      //code...
      if ($id = $this->model->find($id)) {
        return $this->respond(
          [
            'msg' => 'El rol se encontro correctamente',
            'rol' => $id
          ],
          200
        );
      } else {
        return $this->respond(
          ['error' => 'No se puede encontrar el rol'],
          500
        );
      }
    } catch (\Exception $e) {
      //Exception $e;
      return $this->failServerError('Error en el servidor', $e->getMessage());
    }
  }

  public function edit($id = null)
  {
    try {
      //code...
      if ($id == null) {
        return $this->respond(
          ['error' => 'No se puede editar el rol'],
          500
        );
      } else {
        $rol = $this->model->find($id);
        if ($rol) {
          $rol = $this->request->getJSON();
          if ($this->model->update($id, $rol)) {
            return $this->respond(
              [
                'msg' => 'El rol se edito correctamente',
                'rol' => $rol
              ],
              200
            );
          } else {
            return $this->respond(
              ['error' => 'No se puede editar el rol'],
              500
            );
          }
        } else {
          return $this->respond(
            ['error' => 'El rol no existe!!'],
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
          ['error' => 'No se puede eliminar el rol'],
          500
        );
      } else {
        $rol = $this->model->find($id);
        if ($rol) {
          if ($this->model->delete($id)) {
            return $this->respond(
              [
                'msg' => 'El rol se elimino correctamente',
                'rol' => $rol
              ],
              200
            );
          } else {
            return $this->respond(
              ['error' => 'No se puede eliminar el rol'],
              500
            );
          }
        } else {
          return $this->respond(
            ['error' => 'El rol no existe!!'],
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
