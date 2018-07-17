<?php
require_once '../../controllers/DocController.php';
require_once '../../models/DocModel.php';
class DocAjax{
    public $id;
    public $title;
    public $idDoc;
    public $pdfTitleEditar;
    public function validarDocAjax(){
        $dato = $this->id;
        $respuesta = DocController::validarDocAjaxController($dato);
        //echo $respuesta;
        if (count($respuesta)>0) {
            foreach ($respuesta as $key => $value) {
                echo '<option value="'.$value['id'].'" >'.utf8_encode($value['descripcion']).'</option>';
            }
        }else{
            echo 'No hay';
        }
    }
    public function validarDocTitleAjax(){
        $dato = $this->title;
        $respuesta = DocController::validarDocTitleAjaxController($dato);
        echo $respuesta;
    }
    public function validarDocTitleEditarAjax(){
        $dato = $this->pdfTitleEditar;
        $idDoc = $this->idDoc;
        $respuesta = DocController::validarDocTitleEditarAjaxController($dato, $idDoc);
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
if (isset($_POST['pdfTitleEditar'])) {
    $docTitleEditar = new DocAjax();
    $docTitleEditar->pdfTitleEditar = $_POST['pdfTitleEditar'];
    $docTitleEditar->idDoc= $_POST['idDoc'];
    $docTitleEditar->validarDocTitleEditarAjax();
}
