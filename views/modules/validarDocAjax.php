<?php
require_once '../../controllers/DocController.php';
require_once '../../models/DocModel.php';
class DocAjax{
    public $id;
    public function validarDocAjax(){
        $dato = $this->id;
        $respuesta = DocController::validarDocAjaxController($dato);
        if ($respuesta['cuenta']>0) {
            echo '<option value="'.$respuesta['id'].'" >'.utf8_encode($respuesta['descripcion']).'</option>';
        }else{
            echo 'No hay';
        }
    }
}
if (isset($_POST['idNumeral'])) {
    $valDocAjax = new DocAjax();
    $valDocAjax->id = $_POST['idNumeral'];
    $valDocAjax->validarDocAjax();
}