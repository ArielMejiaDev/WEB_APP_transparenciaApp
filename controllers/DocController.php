<?php
class DocController{
    //SUBIR UN ARCHIVO
    public function subirArchivoController(){
        if (isset($_POST['idCategoria'])) {
            if (!empty($_POST['idCategoria'])) {
                echo "va llena";
                $fechaDada = $_POST['fecha'];
                $fechaFormateadaMes = strftime('%B', strtotime($fechaDada));
                $fechaFormateadaAño = strftime('%Y', strtotime($fechaDada));
                $urlDoc = 'public/docs/'.$_FILES['doc']['name'];
                $nDoc = 12;
                $status = 1;
                $datos = array('idNumeral'=>$_POST['idNumeral'],
                    'idCategoria'=>$_POST['idCategoria'],
                    'fecha'=>$_POST['fecha'],
                    'year'=>$fechaFormateadaAño,
                    'mes'=>$fechaFormateadaMes,
                    'url_doc'=>$urlDoc,
                    'n_doc'=>$nDoc,
                    'status'=>$status);
                    var_dump($datos);
                    $respuesta = DocModel::subirArchivoConCategoriaModel($datos,'documentos');
                    if ($respuesta=='success') {
                        header('Location:notSubirArchivoOk');
                    }
            }
        }

        
    }

    //
    public function subirArchivoSinCategoriaController(){
        if (isset($_POST['idNumeral2'])) {
            $datos = array('idNumeral'=>$_POST['idNumeral2']);
            var_dump($datos);
            $respuesta = DocModel::subirArchivoSinCategoriaModel($datos,'documentos');
            if ($respuesta=='success') {
                header('Location:notSubirArchivoOk');
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