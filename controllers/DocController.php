<?php
class DocController{
    //SUBIR UN ARCHIVO
    public function subirArchivoController(){
        if (isset($_POST['idNumeral']) && isset($_POST['idCategoria']) && isset($_POST['fecha']) && isset($_FILES['doc'])) {
            if (!empty($_POST['idNumeral']) && !empty($_POST['idCategoria']) && !empty($_POST['fecha']) && !empty($_FILES['doc'])) {
                //var_dump($_FILES['doc']);
                $datos = array('idNumeral'=>$_POST['idNumeral'], 
                'idCategoria'=>$_POST['idCategoria'], 
                'fecha'=>$_POST['fecha'], 
                'doc'=>$_FILES['doc']);
                var_dump($datos);
                echo 'CON CATEGORIA';
            }
        }

        if (isset($_POST['idNumeral']) && isset($_POST['fecha']) && isset($_FILES['doc'])) {
            if (!empty($_POST['idNumeral']) && empty($_POST['idCategoria']) && !empty($_POST['fecha']) && !empty($_FILES['doc'])) {
                //var_dump($_FILES['doc']);
                $datos = array('idNumeral'=>$_POST['idNumeral'], 
                'fecha'=>$_POST['fecha'], 
                'doc'=>$_FILES['doc']);
                var_dump($datos);
                echo 'SIN CATEGORIA';
            }
        }
    }

    //cargar options con id del numeral y descripcion del numeral
    public function cargarOptionsNumeralesController(){
        $respuesta = DocModel::cargarOptionsNumeralesModel('numerales');
        //var_dump($respuesta);
        foreach ($respuesta as $key => $value) {
            echo '<option value="'.$value['id'].'">'.utf8_encode($value['descripcion']).'</option>';
        }
    }

    //DEVOLVER SI EXISTE O NO CATEGORIAS CON EL ID_NUMERAL QUE COINCIDAN CON EL ID ENVIADO
    public function validarDocAjaxController($dato){
        $respuesta = DocModel::validarDocAjaxModel($dato,'categorias');
        return $respuesta;
    }
}
?>