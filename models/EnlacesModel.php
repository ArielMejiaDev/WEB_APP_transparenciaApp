<?php  
require_once "Conexion.php";
class EnlacesModel extends Conexion{
	public function loadEnlacesModel($enlace){
		if ($enlace == "inicio" || 
			$enlace == "agregarUsuario" || 
			$enlace == "ListarUsuarios" ||
			$enlace == "header" || 
			$enlace == "sidebar" ||
			$enlace == "dashboard" ||
			$enlace == "preguntaSecreta" ) {
			$url = 'views/modules/'.$enlace.'.php';
		}else if($enlace == "index"){
			$url = 'views/modules/ingreso.php';
		}else if($enlace == "errorTresFallosIngreso"){
			$url = 'views/modules/ingreso.php';
		}else{
			$url = 'views/modules/ingreso.php';
		}
		return $url;
	}
}
?>