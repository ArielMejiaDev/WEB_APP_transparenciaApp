<?php
require_once '../../controllers/DocController.php';
require_once '../../models/DocModel.php';
class DocAjax{
    public $id;
    public $title;
    public function validarDocAjax(){
        $dato = $this->id;
        $respuesta = DocController::validarDocAjaxController($dato);
        if ($respuesta['cuenta']>0) {
            echo '<option value="'.$respuesta['id'].'" >'.utf8_encode($respuesta['descripcion']).'</option>';
        }else{
            echo 'No hay';
        }
    }
    public function validarDocTitleAjax(){
        $dato = $this->title;
        $respuesta = DocController::validarDocTitleAjaxController($dato);
        echo $respuesta;
    }
}
if (isset($_POST['idNumeral'])) {
    $valDocAjax = new DocAjax();
    $valDocAjax->id = $_POST['idNumeral'];
    $valDocAjax->validarDocAjax();
}
if (isset($_POST['docTitle'])) {
    $docTitle = new DocAjax();
    $docTitle->title = $_POST['docTitle'];
    $docTitle->validarDocTitleAjax();
}