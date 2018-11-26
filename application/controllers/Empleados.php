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
        $empleado = $this->input->post('grilla');

        $emp->setNombre($empleado["nombre"]);
        $emp->setApellido($empleado["apellido"]);
        $emp->setEdad($empleado["edad"]);
        $emp->setTipo($empleado["tipo"]);
        $emp->setEmpresa($empleado["id_empresa"]);

        $emp->guardar();

        $this->load->view('header');
        $this->load->view('empleado/nuevo');
        $this->load->view('volver');
        $this->load->view('footer');
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
        $data["empleado"] = $this->empleado->buscar($id_empleado);
        $empleado = $data["empleado"];

        if($empleado["id_profesion"]=="1")
        {
            $pro = new Programador();
            $pro->setNombre($empleado["nombre"]);
            $pro->setApellido($empleado["apellido"]);
            $pro->setEdad($empleado["edad"]);
            $pro->setTipo($empleado["tipo"]);
            $pro->setEmpresa($empleado["empresa"]);
            $pro->setLenguaje($empleado["id_especialidad"]);
        } 
        else if($empleado["id_profesion"]=="2")
        {
            $dis = new Disenador();
            $dis->setNombre($empleado["nombre"]);
            $dis->setApellido($empleado["apellido"]);
            $dis->setEdad($empleado["edad"]);
            $dis->setTipo($empleado["tipo_empleado"]);
            $dis->setEmpresa($empleado["empresa"]);
            $dis->setTipo_disenador($empleado["id_especialidad"]);
        }

        $this->load->view('header');
        $this->load->view('empleado/encontrado', $data);
        $this->load->view('volver');
        $this->load->view('footer');
    }
}
