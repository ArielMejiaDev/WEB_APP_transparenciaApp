<?php
class DocController{
    //SUBIR UN ARCHIVO
    public $expRegNum = '/^[0-9]*$/';
    public $expRegDate = '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/';
    public $expRegPdfFile = '/^.+\.((?:[pP][dD][fF]))$/';
    public $expRegNombres = '/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/';
    public function subirArchivoController($idUsuario, $idDeptoUsuario){
        if (isset($_POST['idNumeral']) && isset($_POST['fecha_doc']) 
            && isset($_POST['idCategoria']) && isset($_FILES['doc'])) 
        {
            if (!empty($_POST['idNumeral']) && !empty($_POST['fecha_doc']) 
                && !empty($_POST['idCategoria']) && !empty($_FILES['doc'])) 
            {
                if (preg_match($this->expRegNum, $_POST['idNumeral']) && 
                    preg_match($this->expRegNum, $_POST['idCategoria']) &&
                    preg_match($this->expRegDate, $_POST['fecha_doc']) &&
                    preg_match($this->expRegPdfFile, $_FILES['doc']['name']) ) 
                {
                    $nuevaRuta = 'views/docs/'.$_FILES['doc']['name'];
                    $nombreTemporal = $_FILES['doc']['tmp_name'];
                    move_uploaded_file($nombreTemporal,$nuevaRuta);
                    $fechaPublicacion = $_POST['fecha_doc'];
                    $fechaPublicacion = strtotime(date("Y-m-d", strtotime($fechaPublicacion)) . " +21 day");//convierte a tiempo unix la fecha anterior en el formato dado en la funcion date, puede ser asi o en letras o resumido F d M y otros parametros para cambiar la salida 
                    $fechaPublicacion = date("Y-m-d", $fechaPublicacion);
                    $fechaDada = $_POST['fecha_doc'];
                    $fechaFormateadaMes = strftime('%B', strtotime($fechaDada));
                    $fechaFormateadaAño = strftime('%Y', strtotime($fechaDada));
                    $urlDoc = 'views/docs/'.$_FILES['doc']['name'];
                    $nDoc = 12;
                    $status = (date('Y-m-d') < $fechaPublicacion)? 1 : 5 ;
                    $datos = array('idNumeral'=>$_POST['idNumeral'],
                        'id_usuario'=>$idUsuario,
                        'id_departamento'=>$idDeptoUsuario,
                        'idCategoria'=>$_POST['idCategoria'],
                        'fecha_publicacion'=>$fechaPublicacion,
                        'fecha_doc'=>$_POST['fecha_doc'],
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
            }else{
                echo "	<script>
                                swal({
                                type: 'error',
                                title: 'Oops...',
                                text: 'No pueden quedar campos vacios',
                                })
                            </script>";
            }
        }

        
    }

    //
    public function subirArchivoSinCategoriaController($idUsuario, $idDeptoUsuario){
        if (isset($_POST['idNumeral2']) && isset($_POST['fecha_doc2']) && isset($_FILES['doc2']) ) {
                if (preg_match($this->expRegNum, $_POST['idNumeral2']) &&
                    preg_match($this->expRegDate, $_POST['fecha_doc2']) &&
                    preg_match($this->expRegPdfFile, $_FILES['doc2']['name'])) 
                {
                    $nuevaRuta = 'views/docs/'.$_FILES['doc2']['name'];
                    $archivoTemporal = $_FILES['doc2']['tmp_name'];
                    move_uploaded_file($archivoTemporal,$nuevaRuta);
                    $fechaPublicacion2 = $_POST['fecha_doc2'];
                    $fechaPublicacion2 = strtotime(date("Y-m-d", strtotime($fechaPublicacion2)) . " +21 day");//convierte a tiempo unix la fecha anterior en el formato dado en la funcion date, puede ser asi o en letras o resumido F d M y otros parametros para cambiar la salida 
                    $fechaPublicacion2 = date("Y-m-d", $fechaPublicacion2);
                    $fechaDada = $_POST['fecha_doc2'];
                    $fechaFormateadaMes = strftime('%B', strtotime($fechaDada));
                    $fechaFormateadaAño = strftime('%Y', strtotime($fechaDada));
                    $urlDoc = 'views/docs/'.$_FILES['doc2']['name'];
                    $nDoc = 12;
                    $status = (date('Y-m-d') < $fechaPublicacion2)? 1 : 5 ; 
                    $idNumeral2 = $_POST['idNumeral2'];
                    $fecha_doc2 = $_POST['fecha_doc2'];
                    $doc2 = $_FILES['doc2']['name'];
                    $datos2 = array('idNumeral2'=> $idNumeral2,
                    'id_usuario'=>$idUsuario,
                    'id_departamento'=>$idDeptoUsuario,
                    'fecha_publicacion2'=>$fechaPublicacion2,
                    'fecha_doc2' => $fecha_doc2,
                    'year2' => $fechaFormateadaAño,
                    'mes2' => $fechaFormateadaMes,
                    'doc2' => $urlDoc,
                    'n_doc2' => $nDoc,
                    'status2' => $status);
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

    //BUSCAR SI YA EXISTE EL TITULO DEL DOCUMENTO PDF
    public function validarDocTitleAjaxController($dato){
        $url_doc = 'views/docs/'.$dato;
        $respuesta = DocModel::validarDocTitleAjaxModel($url_doc,'documentos');
        $cuenta = $respuesta['cuenta'];
        if ($cuenta>0) {
            return 'existe';
        }else{
            return 'no existe';
        }
    }

    //LISTAR ARCHIVOS SUBIDOS GENERALES PARA ROL DE ADMIN O JEFE DE REDACCION
    public function listarDocumentosSubidosGeneralController(){
        $respuesta = DocModel::listarDocumentosSubidosGeneralModel();
        //var_dump($respuesta);
        foreach ($respuesta as $key => $value) {
            $etiquetaCategorias = ($value["categoriaDesc"]!="") ? '<td>'.utf8_encode($value["categoriaDesc"]).'</td>' : '<td>No tiene</td>' ;
            if ($value["status"]==1) {
                $descStatus = '<td class="text-warning">Pendiente</td>';
            }elseif ($value["status"]==2) {
                $descStatus = '<td class="text-primary">Aprobado</td>';
            }elseif ($value["status"]==3) {
                $descStatus = '<td class="text-success">Publicado</td>';
            }elseif ($value["status"]==4) {
                $descStatus = '<td class="text-danger">Rechazado</td>';
            }elseif ($value["status"]==5) {
                $descStatus = '<td class="text-danger">Extemporaneo</td>';
            }
            $descCat = ($value["idCategoria"]!=0) ? '<td>'.$value["idCategoria"].'</td>' : '<td class="text-warning">No tiene</td>' ;
            echo   '<tr class="odd gradeX">
                        <td>'.utf8_encode($value["numeralDesc"]).'</td>
                        '.$etiquetaCategorias.'
                        <td>'.substr($value["url_doc"], 11).'</td>
                        <td>'.$value["n_doc"].'</td>
                        '.$descStatus.'
                        <td>'.date("d-m-Y", strtotime($value["fecha_doc"])).'</td>
                        <td>'.$value["nombreDepto"].'</td>
                        <td>'.$value["usuario"].'</td>
                        <td>
							<a target="_blank" href="'.$value["url_doc"].'" class="btn btn-primary">Ver en linea
							</a>
                        </td>
                        <td>
							<a href="index.php?action=editarUsuario&id='.$value['idDoc'].'" class="btn btn-warning">Editar
							</a>
                        </td>
                        <td>
							<button href="'.$value['idDoc'].'" usuario="'.$value['idUsuario'].'" id="eliminar'.$value['idDoc'].'" class="btn btn-success">Publicar
							</button>
                        </td>
                        <td>
							<button href="'.$value['idDoc'].'" usuario="'.$value['idUsuario'].'" id="eliminar'.$value['idDoc'].'" class="btn btn-danger">Rechazar
							</button>
						</td>
					</tr>';
        }
    }
}
?>