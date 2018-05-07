<?php
require_once "../../controllers/UsuariosController.php";
require_once "../../models/UsuariosModel.php";
class Ajax{
	public $usuario;
	public $email;
	public function validarUsuarioAjax(){
		$datos = $this->usuario;
		$respuesta = UsuariosController::validarUsuarioAjaxController($datos);
		// return $respuesta;
		echo $respuesta;
		//echo "usuario: ".$datos;
	}

	public function validarEmailAjax(){
		$datos = $this->email;
		$respuesta = UsuariosController::validarEmailAjaxController($datos);
		echo $respuesta;
	}
}
if (isset($_POST['usuario'])) {
	$ajax = new Ajax();
	$ajax->usuario = $_POST['usuario'];
	$ajax->validarUsuarioAjax();
}

if (isset($_POST['email'])) {
	$validarEmail = new Ajax();
	$validarEmail->email=$_POST['email'];
	$validarEmail->validarEmailAjax();
}