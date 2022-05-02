<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
  require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');

// Grupo de rutas para roles
// http://localhost:8080/api/roles
$routes->group('api/roles', ['namespace' => 'App\Controllers\API'], function ($routes) {
  // http://localhost:8080/api/roles --> GET
  $routes->get('', 'RolesController::index');
  // http://localhost:8080/api/roles/1 --> SHOW
  $routes->get('(:num)', 'RolesController::show/$1');
  // http://localhost:8080/api/roles/create --> POST
  $routes->post('create', 'RolesController::create');
  // http://localhost:8080/api/roles/edit/1 --> PUT
  $routes->put('edit/(:num)', 'RolesController::edit/$1');
  // http://localhost:8080/api/roles/1 --> DELETE
  $routes->delete('delete/(:num)', 'RolesController::delete/$1');
});

// crea otro grupo especial para las rutas de alumnos
// http://localhost:8080/api/alumnos
$routes->group('api/alumnos', ['namespace' => 'App\Controllers\API'], function ($routes) {
  // http://localhost:8080/api/alumnos --> GET
  $routes->get('', 'AlumnosController::index');
  // http://localhost:8080/api/alumnos/1 --> SHOW
  $routes->get('(:num)', 'AlumnosController::show/$1');
  // http://localhost:8080/api/alumnos/create --> POST
  $routes->post('create', 'AlumnosController::create');
  // http://localhost:8080/api/alumnos/edit/1 --> PUT
  $routes->put('edit/(:num)', 'AlumnosController::edit/$1');
  // http://localhost:8080/api/alumnos/1 --> DELETE
  $routes->delete('delete/(:num)', 'AlumnosController::delete/$1');
});

// http://localhost:8080/api/usuarios
$routes->group('api/usuarios', ['namespace' => 'App\Controllers\API'], function ($routes) {
  // http://localhost:8080/api/usuarios --> GET
  $routes->get('', 'UsuariosController::index');
  // http://localhost:8080/api/usuarios/1 --> SHOW
  $routes->get('(:num)', 'UsuariosController::show/$1');
  // http://localhost:8080/api/usuarios/create --> POST
  $routes->post('create', 'UsuariosController::create');
  // http://localhost:8080/api/usuarios/edit/1 --> PUT
  $routes->put('edit/(:num)', 'UsuariosController::edit/$1');
  // http://localhost:8080/api/usuarios/1 --> DELETE
  $routes->delete('delete/(:num)', 'UsuariosController::delete/$1');
});
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
  require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
