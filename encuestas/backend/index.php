<?php  
// CONTROLLERS
  include_once "controllers/TemplateController.php";
  include_once "controllers/EnlacesController.php";
  include_once "controllers/IngresoController.php";
  include_once "controllers/DatosUsuarioController.php";
  include_once "controllers/UsuariosController.php";
  include_once "controllers/DepartamentosController.php";
  include_once "controllers/NumeralController.php";
  include_once "controllers/DashboardController.php";
  include_once "controllers/CategoriaController.php";
  include_once "controllers/DocController.php";
  include_once "controllers/NotificacionesController.php";
  include_once "controllers/InformesController.php";
  include_once "controllers/PdfController.php";
// MODELS
  include_once "models/Conexion.php";
  include_once "models/EnlacesModel.php";
  include_once "models/IngresoModel.php";
  include_once "models/DatosUsuarioModel.php";
  include_once "models/UsuariosModel.php";
  include_once "models/DepartamentosModel.php";
  include_once "models/NumeralModel.php";
  include_once "models/DashboardModel.php";
  include_once "models/CategoriaModel.php";
  include_once "models/DocModel.php";
  include_once "models/NotificacionesModel.php";
  include_once "models/InformesModel.php";

  
  $template = new TemplateController();
  $template->includeTemplateController();
?>