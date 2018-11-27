<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once "Database.php";

class Empleado
{
    protected $id;
    protected $nombre;
    protected $apellido;
    protected $edad;
    protected $tipo;//id de profesion
    protected $empresa;
    protected $profesion = null;


    public function getId(){
        return $this->id;
    }


    public function setId($id){
        $this->id = $id;
    }


    public function getNombre(){
        return $this->nombre;
    }


    public function setNombre($nombre){
        $this->nombre = $nombre;
    }


    public function getApellido(){
        return $this->apellido;
    }


    public function setApellido($apellido){
        $this->apellido = $apellido;
    }


    public function getEdad(){
        return $this->edad;
    }


    public function setEdad($edad){
        $this->edad = $edad;
    }


    public function getTipo(){
        return $this->tipo;
    }


    public function setTipo($tipo){
        $this->tipo = $tipo;
    }


    public function getEmpresa(){
        return $this->empresa;
    }


    public function setEmpresa($empresa){
        $this->empresa = $empresa;
    }

    //////////////////////////////////////////////////////////////////////////////////////

    public function listar_profesion()
    {
        $db = new database();
        $db->conectar();

        $consulta = "SELECT *
                     FROM profesion;";

        try {
            $resultado = mysqli_query($db->conexion, $consulta);
            $profesiones = array(array("id", "nombre"));

            $i = 0;
            while ($profesion = mysqli_fetch_assoc($resultado)) {
                $profesiones[$i]["id"] = $profesion["id"];
                $profesiones[$i]["nombre"] = $profesion["nombre"];
                $i++;
            }
        } catch (Exception $e) {
            error_log( print_r($e, true) );
            echo "\n Error: ".$e->getMessage()."\n";
        }

        return $profesiones;
    }


    public function listar_especialidad($profesion)
    {
        $db = new database();
        $db->conectar();

        $consulta = "SELECT TIP.id, TIP.id_profesion, TIP.id_especialidad, ESP.nombre
                     FROM tipo_empleado TIP JOIN especialidad ESP ON TIP.id_especialidad = ESP.id
                     WHERE id_profesion = '$profesion';";

        try {
            $resultado = mysqli_query($db->conexion, $consulta);
            $especialidades = array(array("id", "id_profesion", "id_especialidad", "nombre"));

            $i = 0;
            while ($especialidad = mysqli_fetch_assoc($resultado)) {
                $especialidades[$i]["id"] = $especialidad["id"];
                $especialidades[$i]["id_profesion"] = $especialidad["id_profesion"];
                $especialidades[$i]["id_especialidad"] = $especialidad["id_especialidad"];
                $especialidades[$i]["nombre"] = $especialidad["nombre"];
                $i++;
            }
        } catch (Exception $e) {
            error_log( print_r($e, true) );
            echo "\n Error: ".$e->getMessage()."\n";
        }

        return $especialidades;
    }


    public function guardar($tipo_empleado)
    {
        $db = new database();
        $db->conectar();

        $consulta = "INSERT INTO empleado(nombre, apellido, edad, tipo_empleado, empresa)
                     VALUES ('$this->nombre', '$this->apellido', '$this->edad', '$tipo_empleado',
                     '$this->empresa');";

        //entonces en Empleado::guardar podes verificar que this->tipo no es null y que la especialidad este relacionada al tipo
        if($this->tipo != null && $this->tipo == $this->profesion)
        {
            try {
                mysqli_query($db->conexion, $consulta);
            } catch (Exception $e) {
                error_log( print_r($e, true) );
                echo "\n Error: ".$e->getMessage()."\n";
            }
        }
        else{
            echo "El tipo de empleado ingresado es incorrecto. Tipo:".$this->tipo." y Profesion: ".$this->profesion;
        }
    }


    public function buscar($id_empleado)
    {
        $db = new database();
        $db->conectar();

        $consulta = "SELECT EMP.id, EMP.nombre, EMP.apellido, EMP.edad, EMP.tipo_empleado, TIP.id_profesion,
                            PRO.nombre AS pro_nombre, TIP.id_especialidad, ESP.nombre AS esp_nombre, EMP.empresa
                     FROM empleado EMP
                     JOIN tipo_empleado TIP ON EMP.tipo_empleado = TIP.id
                     JOIN profesion PRO ON TIP.id_profesion = PRO.id
                     JOIN especialidad ESP ON TIP.id_especialidad = ESP.id
                     WHERE EMP.id = '$id_empleado';";

        try {
            $resultado = mysqli_query($db->conexion, $consulta);

            if(mysqli_num_rows($resultado)==1)
            {
                $empleado = array("id", "nombre", "apellido", "edad", "tipo_empleado", "id_profesion", "pro_nombre",
                    "id_especialidad", "esp_nombre");

                while ($emp = mysqli_fetch_assoc($resultado)) {
                    $empleado["id"] = $emp["id"];
                    $empleado["nombre"] = $emp["nombre"];
                    $empleado["apellido"] = $emp["apellido"];
                    $empleado["edad"] = $emp["edad"];
                    $empleado["tipo_empleado"] = $emp["tipo_empleado"];
                    $empleado["id_profesion"] = $emp["id_profesion"];
                    $empleado["pro_nombre"] = $emp["pro_nombre"];
                    $empleado["id_especialidad"] = $emp["id_especialidad"];
                    $empleado["esp_nombre"] = $emp["esp_nombre"];
                    $empleado["empresa"] = $emp["empresa"];
                }

                return $empleado;
            }
            else{
                $no_encontrado = true;
                return $no_encontrado;
            }
        } catch (Exception $e) {
            error_log( print_r($e, true) );
            echo "\n Error: ".$e->getMessage()."\n";
        }
    }


    public function buscar_profesion($empleado)
    {
        $db = new database();
        $db->conectar();

        $consulta = "SELECT *
                     FROM profesion
                     WHERE id = '$empleado';";

        try {
            $resultado = mysqli_query($db->conexion, $consulta);
            $profesion = mysqli_fetch_assoc($resultado);
        } catch (Exception $e) {
            error_log( print_r($e, true) );
            echo "\n Error: ".$e->getMessage()."\n";
        }

        return $profesion;
    }

}



















