<?php
require_once "../../controllers/UsuariosController.php";
require_once "../../models/UsuariosModel.php";
class Ajax{
	public $usuario;
	public $email;
	public $idEditar;
	public $usuarioEditar;
	public $idEditarMail;
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
	public function validarIdEditarUsuarioAjax(){
		$dato = $this->idEditar;
		$respuesta = UsuariosController::validarIdEditarUsuarioAjaxController($dato);
		echo $respuesta;
	}
	public function validarUsuarioEditarUsuarioAjax(){
		$dato = $this->usuarioEditar;
		$respuesta = UsuariosController::validarUsuarioEditarUsuarioAjaxController($dato);
		echo $respuesta;
	}
	public function validarIdMailEditarUsuarioAjax(){
		$dato = $this->idEditarMail;
		$respuesta = UsuariosController::validarIdMailEditarUsuarioAjaxController($dato);
		echo $respuesta;
		//echo $dato;
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
if (isset($_POST['idEditarUsuario'])) {
	$validarIdEditarUsuario = new Ajax();
	$validarIdEditarUsuario->idEditar = $_POST['idEditarUsuario'];
	$validarIdEditarUsuario->validarIdEditarUsuarioAjax();
}
if (isset($_POST['usuarioEditarUsuario'])) {
	$validarUsuarioEditarUsuario = new Ajax();
	$validarUsuarioEditarUsuario->usuarioEditar = $_POST['usuarioEditarUsuario'];
	$validarUsuarioEditarUsuario->validarUsuarioEditarUsuarioAjax();
}
if (isset($_POST['idEditarUsuarioMail'])) {
	$validarIdEditarUsuario2 = new Ajax();
	$validarIdEditarUsuario2->idEditarMail = $_POST['idEditarUsuarioMail'];
	$validarIdEditarUsuario2->validarIdMailEditarUsuarioAjax();
}