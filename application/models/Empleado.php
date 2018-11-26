<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once "Database.php";

class Empleado
{
    public function listar_profesion()
    {
        $db = new database();
        $db->conectar();

        $consulta = "SELECT *
                     FROM profesion;";

        $resultado = mysqli_query($db->conexion, $consulta)
        or die ("No se pueden listar las profesiones.");

        $profesiones = array(array("id", "nombre"));

        $i = 0;
        while ($profesion = mysqli_fetch_assoc($resultado)) {
            $profesiones[$i]["id"] = $profesion["id"];
            $profesiones[$i]["nombre"] = $profesion["nombre"];
            $i++;
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

        $resultado = mysqli_query($db->conexion, $consulta)
        or die ("No se pueden listar las especialidades.");

        $especialidades = array(array("id", "id_profesion", "id_especialidad", "nombre"));

        $i = 0;
        while ($especialidad = mysqli_fetch_assoc($resultado)) {
            $especialidades[$i]["id"] = $especialidad["id"];
            $especialidades[$i]["id_profesion"] = $especialidad["id_profesion"];
            $especialidades[$i]["id_especialidad"] = $especialidad["id_especialidad"];
            $especialidades[$i]["nombre"] = $especialidad["nombre"];
            $i++;
        }

        return $especialidades;
    }


    public function guardar($empleado)
    {
        $db = new database();
        $db->conectar();

        $consulta = "INSERT INTO empleado(nombre, apellido, edad, tipo_empleado, empresa)
                     VALUES ('$empleado[nombre]', '$empleado[apellido]', '$empleado[edad]', '$empleado[especialidad]',
                     '$empleado[id_empresa]');";

        mysqli_query($db->conexion, $consulta)  or die ("No se pudo guardar el empleado.");
    }


    public function buscar($id_empleado)
    {
        $db = new database();
        $db->conectar();

        $consulta = "SELECT EMP.id, EMP.nombre, EMP.apellido, EMP.edad, EMP.tipo_empleado, TIP.id_profesion,
                            PRO.nombre AS pro_nombre, TIP.id_especialidad, ESP.nombre AS esp_nombre
                     FROM empleado EMP
                     JOIN tipo_empleado TIP ON EMP.tipo_empleado = TIP.id
                     JOIN profesion PRO ON TIP.id_profesion = PRO.id
                     JOIN especialidad ESP ON TIP.id_especialidad = ESP.id
                     WHERE EMP.id = '$id_empleado';";

        $resultado = mysqli_query($db->conexion, $consulta)
        or die ("No se pudo buscar el empleado");

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
        }

        return $empleado;
    }






}






















/**********************************************************************************************************************************
    public function listar()
    {
        $db=new database();
        $db->conectar();

        $consulta ="SELECT *
                    FROM wp_woocommerce_order_items ORD
                    JOIN wp_woocommerce_order_img_cropped IMG ON ORD.order_id = IMG.order_id;";

        $resultado=mysqli_query($db->conexion, $consulta)
        or die ("No se pueden mostrar los pedidos.");

        $pedidos = array(array("order_item_id", "order_item_name", "order_item_type", "order_id", "url_cropped_img"));

        $i=0;
        while($pedido = mysqli_fetch_assoc($resultado))
        {
            $pedidos[$i]["order_item_id"]=$pedido["order_item_id"];
            $pedidos[$i]["order_item_name"]=$pedido["order_item_name"];
            $pedidos[$i]["order_item_type"]=$pedido["order_item_type"];
            $pedidos[$i]["order_id"]=$pedido["order_id"];
            $pedidos[$i]["url_cropped_img"]=$pedido["url_cropped_img"];
            $i++;
        }

        return $pedidos;
    }


    public function guardar($order, $img)
    {
        $db=new database();
        $db->conectar();

        $consulta = "SELECT *
                     FROM wp_woocommerce_order_img_cropped
                     WHERE order_id = '$order'
                     AND url_cropped_img = '$img';";

        $resultado = mysqli_query($db->conexion, $consulta) or die ("No se puede guardar el pedido.");

        if(mysqli_num_rows($resultado))
        {
            echo "El pedido ya fue procesado";
        }
        else
        {
            $consulta = "INSERT INTO wp_woocommerce_order_img_cropped (order_id, url_cropped_img)
                         VALUES ('$order', '$img')";

            $resultado=mysqli_query($db->conexion, $consulta) or die ("No se puede guardar el pedido.");
        }

    }


    public function buscar($order_id)
    {
        $db=new database();
        $db->conectar();

        $consulta = "SELECT *
                     FROM wp_woocommerce_order_items ORD
                     JOIN wp_woocommerce_order_itemmeta META ON ORD.order_item_id = META.order_item_id
                     JOIN wp_woocommerce_order_img_cropped IMG ON ORD.order_id = IMG.order_id
                     WHERE ORD.order_id = '$order_id';";

        $resultado=mysqli_query($db->conexion, $consulta)
        or die ("No se pueden ver el pedido.");

        $pedido = array(array("order_item_id", "order_item_name", "order_item_type", "order_id", "url_cropped_img"));

        while($p = mysqli_fetch_assoc($resultado))
        {
            $pedido["order_item_id"]=$p["order_item_id"];
            $pedido["order_item_name"]=$p["order_item_name"];
            $pedido["order_item_type"]=$p["order_item_type"];
            $pedido["order_id"]=$p["order_id"];
            $pedido["url_cropped_img"]=$p["url_cropped_img"];
        }
        /*
        $i=0;
        while($pedido = mysqli_fetch_assoc($resultado))
        {
            $pedidos[$i]["order_item_id"]=$pedido["order_item_id"];
            $pedidos[$i]["order_item_name"]=$pedido["order_item_name"];
            $pedidos[$i]["order_item_type"]=$pedido["order_item_type"];
            $pedidos[$i]["order_id"]=$pedido["order_id"];
            $pedidos[$i]["url_cropped_img"]=$pedido["url_cropped_img"];
            $i++;
        }

        return $pedido;
    }
}
*/