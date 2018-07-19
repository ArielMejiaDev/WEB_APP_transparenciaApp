<?php  
require_once "Conexion.php";
class EnlacesModel extends Conexion{
	public function loadEnlacesModel($enlace){
		if ($enlace == "inicio" || 
			$enlace == 'main') {
			$url = 'views/modules/'.$enlace.'.php';
		}else{
			$url = 'views/modules/inicio.php';
		}
		return $url;
	}
}
?>