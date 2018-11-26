<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empresas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('empresa');
    }


    public function index()
    {
        $this->load->view('header');
        $this->load->view('index');
        $this->load->view('footer');
    }


    public function nueva()
    {
        $this->load->view('header');
        $this->load->view('empresa/nueva');
        $this->load->view('volver');
        $this->load->view('footer');
    }


    public function agregar()
    {
        $nombre = $this->input->post('nombre');
        $this->empresa->setNombre($nombre);
        $this->empresa->guardar();

        $this->load->view('header');
        $this->load->view('index');
        $this->load->view('footer');
    }


    public function listar_empleados()
    {
        $data['empresas'] = $this->empresa->listar();
        $this->load->view('header');
        $this->load->view('empresa/listar', $data);
        $this->load->view('volver');
        $this->load->view('footer');
    }


    public function buscar_empleados()
    {
        $id_empresa = $this->input->post('id_empresa');
        $data['empleados'] = $this->empresa->listar_empleados($id_empresa);

        $this->load->view('header');
        $this->load->view('empresa/listar_empleados', $data);
        $this->load->view('volver');
        $this->load->view('footer');
    }


    public function promedio()
    {
        $data['empresas'] = $this->empresa->listar();
        $this->load->view('header');
        $this->load->view('empresa/promedio', $data);
        $this->load->view('volver');
        $this->load->view('footer');
    }


    public function calcular_promedio()
    {
        $id_empresa = $this->input->get('id_empresa');
        $promedio = $this->empresa->calcular_promedio($id_empresa);
        echo "<h3> Promedio: </h3>".$promedio;
    }

}
