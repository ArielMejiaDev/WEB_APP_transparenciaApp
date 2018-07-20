<?php  
require_once "Conexion.php";
class EnlacesModel extends Conexion{
	public function loadEnlacesModel($enlace){
		if ($enlace == "inicio" || 
			$enlace == "main" || 
			$enlace == 'documentos') {
			$url = 'views/modules/'.$enlace.'.php';
		}else{
			$url = 'views/modules/inicio.php';
		}
		return $url;
	}
}
?>