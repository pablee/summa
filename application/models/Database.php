<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require "Dbconfig.php";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

class database	
{
	public $conexion;
	public $validar;
					
	public function __construct(){}
	
	public function conectar() 
	{
		try {
			$this->conexion = mysqli_connect(server, user, password, database);
			$this->conexion->set_charset("utf8");
			mysqli_query($this->conexion, "SET NAMES 'utf8'");
		} catch (Exception $e) {
			error_log( print_r($e, true) );
			echo "\n Error: ".$e->getMessage()."\n";
		}
		/*
		$this->conexion = mysqli_connect(server, user, password, database)
		or die('No se pudo conectar a la base '  . mysqli_error($this->conexion));
		$this->conexion->set_charset("utf8");
		mysqli_query($this->conexion, "SET NAMES 'utf8'");
		*/
	}

	public function close()	
	{
		mysqli_close($this->conexion);
	}
}		
?>