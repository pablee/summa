<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require "Dbconfig.php";

class database	
{
	public $conexion;
	public $validar;
					
	public function __construct(){}
	
	public function conectar() 
	{
		$this->conexion = mysqli_connect(server, user, password, database)
		or die('No se pudo conectar a la base '  . mysqli_error($this->conexion));
		$this->conexion->set_charset("utf8");
		mysqli_query($this->conexion, "SET NAMES 'utf8'");
	}

	public function close()	
	{
		mysqli_close($this->conexion);
	}
}		
?>