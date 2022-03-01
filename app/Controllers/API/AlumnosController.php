<?php

namespace App\Controllers\API;


use App\Models\AlumnoModel;
use CodeIgniter\RESTful\ResourceController;

class AlumnosController extends ResourceController
{
    public function __construct()
    { $this->model = $this->setModel(new AlumnoModel());
      // inyeccion de la libreria como servvicio nombrado validation
      $this->validation = \Config\Services::validation();
    }

    public function index()
    {
      try {

      if ( $alumno = $this->model->findAll() ) {
        return $this->respond($alumno, 200);

        $alumno->paginate(10);
        $paginador = $this->model->pager;
        $paginador->setPath('api/alumnos');
        return $this->respond($paginador);
      } else {
        return $this->failNotFound( 'No se encontraron alumnos' );
      }
    } catch (\Exception $e) {
      return $this->failServerError('Error en el servidor', $e->getMessage() );
    }

    }

    public function create()
    {
      try {
      $data = $this->request->getJSON(true);

        if ($this->validation->run($data, 'alumno_validation') == false) {
          return $this->fail($this->validation->getErrors());

        } else {

          $this->model->insert($data);
          return $this->respondCreated([
          'status' => 'created',
          'message' => 'alumno creado',
          'data' => $data,
        ], 201);

        }
      }catch (\Exception $e) {
        return $this->failServerError('Error en el servidor', $e->getMessage());
      }
    }



    public function show($id = null)
    {
      try {
        //code...
        if ( $id = $this->model->find($id) ){
          return $this->respond([
            'msg' => 'El alumno se encontro correctamente',
            'alumno' => $id
          ],200);

        } else {
          return $this->respond(
          ['error' => 'No se puede encontrar el alumno'],
          500);
        }
      } catch (\Exception $e) {
        //Exception $e;
        return $this->failServerError('Error en el servidor' ,$e->getMessage() );
      }
    }

    public function edit( $id = null )
    {
      try {
        //code...
        if ( $id == null ) {
          return $this->respond([
            'error' => 'No se puede editar el alumno'
          ], 500);

        } else {

          $alumno = $this->model->find($id);
          if ( $alumno ) {
            $alumno = $this->request->getJSON();
            if ( $this->model->update($id, $alumno) ) {
              return $this->respond([
                'msg' => 'El alumno se edito correctamente',
                'alumno' => $alumno],
                200);
            } else {
              return $this->respond(
                ['error' => 'No se puede editar el alumno'],
                500);
            }
          } else {
            return $this->respond(
              ['error' => 'El alumno no existe!!'],
              500);
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
        if ( $id == null ) {
          return $this->respond(
            ['error' => 'No se puede eliminar el alumno'],
            500);
        } else {
          $alumno = $this->model->find($id);
          if ( $alumno ) {
            if ( $this->model->delete($id) ) {
              return $this->respond([
                'msg' => 'El alumno se elimino correctamente',
                'alumno' => $alumno
              ], 200);

            } else {
              return $this->respond([
                'error' => 'No se puede eliminar el alumno'
              ], 500);
            }
          } else {
            return $this->respond([
              'error' => 'El alumno no existe!!'
            ], 500);
          }
        }
      } catch (\Exception $e) {
        //Exception $e;
        return $this->failServerError('Error en el servidor', $e->getMessage());
      }
    }

}
