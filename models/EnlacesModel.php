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
			$enlace == "preguntaSecreta" ||
			$enlace == "formCambiarPassword" ||
			$enlace == "crearUsuario" ||
			$enlace == "listarUsuarios"||
			$enlace == "editarUsuario"||
			$enlace == "subirArchivos"||
			$enlace == "crearDepartamento"||
			$enlace == "editarDepartamento"||
			$enlace == "listarDepartamentos") {
			$url = 'views/modules/'.$enlace.'.php';
		}else if($enlace == "index"){
			$url = 'views/modules/ingreso.php';
		}else if($enlace == "errorTresFallosIngreso"){
			$url = 'views/modules/ingreso.php';
		}else if($enlace == "notCrearUsuarioOk"){
			$url = 'views/modules/crearUsuario.php';
		}else if($enlace == "notEliminarUsuarioOk"){
			$url = 'views/modules/listarUsuarios.php';
		}else if($enlace == "notEditarUsuarioOk"){
			$url = 'views/modules/listarUsuarios.php';
		}else if($enlace == "notCrearDeptoOk"){
			$url = 'views/modules/listarDepartamentos.php';
		}else{
			$url = 'views/modules/ingreso.php';
		}
		return $url;
	}
}
?>