<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\API\ResponseTrait;
use Config\Services;
use Firebase\JWT\JWT;

class Auth extends BaseController
{
  use ResponseTrait;

  public function __construct()
  {
    helper('secure_password');
  }

  public function login()
  {
    try {
      $data = $this->request->getJSON();

      if (!$data || !$data) {
        throw new \Exception('Bad Request');
      }

      $userModel = new UsuarioModel();
      $validateUser = $userModel->where('username', $data->username)->first();

      if ($validateUser == null)
        return $this->failNotFound('Usuario no encontrado');

      if (verifyHash($data->password, $validateUser['password'])) :

        // return $this->respond('Usuario encontrado', 200);
        $jwt = $this->generateJWT($validateUser);
        return $this->respond(['token' => $jwt,
        'id_usuario' => $validateUser['id_usuario'],
        'name' => $validateUser['name'],
        'username' => $validateUser['username'],
        'rol_id' => $validateUser['rol_id'],
      ]);

      else :
        return $this->failValidationErrors('Contraseña invalida');
      endif;
    } catch (\Exception $e) {
      return $this->failServerError('Error en el servidor', $e->getMessage());
    }
  }

  protected function generateJWT($user)
  {
    $key = Services::getSecretKey();
    $time = time();
    $payload = [
      'aud' => base_url(),
      'iat' => $time,
      'exp' => time() + (60 * 60 * 24),
      'data' => [
        'id_usuario' => $user['id_usuario'],
        'name' => $user['name'],
        'username' => $user['username'],
        'role' => $user['rol_id'],
      ],
    ];

    $jwt = JWT::encode($payload, $key, 'HS256');
    return $jwt;
  }
}
