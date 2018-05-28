<?php
require '../../controllers/NumeralController.php';
require '../../models/NumeralModel.php';
class ValidacionNumeralAjax{
	public $numeral;
	public function validarCrearNumeralAjax(){
		$dato = $this->numeral;
		$respuesta = NumeralController::validarCrearNumeralAjaxController(utf8_decode($dato));
		echo $respuesta;
	}
}
if (isset($_POST['numeral'])) {
	$validarNumeral = new ValidacionNumeralAjax();
	$validarNumeral->numeral=$_POST['numeral'];
	$validarNumeral->validarCrearNumeralAjax();
}