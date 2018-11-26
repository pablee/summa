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
        $empleado = $this->input->post('grilla');
        $this->empleado->guardar($empleado);

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

        $this->load->view('header');
        $this->load->view('empleado/encontrado', $data);
        $this->load->view('volver');
        $this->load->view('footer');
    }
}
