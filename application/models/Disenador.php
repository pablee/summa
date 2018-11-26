<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once "Database.php";

class Disenador extends Empleado
{

    private $tipo_disenador;


    public function getTipo_disenador(){
        return $this->tipo_disenador;
    }


    public function setTipo_disenador($tipo_disenador){
        $this->tipo_disenador = $tipo_disenador;
    }


}