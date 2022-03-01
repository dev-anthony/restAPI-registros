<?php namespace App\Models\validations;

class ReglasDeVacacion {
  public function is_valid_rol($rol) {
    if ( !is_string($rol) ) {
      return false;
    }
    if ( strlen($rol) < 3 || strlen($rol) > 15 ) {
      return false;
    }
    return true;
  }
}
