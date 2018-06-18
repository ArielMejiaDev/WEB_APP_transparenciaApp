<?php
class DocController{
    //SUBIR UN ARCHIVO
    public $expRegNum = '/^[0-9]*$/';
    public $expRegDate = '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/';
    public $expRegPdfFile = '/^.+\.((?:[pP][dD][fF]))$/';
    public $expRegNombres = '/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/';
    public function contarNumeralesDocsSubidosController($dato){
        $respuesta = DocModel::contarNumeralesDocsSubidosModel($dato,'documentos');
        $cuenta = $respuesta['cuenta'] + 1;
        return $cuenta;
    }
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
                    
                    $nDoc = $_POST['idNumeral'].'-'.$this->contarNumeralesDocsSubidosController($_POST['idNumeral']).'-'.date('Y');
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
                    $nDoc = $_POST['idNumeral2'].'-'.$this->contarNumeralesDocsSubidosController($_POST['idNumeral2']).'-'.date('Y');
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
							<a href="index.php?action=editarDoc&idDoc='.$value['idDoc'].'" class="btn btn-warning">Editar
							</a>
                        </td>
                        <td>
							<button href="'.$value['idDoc'].'" documento="'.substr($value["url_doc"], 11).'" id="eliminar'.$value['idDoc'].'" class="btn btn-success">Publicar
							</button>
                        </td>
                        <td>
							<button href="'.$value['idDoc'].'" usuario="'.$value['idUsuario'].'" id="eliminar'.$value['idDoc'].'" class="btn btn-danger">Rechazar
							</button>
						</td>
					</tr>';
        }
    }

    //cambia el status de un documento para que tenga status 3 de publicado 
    public function publicarDocController(){
        if (isset($_GET['publicar']) && !empty($_GET['publicar'])) {
            $dato = $_GET['publicar'];
            $respuesta = DocModel::publicarDocModel($dato,'documentos');
            if ($respuesta=='success') {
                header('Location:notPublicarDocOk');
            }
        }
    }

    public function listaNumeralesController(){
        $respuesta = DocModel::listaNumeralesModel('numerales');
        $lista = '';
        foreach ($respuesta as $key => $value) {
            $lista .= '<option value ="'.$value['id'].'">'.utf8_encode($value['descripcion']).'</option>';
        }
        return $lista;
    }

    //Crear formulario de edicion de documento subido al servidor
    public function crearFormEditarDocController(){
        if (isset($_GET['idDoc']) && !empty($_GET['idDoc'])) {
            $dato = $_GET['idDoc'];
            $respuesta = DocModel::crearFormEditarDocModel($dato,'documentos');
            //var_dump($respuesta);
            $listaNumerales = $this->listaNumeralesController();
            //$listaNumerales = '<option value="5">Estructura Organica</option>'.'<option value="6">Direccion y telefonos</option>';
            echo '<form onsubmit="return validarDocEditar()" style="border-radius: 0px;" class="form-horizontal group-border-dashed" onsubmit="" method="post" enctype=multipart/form-data>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="idNumeralEditar">Númeral</label>
                        <div class="col-sm-6">
                            <select name="idNumeralEditar" id="idNumeralEditar" class="form-control">
                                <option value="'.$respuesta['id_numeral'].'">'.utf8_encode($respuesta['descNumeral']).'</option>
                                '.$listaNumerales.'
                            </select>
                            <p id="avisoIdNumeralEditar" class="text-danger text-muted" style="display: none"></p>
                        </div>
                    </div>
                    <div class="form-group" id="formGroupCatEditar">
                        <label class="col-sm-3 control-label" for="idCategoriaEditar">Categoria</label>
                        <div class="col-sm-6">
                            <select name="idCategoriaEditar" id="idCategoriaEditar" class="form-control">
                            <option value="'.$respuesta['id_categoria'].'">'.utf8_encode($respuesta['descCategoria']).'</option>
                            </select>
                            <p id="avisoIdCategoriaEditar" class="text-danger text-muted" style="display: none"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="fechaEditar"> Fecha </label>
                        <div class="col-md-3 col-xs-7">
                            <div data-min-view="2" data-date-format="yyyy-mm-dd" class="input-group date datetimepicker">
                            <input id="fecha_docEditar" name="fecha_docEditar" size="16" type="text" value="'.$respuesta['fecha_doc'].'" class="form-control"><span class="input-group-addon btn btn-primary"><i class="icon-th mdi mdi-calendar"></i></span>
                            </div>
                            <p id="avisoFechaEditar" class="text-danger text-muted" style="display: none;"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6 col-md-offset-3">  
                        <label class="btn btn-rounded btn-space btn-danger btn-lg" for="docEditar"><strong><i class="icon icon-left mdi mdi-collection-pdf"></i> '.substr(utf8_encode($respuesta['url_doc']),11).'</strong></label>
                            <p id="avisoDocEditar" class="text-danger text-muted" style="display: block;">Si desea cambiar el documento, presione el boton rojo</p>
                        </div>
                        <div class="col-sm-6">
                            <input style="display: none" type="file" id="docEditar" name="docEditar">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6 col-md-offset-3">
                            <button type="submit" class="btn btn-info"><i class="icon mdi mdi-long-arrow-up"></i> Editar Documento</button>
                        </div>
                    </div>
                </form>';
            
        }
    }

    //ACTUALIZAR DOCUMENTO
    //public function actualizarDocController($idUsuario, $idDeptoUsuario){
            // if (isset($_GET['idDoc']) && isset($_POST['idNumeral']) && isset($_POST['fecha_doc']) 
            // && isset($_POST['idCategoria']) && isset($_FILES['doc'])) 
            // {
            //     if (!empty($_POST['idNumeral']) && !empty($_POST['fecha_doc']) 
            //         && !empty($_POST['idCategoria']) && !empty($_FILES['doc'])) 
            //     {
            //         if (preg_match($this->expRegNum, $_POST['idNumeral']) && 
            //             preg_match($this->expRegNum, $_POST['idCategoria']) &&
            //             preg_match($this->expRegDate, $_POST['fecha_doc']) &&
            //             preg_match($this->expRegPdfFile, $_FILES['doc']['name']) ) 
            //         {
            //             $nuevaRuta = 'views/docs/'.$_FILES['doc']['name'];
            //             $nombreTemporal = $_FILES['doc']['tmp_name'];
            //             move_uploaded_file($nombreTemporal,$nuevaRuta);
            //             $fechaPublicacion = $_POST['fecha_doc'];
            //             $fechaPublicacion = strtotime(date("Y-m-d", strtotime($fechaPublicacion)) . " +21 day");//convierte a tiempo unix la fecha anterior en el formato dado en la funcion date, puede ser asi o en letras o resumido F d M y otros parametros para cambiar la salida 
            //             $fechaPublicacion = date("Y-m-d", $fechaPublicacion);
            //             $fechaDada = $_POST['fecha_doc'];
            //             $fechaFormateadaMes = strftime('%B', strtotime($fechaDada));
            //             $fechaFormateadaAño = strftime('%Y', strtotime($fechaDada));
            //             $urlDoc = 'views/docs/'.$_FILES['doc']['name'];
                        
            //             $nDoc = $_POST['idNumeral'].'-'.$this->contarNumeralesDocsSubidosController($_POST['idNumeral']).'-'.date('Y');
            //             $status = (date('Y-m-d') < $fechaPublicacion)? 1 : 5 ;
            //             $datos = array('idNumeral'=>$_POST['idNumeral'],
            //                 'idDoc'=>$_GET['idDoc'],
            //                 'id_usuario'=>$idUsuario,
            //                 'id_departamento'=>$idDeptoUsuario,
            //                 'idCategoria'=>$_POST['idCategoria'],
            //                 'fecha_publicacion'=>$fechaPublicacion,
            //                 'fecha_doc'=>$_POST['fecha_doc'],
            //                 'year'=>$fechaFormateadaAño,
            //                 'mes'=>$fechaFormateadaMes,
            //                 'url_doc'=>$urlDoc,
            //                 'n_doc'=>$nDoc,
            //                 'status'=>$status);
            //             var_dump($datos);
            //             $respuesta = DocModel::
            //             actualizarArchivoConCategoriaModel($datos, 'documentos');
            //             if ($respuesta=='success') {
            //                 header('Location:notEditarArchivoOk');
            //             }
            //         }else{
            //             echo "	<script>
            //                             swal({
            //                             type: 'error',
            //                             title: 'Oops...',
            //                             text: 'No esta permitido el uso de caracteres especiales, ni archivos con formatos distintos a PDF',
            //                             })
            //                         </script>";
            //         }
            //     }else{
            //         echo "	<script>
            //                         swal({
            //                         type: 'error',
            //                         title: 'Oops...',
            //                         text: 'No pueden quedar campos vacios',
            //                         })
            //                     </script>";
            //     }
            // } 
    //}

    public function actualizarDocController($idUsuario, $idDeptoUsuario){
        if (isset($_GET['idDoc']) && isset($_POST['idNumeralEditar']) && isset($_POST['fecha_docEditar']) 
        && isset($_POST['idCategoriaEditar']) && isset($_FILES['docEditar'])) {
            echo "ACTUALIZAR";
        }
    }

    
}
?>