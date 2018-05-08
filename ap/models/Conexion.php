<?php  
class Conexion{
	public function conectar(){
		$conexion = new PDO("mysql:host=localhost;dbname=transparencia_app","root","");
		return $conexion;
	}
}
?>