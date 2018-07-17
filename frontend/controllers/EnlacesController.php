<?php  
	class EnlacesController{
		public function loadEnlaces(){
			if (isset($_GET['action'])) {
				$enlace = $_GET['action'];
			}else{
				$enlace = "index";
			}
			$respuesta = EnlacesModel::loadEnlacesModel($enlace);
			include $respuesta;
		}
	}
?>