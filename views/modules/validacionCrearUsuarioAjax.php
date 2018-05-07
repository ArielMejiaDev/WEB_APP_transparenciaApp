<?php
require_once "../../controllers/UsuariosController.php";
require_once "../../models/UsuariosModel.php";
class Ajax{
	public $usuario;
	public function validarUsuarioAjax(){
		$datos = $this->usuario;
		$respuesta = UsuariosController::validarUsuarioAjaxController($datos);
		// return $respuesta;
		echo $respuesta;
		//echo "usuario: ".$datos;

	}
}
$ajax = new Ajax();
$ajax->usuario = $_POST['usuario'];
$ajax->validarUsuarioAjax();
