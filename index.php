<?php  
// CONTROLLERS
	include_once "controllers/TemplateController.php";
	include_once "controllers/EnlacesController.php";
	include_once "controllers/IngresoController.php";
	include_once "controllers/DatosUsuarioController.php";
	include_once "controllers/UsuariosController.php";
// MODELS
	include_once "models/Conexion.php";
	include_once "models/EnlacesModel.php";
	include_once "models/IngresoModel.php";
	include_once "models/DatosUsuarioModel.php";
	include_once "models/UsuariosModel.php";

	$template = new TemplateController();
	$template->includeTemplateController();
?>