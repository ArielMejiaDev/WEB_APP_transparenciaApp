<?php
require_once "../../controllers/UsuariosController.php";
require_once "../../models/UsuariosModel.php";
class cargarOptionsAjax{
	public function cargarOptions(){
		$respuesta = UsuariosController::crearSelectDeptosController();
		echo $respuesta;
	}
}
$crearOptions = new cargarOptionsAjax();
$crearOptions->cargarOptions();