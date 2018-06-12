<?php
class DocController{
    //SUBIR UN ARCHIVO
    public $expRegNum = '/^[0-9]*$/';
    public $expRegDate = '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/';
    public $expRegPdfFile = '/^.+\.((?:[pP][dD][fF]))$/';
    public $expRegNombres = '/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/';
    public function subirArchivoController(){
        if (isset($_POST['idNumeral']) && isset($_POST['fecha']) 
            && isset($_POST['idCategoria']) && isset($_FILES['doc'])) 
        {
            if (!empty($_POST['idNumeral']) && !empty($_POST['fecha']) 
                && !empty($_POST['idCategoria']) && !empty($_FILES['doc'])) 
            {
                if (preg_match($this->expRegNum, $_POST['idNumeral']) && 
                    preg_match($this->expRegNum, $_POST['idCategoria']) &&
                    preg_match($this->expRegDate, $_POST['fecha']) &&
                    preg_match($this->expRegPdfFile, $_FILES['doc']['name']) ) 
                {
                    $fechaDada = $_POST['fecha'];
                    $fechaFormateadaMes = strftime('%B', strtotime($fechaDada));
                    $fechaFormateadaAño = strftime('%Y', strtotime($fechaDada));
                    $urlDoc = 'views/docs/'.$_FILES['doc']['name'];
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
                    $respuesta = DocModel::
                    subirArchivoConCategoriaModel($datos, 'documentos');
                    if ($respuesta=='success') {
                        header('Location:notSubirArchivoOk');
                    }
                }else{
                    echo "	<script>
                                    swal({
                                      type: 'error',
                                      title: 'Oops...',
                                      text: 'No esta permitido el uso de caracteres especiales, ni archivos con formatos distintos a PDF',
                                    })
                                </script>";
                }
            }
        }

        
    }

    //
    public function subirArchivoSinCategoriaController()
    {
        if (isset($_POST['idNumeral2']) && isset($_POST['fecha2']) && isset($_FILES['doc2']) ) {
                if (preg_match($this->expRegNum, $_POST['idNumeral2']) &&
                    preg_match($this->expRegDate, $_POST['fecha2']) &&
                    preg_match($this->expRegPdfFile, $_FILES['doc2']['name'])) 
                {
                    $fechaDada = $_POST['fecha2'];
                    $fechaFormateadaMes = strftime('%B', strtotime($fechaDada));
                    $fechaFormateadaAño = strftime('%Y', strtotime($fechaDada));
                    $urlDoc = 'views/docs/'.$_FILES['doc2']['name'];
                    $nDoc = 12;
                    $status = 1;  
                    $idNumeral2 = $_POST['idNumeral2'];
                    $fecha2 = $_POST['fecha2'];
                    $doc2 = $_FILES['doc2']['name'];
                    $datos2 = array("idNumeral2" => $idNumeral2, "fecha2" => $fecha2, "year2" => $fechaFormateadaAño, "mes2" => $fechaFormateadaMes, "doc2" => $urlDoc, "n_doc2" => $nDoc, "status2" => $status);
                    var_dump($datos2);
                    $respuesta = DocModel::subirArchivoSinCategoriaModel($datos2,'documentos');
                    if ($respuesta =='success') {
                        header('Location:notSubirArchivoOk');
                    }
                }else{
                    echo "	<script>
                                swal({
                                    type: 'error',
                                    title: 'Oops...',
                                    text: 'No esta permitido el uso de caracteres especiales, ni archivos con formatos distintos a PDF',
                                })
                            </script>";
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