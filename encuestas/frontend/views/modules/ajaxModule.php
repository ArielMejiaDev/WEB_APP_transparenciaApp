<?php
require_once '../../controllers/AjaxModuleController.php';
require_once '../../models/AjaxModuleModel.php';
class AjaxModule
{
    public $idNumeral;
    public $year;
    public $mes;
    public function listarCategoriasAjax()
    {
        $datos = array('idNumeral'=>$this->idNumeral, 'year'=>$this->year, 'mes'=>$this->mes);
        $respuesta = AjaxModuleController::listarCategoriasAjaxController($datos);
        echo $respuesta;
    }
}
if (isset($_POST['idNumeral']) && !empty($_POST['idNumeral']) && 
    isset($_POST['year']) && !empty($_POST['year']) &&
    isset($_POST['mes']) && !empty($_POST['mes']))
{
    $buscarCat = new AjaxModule();
    $buscarCat->idNumeral = $_POST['idNumeral'];
    $buscarCat->year = $_POST['year'];
    $buscarCat->mes = $_POST['mes'];
    $buscarCat->listarCategoriasAjax();
}