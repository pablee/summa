<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once "Database.php";

class Programador extends Empleado
{

    private $lenguaje;


    public function getLenguaje(){
        return $this->lenguaje;
    }


    public function setLenguaje($lenguaje){
        $this->lenguaje = $lenguaje;
    }

}