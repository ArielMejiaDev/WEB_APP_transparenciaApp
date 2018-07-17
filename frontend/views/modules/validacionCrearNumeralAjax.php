<?php
require '../../controllers/NumeralController.php';
require '../../models/NumeralModel.php';
class ValidacionNumeralAjax{
	public $numeral;
	public $id;
	public $descripcion;
	public function validarCrearNumeralAjax(){
		$dato = $this->numeral;
		$respuesta = NumeralController::validarCrearNumeralAjaxController(utf8_decode($dato));
		echo $respuesta;
	}
	public function validarEditarNumeralAjax(){
		$dato = $this->id;
		$respuesta = NumeralController::validarEditarNumeralAjaxController($dato);
		echo $respuesta;
	}
	public function validarEditarDescripcionNumeralAjax(){
		$dato = $this->descripcion;
		$respuesta = NumeralController::validarEditarDescripcionNumeralAjaxController($dato);
		echo $respuesta;
	}
}
if (isset($_POST['numeral'])) {
	$validarNumeral = new ValidacionNumeralAjax();
	$validarNumeral->numeral=$_POST['numeral'];
	$validarNumeral->validarCrearNumeralAjax();
}
if (isset($_POST['id'])) {
	$validarEditarNumeral = new ValidacionNumeralAjax();
	$validarEditarNumeral->id = $_POST['id'];
	$validarEditarNumeral->validarEditarNumeralAjax();
}
if (isset($_POST['descripcionEditarNumeral'])) {
	$validarEditarDescripcionNumeral = new ValidacionNumeralAjax();
	$validarEditarDescripcionNumeral->descripcion = $_POST['descripcionEditarNumeral'];
	$validarEditarDescripcionNumeral->validarEditarDescripcionNumeralAjax();
}