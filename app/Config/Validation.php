<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
  //--------------------------------------------------------------------
  // Setup
  //--------------------------------------------------------------------

  /**
   * Stores the classes that contain the
   * rules that are available.
   *
   * @var string[]
   */
  public $ruleSets = [
    Rules::class,
    FormatRules::class,
    FileRules::class,
    CreditCardRules::class,
  ];

  /**
   * Specifies the views that are used to display the
   * errors.
   *
   * @var array<string, string>
   */
  public $templates = [
    'list'   => 'CodeIgniter\Validation\Views\list',
    'single' => 'CodeIgniter\Validation\Views\single',
  ];

  //--------------------------------------------------------------------
  // Rules
  //--------------------------------------------------------------------

  public $rol_validation = [
    'tipo_rol' => [
      'label' => 'Rol',
      'rules' => 'required|is_unique[roles.tipo_rol]|min_length[3]|max_length[13]|trim|alpha',
      'errors' => [
        'required' => 'El campo rol es obligatorio',
        'is_unique' => 'El rol ya existe',
        'min_length' => 'El rol debe tener al menos 3 caracteres',
        'max_length' => 'El rol debe tener como maximo 20 caracteres',
        'alpha' => 'El rol debe contener solo letras',
      ],
    ],
    'avatar' => [
      'label' => 'Avatar',
      'rules' => 'uploaded[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png]|max_size[avatar,5120]',
      'errors' => [
        'uploaded' => 'El archivo no se pudo subir',
        'mime_in' => 'El archivo debe ser una imagen',
        'max_size' => 'El archivo debe ser menor a 5MB',

      ],
    ],
  ];

  public $alumno_validation = [
    // crea validacion para que el alumno
    'nombre_alumno' => [
      'label' => 'Nombre',
      'rules' => 'required|min_length[3]|max_length[30]|trim|alpha_space',
      'errors' => [
        'required' => 'El campo nombre es obligatorio',
        'min_length' => 'El nombre debe tener al menos 3 caracteres',
        'max_length' => 'El nombre debe tener como maximo 30 caracteres',
        'alpha' => 'El nombre solo puede contener letras y espacios',
      ],
    ],
    'apellido_p' => [
      'label' => 'Apellido paterno',
      'rules' => 'required|min_length[3]|max_length[30]|trim|alpha_space',
      'errors' => [
        'required' => 'El campo apellido paterno es obligatorio',
        'min_length' => 'El apellido debe tener al menos 3 caracteres',
        'max_length' => 'El apellido debe tener como maximo 30 caracteres',
        'alpha' => 'El apellido solo puede contener letras y espacios',
      ],
    ],
    'apellido_m' => [
      'label' => 'Apellido materno',
      'rules' => 'required|min_length[3]|max_length[30]|trim|alpha_space',
      'errors' => [
        'required' => 'El campo apellido materno es obligatorio',
        'min_length' => 'El apellido debe tener al menos 3 caracteres',
        'max_length' => 'El apellido debe tener como maximo 30 caracteres',
        'alpha' => 'El apellido solo puede contener letras sin espacios',
      ],
    ],
    'telefono_1' => [
      'label' => 'Telefono 1',
      'rules' => 'required|is_unique[alumnos.telefono_1]|min_length[7]|max_length[10]|trim|numeric',
      'errors' => [
        'required' => 'El campo telefono es obligatorio',
        'is_unique' => 'El telefono ya existe',
        'min_length' => 'El telefono debe tener al menos 7 caracteres',
        'max_length' => 'El telefono debe tener como maximo 10 caracteres',
        'numeric' => 'El telefono solo puede contener numeros sin espacios',
      ],
    ],
    'telefono_2' => [
      'label' => 'Telefono 2',
      'rules' => 'required|is_unique[alumnos.telefono_2]|min_length[7]|max_length[10]|trim|numeric',
      'errors' => [
        'required' => 'El campo telefono es obligatorio',
        'is_unique' => 'El telefono ya existe',
        'min_length' => 'El telefono debe tener al menos 7 caracteres',
        'max_length' => 'El telefono debe tener como maximo 10 caracteres',
        'numeric' => 'El telefono solo puede contener numeros sin espacios',
      ],
    ],
  ];
}
