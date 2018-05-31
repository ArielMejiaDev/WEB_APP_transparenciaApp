<?php
require_once "../../controllers/CategoriaController.php";
require_once "../../models/CategoriaModel.php";
class NumeralesAjax{
	public $tabla;
	public function cargarOptionsNumeralesAjax(){
		$dato = $this->tabla;
		$respuesta = CategoriaController::cargarOptionsNumeralesAjaxController($dato);
		echo $respuesta;
	}
}
if (isset($_POST['tabla'])) {
	$cargarOpt = new NumeralesAjax();
	$cargarOpt->tabla=$_POST['tabla'];
	$cargarOpt->cargarOptionsNumeralesAjax();
}