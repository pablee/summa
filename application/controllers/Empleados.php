<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empleados extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('empresa');
        $this->load->model('empleado');
        $this->load->model('programador');
        $this->load->model('disenador');
    }


    public function nuevo()
    {
        $data['empresas'] = $this->empresa->listar();
        $data['profesiones'] = $this->empleado->listar_profesion();
        $this->load->view('header');
        $this->load->view('empleado/nuevo',$data);
        $this->load->view('volver');
        $this->load->view('footer');
    }


    public function agregar()
    {
        $emp = new Empleado();
        //recibo el empleado nuevo
        $empleado = $this->input->post('grilla');

        //consulto la profesion, $empleado["tipo"] contiene el id de la profesion elegida
        $profesion = $this->buscar_profesion($empleado["tipo"]);//id de profesion

        //consulto la profesion para crear un objeto programador o diseñador
        if($profesion["nombre"]=="programador")
        {
            $pro = new Programador();
            $pro->setNombre($empleado["nombre"]);
            $pro->setApellido($empleado["apellido"]);
            $pro->setEdad($empleado["edad"]);
            $pro->setTipo($empleado["tipo"]);//id de profesion
            $pro->setEmpresa($empleado["id_empresa"]);
            $pro->setLenguaje($empleado["especialidad"]);//id de especialidad

            $tipo_empleado = $pro->buscar_tipo_empleado();
            $pro->guardar($tipo_empleado);
        }
        else if($profesion["nombre"]=="disenador")
        {
            $dis = new Disenador();
            $dis->setNombre($empleado["nombre"]);
            $dis->setApellido($empleado["apellido"]);
            $dis->setEdad($empleado["edad"]);
            $dis->setTipo($empleado["tipo"]);
            $dis->setEmpresa($empleado["id_empresa"]);
            $dis->setTipo_disenador($empleado["especialidad"]);
            $dis->getTipo_disenador();
            $tipo_empleado = $dis->buscar_tipo_empleado();
            $dis->guardar($tipo_empleado);
        }

        $this->nuevo();
    }


    public function programador()
    {
        $profesion = $this->input->get('profesion');
        $data['especialidades'] = $this->empleado->listar_especialidad($profesion);
        $this->load->view('empleado/programador', $data);
    }


    public function disenador()
    {
        $profesion = $this->input->get('profesion');
        $data['especialidades'] = $this->empleado->listar_especialidad($profesion);
        $this->load->view('empleado/disenador', $data);
    }


    public function buscar()
    {
        $this->load->view('header');
        $this->load->view('empleado/buscar');
        $this->load->view('volver');
        $this->load->view('footer');
    }


    public function buscar_empleado()
    {
        $id_empleado = $this->input->post("id_empleado");
        if($id_empleado > 0)
        {
            $data["empleado"] = $this->empleado->buscar($id_empleado);
            $this->load->view('header');
            $this->load->view('empleado/encontrado', $data);
            $this->load->view('volver');
            $this->load->view('footer');
        }
        else {
            $data["error"] = "El id debe ser mayor que 0";
            $this->load->view('header');
            $this->load->view('empleado/buscar', $data);
            $this->load->view('volver');
            $this->load->view('footer');
        }
    }


    public function buscar_profesion($empleado)
    {
        //devuelve los datos de la profesion
        $profesion = $this->empleado->buscar_profesion($empleado);
        return $profesion;
    }
}
