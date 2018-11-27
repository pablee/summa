<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once "Database.php";


class Empresa
{
	private $id;
    private $nombre;
    private $empleados = array();

    public function getId(){
        return $this->id;
    }

    public function setId(){
        return $this->id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function getEmpleados(){
        return $this->empleados;
    }

    public function setEmpleados(){
        $this->empleados = $this->listar_empleados($this->id);
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////

    public function guardar()
    {
        $db = new database();
        $db->conectar();
        $consulta = "INSERT INTO empresa (nombre)
                     VALUES ('$this->nombre');";

        try {
            mysqli_query($db->conexion, $consulta);
        } catch (Exception $e) {
            error_log( print_r($e, true) );
            echo "\n Error: ".$e->getMessage()."\n";
        }
    }


    public function listar()
    {
        $db = new database();
        $db->conectar();

        $consulta = "SELECT *
                     FROM empresa;";

        try {
            $resultado = mysqli_query($db->conexion, $consulta);
            $empresas = array(array("id", "nombre"));

            $i = 0;
            while ($empresa = mysqli_fetch_assoc($resultado)) {
                $empresas[$i]["id"] = $empresa["id"];
                $empresas[$i]["nombre"] = $empresa["nombre"];
                $i++;
            }
        } catch (Exception $e) {
            error_log( print_r($e, true) );
            echo "\n Error: ".$e->getMessage()."\n";
        }

        return $empresas;
    }


    public function listar_empleados($id_empresa)
    {
        $db = new database();
        $db->conectar();

        $consulta = "SELECT EMP.id, EMP.nombre, EMP.apellido, EMP.edad, EMP.tipo_empleado, TIP.id_profesion,
                            PRO.nombre AS pro_nombre, TIP.id_especialidad, ESP.nombre AS esp_nombre
                     FROM empleado EMP
                     JOIN tipo_empleado TIP ON EMP.tipo_empleado = TIP.id
                     JOIN profesion PRO ON TIP.id_profesion = PRO.id
                     JOIN especialidad ESP ON TIP.id_especialidad = ESP.id
                     WHERE empresa = '$id_empresa';";

        try {
            $resultado = mysqli_query($db->conexion, $consulta);
            if(mysqli_num_rows($resultado)>=1)
            {
                $empleados = array(array("id", "nombre", "apellido", "edad", "tipo_empleado", "id_profesion", "pro_nombre",
                    "id_especialidad", "esp_nombre"));

                $i = 0;
                while ($empleado = mysqli_fetch_assoc($resultado)) {
                    $empleados[$i]["id"] = $empleado["id"];
                    $empleados[$i]["nombre"] = $empleado["nombre"];
                    $empleados[$i]["apellido"] = $empleado["apellido"];
                    $empleados[$i]["edad"] = $empleado["edad"];
                    $empleados[$i]["tipo_empleado"] = $empleado["tipo_empleado"];
                    $empleados[$i]["id_profesion"] = $empleado["id_profesion"];
                    $empleados[$i]["pro_nombre"] = $empleado["pro_nombre"];
                    $empleados[$i]["id_especialidad"] = $empleado["id_especialidad"];
                    $empleados[$i]["esp_nombre"] = $empleado["esp_nombre"];
                    $i++;
                }

                return $empleados;
            }else{
                $empleados = "0";
                return $empleados;
            }
        } catch (Exception $e) {
            error_log( print_r($e, true) );
            echo "\n Error: ".$e->getMessage()."\n";
        }


    }


    public function calcular_promedio($id_empresa)
    {
        $db = new database();
        $db->conectar();

        $consulta = "SELECT AVG(edad) AS promedio
                     FROM empleado
                     WHERE empresa = '$id_empresa';";

        try {
            $resultado = mysqli_query($db->conexion, $consulta);
            $calculo = mysqli_fetch_assoc($resultado);
            $promedio = $calculo["promedio"];
        } catch (Exception $e) {
            error_log( print_r($e, true) );
            echo "\n Error: ".$e->getMessage()."\n";
        }

        return $promedio;
    }


}		
?>