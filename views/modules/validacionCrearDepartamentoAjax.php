<?php
require_once "../../controllers/DepartamentosController.php";
require_once "../../models/DepartamentosModel.php";
class VerificarDepartamentosAjax{
	public $nombreDepto;
	public function validarDepartamentoAjax(){
		$dato = $this->nombreDepto;
		$respuesta = DepartamentosController::validarDepartamentoAjaxController($dato);
		echo $respuesta;
	}
}
if (isset($_POST['depto'])) {
	$verificarDepto = new VerificarDepartamentosAjax();
	$verificarDepto->nombreDepto = $_POST['depto'];
	$verificarDepto->validarDepartamentoAjax();
}