<?php
require_once "../../controllers/CategoriaController.php";
require_once "../../models/CategoriaModel.php";
class ValCategoriaAjax{
	public $cat;
	public $idEditarCat;
	public $descripcion;
	public function validarCrearCategoriaAjax(){
		$dato = $this->cat;
		$respuesta = CategoriaController::validarCrearCategoriaAjaxController($dato);
		echo $respuesta;
	}
	public function validarEditarCategoriaAjax(){
		$dato = $this->idEditarCat;
		$respuesta = CategoriaController::validarEditarCategoriaAjaxController($dato);
		$respuesta;
	}
	public function validarDescripcionEditarCategoriaAjax(){
		$dato = $this->descripcion;
		$respuesta = CategoriaController::validarDescripcionEditarCategoriaAjaxController($dato);
		echo $respuesta;
	}
}
if (isset($_POST['categoria'])) {
	$valCrearCatAjax = new ValCategoriaAjax();
	$valCrearCatAjax->cat = $_POST['categoria'];
	$valCrearCatAjax->validarCrearCategoriaAjax();
}
if (isset($_POST['idEditarCat'])) {
	$valEditarCatAjax = new ValCategoriaAjax();
	$valEditarCatAjax->idEditarCat = $_POST['idEditarCat'];
	$valEditarCatAjax->validarEditarCategoriaAjax();
}
if (isset($_POST['descripcion'])) {
	$valDescEditarCatAjax = new ValCategoriaAjax();
	$valDescEditarCatAjax->descripcion = $_POST['descripcion'];
	$valDescEditarCatAjax->validarDescripcionEditarCategoriaAjax();
}