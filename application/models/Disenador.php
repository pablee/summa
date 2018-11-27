<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once "Database.php";

class Disenador extends Empleado
{
    private $tipo_disenador;
    protected $profesion = '2';

    public function getTipo_disenador(){
        return $this->tipo_disenador;
    }

    public function setTipo_disenador($tipo_disenador){
        $this->tipo_disenador = $tipo_disenador;
    }


    public function buscar_tipo_empleado()
    {
        $db = new database();
        $db->conectar();

        $consulta = "SELECT TIP.id
                     FROM tipo_empleado TIP
                     JOIN profesion PRO ON TIP.id_profesion = PRO.id
                     WHERE TIP.id_profesion = '$this->tipo'
                     AND TIP.id_especialidad = '$this->tipo_disenador';";

        try {
            $resultado = mysqli_query($db->conexion, $consulta);
            $profesion = mysqli_fetch_assoc($resultado);
        } catch (Exception $e) {
            error_log( print_r($e, true) );
            echo "\n Error: ".$e->getMessage()."\n";
        }

        return $profesion["id"];
    }
}