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
    // validadcion para rol con errores
    'tipo_rol' => [ //Aquí tiene que ir el nombre del campo del que tienes en la base de datos
      'label' => 'Rol',
      'rules' => 'required|is_unique[roles.tipo_rol]',
      'errors' => [
        'required' => 'El campo {field} es requerido',
        'is_unique' => 'El {field} ya existe',
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
      'rules' => 'required|is_unique[alumnos.telefono_1]|min_length[10]|max_length[10]|trim|numeric',
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
      'rules' => 'required|is_unique[alumnos.telefono_2]|min_length[10]|max_length[10]|trim|numeric',
      'errors' => [
        'required' => 'El campo telefono es obligatorio',
        'is_unique' => 'El telefono ya existe',
        'min_length' => 'El telefono debe tener al menos 7 caracteres',
        'max_length' => 'El telefono debe tener como maximo 10 caracteres',
        'numeric' => 'El telefono solo puede contener numeros sin espacios',
      ],
    ],
  ];

  public $usuario_validation = [
    'name' => [
      'label' => 'Nombre',
      'rules' => 'required|min_length[3]|max_length[50]',
      'errors' => [
        'required' => 'El campo {field} es requerido',
        'min_length' => 'El campo {field} debe tener al menos {param} caracteres',
        'max_length' => 'El campo {field} debe tener como maximo {param} caracteres',
      ],
    ],
    'username' => [
      'label' => 'Usuario',
      'rules' => 'required|is_unique[user.username]|min_length[3]|max_length[50]|trim',
      'errors' => [
        'required' => 'El campo {field} es requerido',
        'is_unique' => 'El {field} ya existe',
        'min_length' => 'El campo {field} debe tener al menos {param} caracteres',
        'max_length' => 'El campo {field} debe tener como maximo {param} caracteres',
      ],
    ],
    'password' => [
      'label' => 'Contraseña',
      'rules' => 'min_length[3]|max_length[100]|trim',
      'errors' => [
        'min_length' => 'La {field} debe tener al menos {param} caracteres',
        'max_length' => 'La {field} debe tener como maximo {param} caracteres',
      ],
    ],
  ];

  public $curso_validation = [
    'nombre_curso' => [
      'label' => 'Nombre',
      'rules' => 'required|min_length[3]|max_length[100]|trim',
      'errors' => [
        'required' => 'El campo {field} es requerido',
        'min_length' => 'El campo {field} debe tener al menos {param} caracteres',
        'max_length' => 'El campo {field} debe tener como maximo {param} caracteres',
      ],
    ],
    'descripsion' => [
      'label' => 'Descripsion',
      'rules' => 'required|min_length[3]|max_length[255]|trim',
      'errors' => [
        'required' => 'El campo {field} es requerido',
        'min_length' => 'El campo {field} debe tener al menos {param} caracteres',
        'max_length' => 'El campo {field} debe tener como maximo {param} caracteres',
      ],
    ],
    'hora_inicio' => [
      'label' => 'Hora de inicio',
      'rules' => 'required|min_length[3]|max_length[20]|trim|',
      'errors' => [
        'required' => 'El campo {field} es requerido',
        'min_length' => 'El campo {field} debe tener al menos {param} caracteres',
        'max_length' => 'El campo {field} debe tener como maximo {param} caracteres',
      ],
    ],
    'hora_fin' => [
      'label' => 'Hora de fin',
      'rules' => 'required|min_length[3]|max_length[20]|trim',
      'errors' => [
        'required' => 'El campo {field} es requerido',
        'min_length' => 'El campo {field} debe tener al menos {param} caracteres',
        'max_length' => 'El campo {field} debe tener como maximo {param} caracteres',
      ],
    ],
  ];
}
