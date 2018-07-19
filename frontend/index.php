<?php  
// CONTROLLERS
  include_once "controllers/TemplateController.php";
  include_once "controllers/EnlacesController.php";
  include_once "controllers/SidebarController.php";
  include_once "controllers/MainController.php";
// MODELS
  include_once "models/Conexion.php";
  include_once "models/EnlacesModel.php";
  include_once "models/SidebarModel.php";
  include_once "models/MainModel.php";

  $template = new TemplateController();
  $template->includeTemplateController();
?>