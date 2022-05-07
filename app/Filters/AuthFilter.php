<?php

namespace App\Filters;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Filters\FilterInterface;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

use Config\Services;
use Firebase\JWT\JWT;

class AuthFilter implements FilterInterface
{
  use ResponseTrait;

  public function before(RequestInterface $request, $arguments = null)
  {
    //EL before se ejecuta antes de que se ejecute el controlador
    try {
      $key = Services::getSecretKey();
      $authHeader = $request->getServer('HTTP_AUTHORIZATION');

      if ($authHeader == null) {
        return Services::response()->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED)->setBody(json_encode(['error' => 'No se encontro el token']));
        $arr = explode(' ', $authHeader);
        $jwt = $arr[1];
        // Luego de que se encuentra el token, se decodifica, lo que espera el es token, la llave y el metodo de encriptacion
        $decoded = JWT::decode($jwt, $key, ['HS256']);
      }
    } catch (\Exception $e) {
      return Services::response()->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)->setBody(json_encode(['error' => 'Ocurrió un error en el servidor al validar el token']), $e->getMessage());
    }
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    //El after se ejecuta despues de que se ejecute el controlador
  }
}
