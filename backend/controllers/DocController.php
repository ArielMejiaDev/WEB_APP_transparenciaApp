<?php
class DocController{
    //SUBIR UN ARCHIVO
    public $expRegNum = '/^[0-9]*$/';
    public $expRegDate = '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/';
    public $expRegPdfFile = '/^.+\.((?:[pP][dD][fF]))$/';
    public $expRegNombres = '/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/';
    public $expRegTexto = '/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9,.!? ]*$/';
    public function contarNumeralesDocsSubidosController($dato)
    {
        $respuesta = DocModel::contarNumeralesDocsSubidosModel($dato,'documentos');
        $cuenta = $respuesta['cuenta'] + 1;
        return $cuenta;
    }
    public function subirArchivoController($idUsuario, $idDeptoUsuario)
    {
        if (isset($_POST['idNumeral']) && isset($_POST['fecha_doc']) 
            && isset($_POST['idCategoria']) && isset($_FILES['doc'])) 
        {
            if (!empty($_POST['idNumeral']) && !empty($_POST['fecha_doc']) 
                && !empty($_POST['idCategoria']) && !empty($_FILES['doc'])) 
            {
                if (preg_match($this->expRegNum, $_POST['idNumeral']) && 
                    preg_match($this->expRegNum, $_POST['idCategoria']) &&
                    preg_match($this->expRegDate, $_POST['fecha_doc']) &&
                    preg_match($this->expRegPdfFile, $_FILES['doc']['name'])) 
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
                    //var_dump($datos);
                    $respuesta = DocModel::
                    subirArchivoConCategoriaModel($datos, 'documentos');
                    if ($respuesta=='success')
                    {
                        $datosVitacora = array('id_usuario'=>$idUsuario, 'desc_actividad'=>'Subio un nuevo documento');
                        $vitacora = $this->vitacoraSubirDocController($datosVitacora);
                        $buscarReceptor = $this->buscarReceptorController($idDeptoUsuario);
                        
                            foreach ($buscarReceptor as $key => $value)
                            {
                                $receptor = $value['id'];
                                $datosMsj = array('remitente'=>(int)$idUsuario, 
                                            'receptor'=>$receptor, 
                                            'contenido'=>'Subio un documento', 
                                            'status'=>1, 
                                            'n_doc'=>$nDoc);
                                $msj = $this->insertarMsjController($datosMsj);
                            }
                            //var_dump($datosMsj);
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
    //SE SUBEN ARCHIVOS SIN TENER SUBCATEGORIAS
    public function subirArchivoSinCategoriaController($idUsuario, $idDeptoUsuario)
    {
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
    public function cargarOptionsNumeralesController()
    {
        $respuesta = DocModel::cargarOptionsNumeralesModel('numerales');
        //var_dump($respuesta);
        foreach ($respuesta as $key => $value) {
            echo '<option value="'.$value['id'].'">'.utf8_encode($value['descripcion']).'</option>';
        }
    }
    //DEVOLVER SI EXISTE O NO CATEGORIAS CON EL ID_NUMERAL QUE COINCIDAN CON EL ID ENVIADO
    public function validarDocAjaxController($dato)
    {
        $respuesta = DocModel::validarDocAjaxModel($dato,'categorias');
        return $respuesta;
    }
    //BUSCAR SI YA EXISTE EL TITULO DEL DOCUMENTO PDF
    public function validarDocTitleAjaxController($dato)
    {
        $url_doc = 'views/docs/'.$dato;
        $respuesta = DocModel::validarDocTitleAjaxModel($url_doc,'documentos');
        $cuenta = $respuesta['cuenta'];
        if ($cuenta>0) {
            return 'existe';
        }else{
            return 'no existe';
        }
    }
    //VALIDAR QUE NO INGRESE UN PDF YA EXISTENTE EN LA BD EN EL FORMULARIO DE EDITAR DOC
    public function validarDocTitleEditarAjaxController($dato, $idDoc)
    {
        $url_doc = 'views/docs/'.$dato;
        $respCuenta = DocModel::validarDocTitleAjaxModel($url_doc, 'documentos');
        $cuenta = $respCuenta['cuenta'];
        $archivoEncontrado = DocModel::buscarUrlDocModel($idDoc, 'documentos');
        $archivo = $archivoEncontrado['url_doc'];
        if ($url_doc == $archivo)
        {
            return 'no existe';
        }else{
            if ($cuenta>0)
            {
                return 'existe';
            }else{
                return 'no existe';
            }
        }
    }
    //LISTAR ARCHIVOS SUBIDOS GENERALES PARA ROL DE ADMIN O JEFE DE REDACCION
    public function listarDocumentosSubidosGeneralController($rol)
    {
        $respuesta = DocModel::listarDocumentosSubidosGeneralModel();
        //var_dump($respuesta);
        foreach ($respuesta as $key => $value)
        {
            $etiquetaCategorias = ($value["categoriaDesc"]!="") ? '<td>'.utf8_encode($value["categoriaDesc"]).'</td>' : '<td>No tiene</td>' ;
            if ($value["status"]==1)
            {
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
            $editar = ($rol=='editor') ? '' : '<td>
            <a 
                href="index.php?action=editarDoc&idDoc='.$value['idDoc'].'" 
                class="btn btn-warning">
                Editar
            </a>
            </td>' ;
            $aprobar = ($rol=='editor' || $rol=='redactor') ? '' : '<td>
                <button 
                    href="'.$value['idDoc'].'" 
                    documento="'.substr($value["url_doc"], 11).'" 
                    id="aprobar'.$value['idDoc'].'" 
                    class="btn btn-color btn-twitter">
                    Aprobar
                </button>
            </td>' ;
            $aprobarVacio = '<td>
            <button 
                class="btn btn-default">
                No aplica
            </button>
            </td>' ;
            $publicar = ($rol=='jefeRedaccion' || $rol=='redactor') ? '' : '<td>
            <button 
                href="'.$value['idDoc'].'" 
                documento="'.substr($value["url_doc"], 11).'" 
                id="eliminar'.$value['idDoc'].'" 
                class="btn btn-success">
                Publicar
            </button>
            </td>' ;
            $publicarVacio = '<td>
            <button 
                class="btn btn-default">
                No aplica
            </button>
            </td>' ;
            $rechazar = ($rol=='redactor') ? '' : '<td>
            <a 
                href="index.php?action=rechazarDoc&idDoc='.$value['idDoc'].'" 
                class="btn btn-danger">
                Rechazar
            </a>
            </td>' ;
            $etiquetaPublicar = ($value["status"]!=2) ? $publicarVacio : $publicar ;
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
                            <a 
                                target="_blank" href="'.$value["url_doc"].'" 
                                class="btn btn-primary">
                                Ver en linea
							</a>
                        </td>
                        '.$editar.'
                        '.$aprobar.'
                        '.$etiquetaPublicar.'
                        '.$rechazar.'
					</tr>';
        }
    }
    //LISTAR ARCHIVOS SUBIDOS POR USUARIO
    public function listarDocumentosSubidosPorUsuarioController($rol, $idUsuario)
    {
        $respuesta = DocModel::listarDocumentosSubidosPorUsuarioModel($idUsuario);
        //var_dump($respuesta);
        foreach ($respuesta as $key => $value)
        {
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
            $editar = ($rol=='editor') ? '' : '<td>
            <a 
                href="index.php?action=editarDoc&idDoc='.$value['idDoc'].'" 
                class="btn btn-warning">
                Editar
            </a>
            </td>' ;
                $aprobar = ($rol=='editor' || $rol=='redactor') ? '' : '<td>
                <button 
                    href="'.$value['idDoc'].'" 
                    documento="'.substr($value["url_doc"], 11).'" 
                    id="aprobar'.$value['idDoc'].'" 
                    class="btn btn-color btn-twitter">
                    Aprobar
                </button>
            </td>' ;
            $publicar = ($rol=='jefeRedaccion' || $rol=='redactor') ? '' : '<td>
            <button 
                href="'.$value['idDoc'].'" 
                documento="'.substr($value["url_doc"], 11).'" 
                id="eliminar'.$value['idDoc'].'" 
                class="btn btn-success">
                Publicar
            </button>
            </td>' ;
                $rechazar = ($rol=='redactor') ? '' : '<td>
                <a 
                    href="index.php?action=rechazarDoc&idDoc='.$value['idDoc'].'" 
                    class="btn btn-danger">
                    Rechazar
                </a>
            </td>' ;
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
                            <a 
                                target="_blank" href="'.$value["url_doc"].'" 
                                class="btn btn-primary">
                                Ver en linea
							</a>
                        </td>
                        '.$editar.'
                        '.$aprobar.'
                        '.$publicar.'
                        '.$rechazar.'
					</tr>';
        }
    }
    //LISTAR DOCUMENTOS SUBIDOS POR DEPARTAMENTO
    public function listarDocumentosSubidosPorDeptoController($rol, $idDeptoUsuario)
    {
        $respuesta = DocModel::listarDocumentosSubidosPorDeptoModel($idDeptoUsuario);
        //var_dump($respuesta);
        foreach ($respuesta as $key => $value)
        {
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
            $editar = ($rol=='editor') ? '' : '<td>
            <a 
                href="index.php?action=editarDoc&idDoc='.$value['idDoc'].'" 
                class="btn btn-warning">
                Editar
            </a>
            </td>' ;
                $aprobar = ($rol=='editor' || $rol=='redactor') ? '' : '<td>
                <button 
                    href="'.$value['idDoc'].'" 
                    documento="'.substr($value["url_doc"], 11).'" 
                    id="aprobar'.$value['idDoc'].'" 
                    class="btn btn-color btn-twitter">
                    Aprobar
                </button>
            </td>' ;
            $aprobarVacio = '<td>
                                <button 
                                    class="btn btn-default">
                                    No aplica
                                </button>
                            </td>' ;
            $publicar = ($rol=='jefeRedaccion' || $rol=='redactor') ? '' : '<td>
            <button 
                href="'.$value['idDoc'].'" 
                documento="'.substr($value["url_doc"], 11).'" 
                id="eliminar'.$value['idDoc'].'" 
                class="btn btn-success">
                Publicar
            </button>
            </td>' ;
                $rechazar = ($rol=='redactor') ? '' : '<td>
                <a 
                    href="index.php?action=rechazarDoc&idDoc='.$value['idDoc'].'" 
                    class="btn btn-danger">
                    Rechazar
                </a>
            </td>' ;
            $etiquetaAprobar = ($value["status"]==5) ? $aprobarVacio : $aprobar ;
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
                            <a 
                                target="_blank" href="'.$value["url_doc"].'" 
                                class="btn btn-primary">
                                Ver en linea
							</a>
                        </td>
                        '.$editar.'
                        '.$etiquetaAprobar.'
                        '.$publicar.'
                        '.$rechazar.'
					</tr>';
        }
    }
    //LISTAR DOCUMENTOS EXTEMPORANEOS
    public function listarDocumentosExtemporaneosController()
    {
        $respuesta = DocModel::listarDocumentosExtemporaneosModel();
        //var_dump($respuesta);
        foreach ($respuesta as $key => $value) {
            $etiquetaCategorias = ($value["categoriaDesc"]!="") ? '<td>'.utf8_encode($value["categoriaDesc"]).'</td>' : '<td>No tiene</td>' ;
            if ($value["status"]==5) {
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
                            <a 
                                target="_blank" href="'.$value["url_doc"].'" 
                                class="btn btn-primary">
                                Ver en linea
							</a>
                        </td>
                        <td>
                            <a 
                                href="index.php?action=activarDoc&idDoc='.$value['idDoc'].'" 
                                class="btn btn-warning">
                                Activar
							</a>
                        </td>
					</tr>';
        }
    }
    //activar Doc
    public function activarDocController($idUsuario, $idDeptoUsuario)
    {
        if (isset($_GET['idDoc']) && !empty($_GET['idDoc']) && isset($_POST['observaciones']) && !empty($_POST['observaciones'])) 
        {
            if (preg_match('/[^a-zA-Z\d]/',$_POST['observaciones']) && 
                preg_match($this->expRegNum,$_GET['idDoc']))
            {
                $datos = array('idDoc'=>$_GET['idDoc'], 'observaciones'=>utf8_decode($_POST['observaciones']));
                $respuesta = DocModel::activarDocModel($datos, 'documentos');
                if ($respuesta=='success')
                {
                    $datosVitacora = array('id_usuario'=>$idUsuario, 'desc_actividad'=>'Activo un documento');
                    $vitacora = $this->vitacoraSubirDocController($datosVitacora);
                    $buscarReceptor = $this->buscarReceptoresJefesYEditoresController($idDeptoUsuario);
                    $nDoc = $this->buscarNdocController($_GET['idDoc']);
                    $autor = $this->buscarAutorController($_GET['idDoc']);
                    $exist = false;
                    foreach ($buscarReceptor as $key => $value)
                    {
                        if (in_array($autor,$value))
                        {
                            $exist = true;
                        }
                    }
                    if (!$exist){ $buscarReceptor[] = array('id'=>$autor);}
                    foreach ($buscarReceptor as $key => $value)
                    {
                        $receptor = $value['id'];
                        $datosMsj[] = array('remitente'=>(int)$idUsuario, 
                                    'receptor'=>$receptor, 
                                    'contenido'=>'Activo un documento', 
                                    'status'=>1, 
                                    'n_doc'=>$nDoc);
                    }
                    foreach ($datosMsj as $key => $value)
                        {
                            $comprobacion = $this->comprobacionMsjController($value['receptor'], $value['n_doc']);
                            if ($comprobacion=='insertar')
                            {
                                $msj = $this->insertarMsjController($value);
                            }elseif($comprobacion=='actualizar')
                            {
                                $msj = $this->actualizarMsjController($value);
                            }
                        }
                    header('Location:notActivarDocOk');
                }
            }else{
                echo "	<script>
                            swal({
                                type: 'error',
                                title: 'Oops...',
                                text: 'No esta permitido el uso de caracteres especiales',
                            })
                        </script>";
            }
        }
    }
    //aprobar documento
    public function aprobarDocController($idUsuario, $idDeptoUsuario)
    {
        if (isset($_GET['aprobar']) && !empty($_GET['aprobar']) )
        {
            $dato = $_GET['aprobar'];
            $respuesta = DocModel::aprobarDocModel($dato, 'documentos');
            if ($respuesta=='success')
            {
                $datosVitacora = array('id_usuario'=>$idUsuario, 'desc_actividad'=>'Aprobo un documento');
                $vitacora = $this->vitacoraSubirDocController($datosVitacora);
                $buscarReceptor = $this->buscarReceptoresJefesYEditoresController($idDeptoUsuario);
                $nDoc = $this->buscarNdocController($_GET['aprobar']);
                $autor = $this->buscarAutorController($_GET['aprobar']);
                $exist = false;
                foreach ($buscarReceptor as $key => $value)
                {
                    if (in_array($autor,$value))
                    {
                        $exist = true;
                    }
                }
                if (!$exist){ $buscarReceptor[] = array('id'=>$autor);}
                foreach ($buscarReceptor as $key => $value)
                {
                    $receptor = $value['id'];
                    $datosMsj[] = array('remitente'=>(int)$idUsuario, 
                                'receptor'=>$receptor, 
                                'contenido'=>'Aprobo un documento', 
                                'status'=>1, 
                                'n_doc'=>$nDoc);
                }
                foreach ($datosMsj as $key => $value)
                {
                    $comprobacion = $this->comprobacionMsjController($value['receptor'], $value['n_doc']);
                    if ($comprobacion=='insertar')
                    {
                        $msj = $this->insertarMsjController($value);
                    }elseif($comprobacion=='actualizar')
                    {
                        $msj = $this->actualizarMsjController($value);
                    }
                }
                //var_dump($datosMsj);
                header('Location:notAprobarDocOk');
            }
        }
    }
    //cambia el status de un documento para que tenga status 3 de publicado 
    public function publicarDocController($idUsuario)
    {
        if (isset($_GET['publicar']) && !empty($_GET['publicar'])) {
            $dato = $_GET['publicar'];
            $respuesta = DocModel::publicarDocModel($dato,'documentos');
            if ($respuesta=='success') {
                $datosVitacora = array('id_usuario'=>$idUsuario, 'desc_actividad'=>'Publico un documento');
                $vitacora = $this->vitacoraSubirDocController($datosVitacora);
                $idDepto = $this->buscaridDeptoDocController($_GET['publicar']);
                $buscarReceptor = $this->buscarReceptoresJefesYEditoresController($idDepto);
                $nDoc = $this->buscarNdocController($_GET['publicar']);
                $autor = $this->buscarAutorController($_GET['publicar']);
                $exist = false;
                foreach ($buscarReceptor as $key => $value)
                {
                    if (in_array($autor,$value))
                    {
                        $exist = true;
                    }
                }
                if (!$exist){ $buscarReceptor[] = array('id'=>$autor);}
                foreach ($buscarReceptor as $key => $value)
                {
                    $receptor = $value['id'];
                    $datosMsj[] = array('remitente'=>(int)$idUsuario, 
                                'receptor'=>$receptor, 
                                'contenido'=>'Publico un documento', 
                                'status'=>1, 
                                'n_doc'=>$nDoc);
                }
                foreach ($datosMsj as $key => $value)
                {
                    $comprobacion = $this->comprobacionMsjController($value['receptor'], $value['n_doc']);
                    if ($comprobacion=='insertar')
                    {
                        $msj = $this->insertarMsjController($value);
                    }elseif($comprobacion=='actualizar')
                    {
                        $msj = $this->actualizarMsjController($value);
                    }
                }
                header('Location:notPublicarDocOk');
            }
        }
    }
    public function listaNumeralesController()
    {
        $respuesta = DocModel::listaNumeralesModel('numerales');
        $lista = '';
        foreach ($respuesta as $key => $value) {
            $lista .= '<option value ="'.$value['id'].'">'.utf8_encode($value['descripcion']).'</option>';
        }
        return $lista;
    }
    //Crear formulario de edicion de documento subido al servidor
    public function crearFormEditarDocController()
    {
        if (isset($_GET['idDoc']) && !empty($_GET['idDoc'])) {
            $dato = $_GET['idDoc'];
            $respuesta = DocModel::crearFormEditarDocModel($dato,'documentos');
            //var_dump($respuesta);
            $listaNumerales = $this->listaNumeralesController();
            //$listaNumerales = '<option value="5">Estructura Organica</option>'.'<option value="6">Direccion y telefonos</option>';
            echo '<form onsubmit="return validarDocEditar()" style="border-radius: 0px;" class="form-horizontal group-border-dashed" onsubmit="" method="post" enctype=multipart/form-data>
                    <div class="form-group">
                        <input type="hidden" name="idDoc" id="idDoc" value="'.$_GET['idDoc'].'" >
                        <input type="hidden" name="n_doc" id="n_doc" value="'.$respuesta['n_doc'].'" >
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
    //RECIVE EL ID DEL DOC Y DEVUELVE LA URL DEL DOC EL PATH 
    public function getUrlDocController($idDoc)
    {
        $respuesta = DocModel::getUrlDocModel($idDoc, 'documentos');
        $url = $respuesta['url_doc'];
        return $url;
    }
    //ACTUALIZAR DOCUMENTOS AL EDITARLOS EVALUA SI SE AGREGO UN DOC O NO Y
    //UTILIZA DIFERENTE MODELO SEGUN SEA EL CASO DE ACTUALIZAR O NO LOS 
    //REGISTROS CON EL DOC O SIN EL DOC
    public function actualizarDocController($idUsuario, $idDeptoUsuario)
    {
        //SCRIPT PARA ACTUALIZAR UN REGISTRO CUANDO SI SE CAMBIA EL DOCUMENTO EN EL FORMULARIO DE
        //EDITAR DOCUMENTO
        if (
            isset($_GET['idDoc']) && 
            isset($_POST['idNumeralEditar']) && 
            isset($_POST['idCategoriaEditar']) && 
            isset($_POST['fecha_docEditar']) && 
            isset($_FILES['docEditar']) 
            )
        {
            if (
                !empty($_GET['idDoc']) && 
                !empty($_POST['idNumeralEditar']) && 
                !empty($_POST['idCategoriaEditar']) && 
                !empty($_POST['fecha_docEditar']) && 
                !empty($_FILES['docEditar']['name']) 
                ) 
            {
                $doc = $this->getUrlDocController($_GET['idDoc']);
                unlink($doc);
                $year = strftime('%Y',strtotime($_POST['fecha_docEditar']));
                $mes = strftime('%B',strtotime($_POST['fecha_docEditar']));
                $url = 'views/docs/'.$_FILES['docEditar']['name'];
                $datos = array(
                    'idDeptoUsuario'=>(int)$idDeptoUsuario,  
                    'idNumeralEditar'=>(int)$_POST['idNumeralEditar'], 
                    'idCategoriaEditar'=>(int)$_POST['idCategoriaEditar'], 
                    'fecha_docEditar'=>$_POST['fecha_docEditar'],
                    'year'=>$year, 
                    'mes'=>$mes, 
                    'url_docEditar'=>$url, 
                    'status'=>1,  
                    'idDoc'=>(int)$_GET['idDoc']
                    );
                $respuesta = DocModel::actualizarDocConCatConDocModel($datos, 'documentos');
                if ($respuesta == 'success')
                {
                    $nombreTemporal = $_FILES['docEditar']['tmp_name'];
                    move_uploaded_file($nombreTemporal, $url);
                    $datosVitacora = array('id_usuario'=>$idUsuario, 'desc_actividad'=>'Edito un documento');
                    $vitacora = $this->vitacoraSubirDocController($datosVitacora);
                    $nDoc = $_POST['n_doc'];
                    $buscarReceptor = $this->buscarReceptorController($idDeptoUsuario);
                    $totalUsuariosNotificados = $this->buscarUsuariosNotificadosController($nDoc);
                    if (count($totalUsuariosNotificados) > count($buscarReceptor))
                    {
                        foreach ($totalUsuariosNotificados as $key => $value)
                        {
                            $receptor = $value['receptor'];
                            $datosMsj[] = array('remitente'=>(int)$idUsuario, 
                                        'receptor'=>$receptor, 
                                        'contenido'=>'Actualizo un documento', 
                                        'n_doc'=>$nDoc);
                        }
                        foreach ($datosMsj as $key => $value)
                        {
                            $msj = $this->actualizarMsjController($value);
                        }
                        //MUESTRA LOS DATOS QUE SE VAN A ACTUALIZAR INCLUYENDO A TODOS LOS USUARIOS QUE RECIBIERON NOTIFICACIONES
                        //SOBRE EL MISMO DOCUMENTO ANTERIORMENTE
                        var_dump($datosMsj);
                        header('Location:notEditarArchivoOk');
                    }else{
                        foreach ($buscarReceptor as $key => $value)
                        {
                            $receptor = $value['id'];
                            $datosMsj[] = array('remitente'=>(int)$idUsuario, 
                                        'receptor'=>$receptor, 
                                        'contenido'=>'Actualizo un documento', 
                                        'n_doc'=>$nDoc);
                            $msj = $this->actualizarMsjController($datosMsj);
                        }
                    }
                    var_dump($datosMsj);
                    header('Location:notEditarArchivoOk');
                }
                //echo 'actualizar datos cambiando el documento';
            }
        }

        //SCRIPT PARA ACTUALIZAR UN REGISTRO CUANDO NO SE CAMBIA EL DOCUMENTO EN EL FORMULARIO DE
        //EDITAR DOCUMENTO
        if (
            isset($_GET['idDoc']) && 
            isset($_POST['idNumeralEditar']) && 
            isset($_POST['idCategoriaEditar']) && 
            isset($_POST['fecha_docEditar'])
            ) 
        {
            if (
                !empty($_GET['idDoc']) && 
                !empty($_POST['idNumeralEditar']) && 
                !empty($_POST['idCategoriaEditar']) && 
                !empty($_POST['fecha_docEditar']) &&
                empty($_FILES['docEditar']['name'])
                ) 
            {
                $year = strftime('%Y',strtotime($_POST['fecha_docEditar']));
                $mes = strftime('%B',strtotime($_POST['fecha_docEditar']));
                $datosSinDoc = array(
                    'idDeptoUsuario'=>(int)$idDeptoUsuario,
                    'idDoc'=>(int)$_GET['idDoc'], 
                    'idNumeralEditar'=>(int)$_POST['idNumeralEditar'], 
                    'idCategoriaEditar'=>(int)$_POST['idCategoriaEditar'], 
                    'fecha_docEditar'=>$_POST['fecha_docEditar'],
                    'year'=>$year, 
                    'status'=>1, 
                    'mes'=>$mes
                    );
                $respuesta = DocModel::actualizarDocConCatSinDocModel($datosSinDoc, 'documentos');
                if ($respuesta == 'success')
                {
                    $datosVitacora = array('id_usuario'=>$idUsuario, 'desc_actividad'=>'Edito un documento');
                    $vitacora = $this->vitacoraSubirDocController($datosVitacora);
                    $buscarReceptor = $this->buscarReceptorController($idDeptoUsuario);
                    $nDoc = $_POST['n_doc'];
                    $totalUsuariosNotificados = $this->buscarUsuariosNotificadosController($nDoc);
                    if (count($totalUsuariosNotificados) > count($buscarReceptor))
                    {
                        foreach ($totalUsuariosNotificados as $key => $value)
                        {
                            $receptor = $value['receptor'];
                            $datosMsj[] = array('remitente'=>(int)$idUsuario, 
                                        'receptor'=>$receptor, 
                                        'contenido'=>'Actualizo un documento', 
                                        'n_doc'=>$nDoc);
                        }
                        foreach ($datosMsj as $key => $value)
                        {
                            $msj = $this->actualizarMsjController($value);
                        }
                        //MUESTRA LOS DATOS QUE SE VAN A ACTUALIZAR INCLUYENDO A TODOS LOS USUARIOS QUE RECIBIERON NOTIFICACIONES
                        //SOBRE EL MISMO DOCUMENTO ANTERIORMENTE
                        var_dump($datosMsj);
                        header('Location:notEditarArchivoOk');
                    }else{
                        foreach ($buscarReceptor as $key => $value)
                        {
                            $receptor = $value['id'];
                            $datosMsj[] = array('remitente'=>(int)$idUsuario, 
                                        'receptor'=>$receptor, 
                                        'contenido'=>'Actualizo un documento', 
                                        'n_doc'=>$nDoc);
                        }
                        foreach ($datosMsj as $key => $value)
                        {
                            $msj = $this->actualizarMsjController($value);
                        }
                        //MUESTRA UNICAMENTE LOS USUARIOS QUE SON PARTE DEL PROCESO DE EDICION Y QUE SE LES ACTUALIZARA
                        //LAS NOTIFICACIONES ESTA APLICA CUANDO SE EDITA UN DOCUMENTO QUE NO HA SIDO RECHAZADO
                        var_dump($datosMsj);
                        header('Location:notEditarArchivoOk');
                    }
                }
                echo 'actualizar datos sin cambiar el documento';
            }
        }

    }
    //RECHAZAR DOCUMENTOS
    public function rechazarDocController($idUsuario, $idDeptoUsuario)
    {
        if (isset($_GET['idDoc']) && isset($_POST['justificacion']))
        {
            if (!empty($_GET['idDoc']) && !empty($_POST['justificacion']))
            {
                if (preg_match($this->expRegTexto,  $_POST['justificacion']))
                {
                    $datos = array('idDoc'=>$_GET['idDoc'], 'justificacion'=>$_POST['justificacion']);
                    $respuesta = DocModel::rechazarDocModel($datos, 'documentos');
                    if ($respuesta == 'success')
                    {
                        $datosVitacora = array('id_usuario'=>$idUsuario, 'desc_actividad'=>'Rechazo un documento');
                        $vitacora = $this->vitacoraSubirDocController($datosVitacora);
                        $buscarReceptor = $this->buscarReceptoresJefesYEditoresController($idDeptoUsuario);
                        $nDoc = $this->buscarNdocController($_GET['idDoc']);
                        $autor = $this->buscarAutorController($_GET['idDoc']);
                        $exist = false;
                        foreach ($buscarReceptor as $key => $value)
                        {
                            if (in_array($autor,$value))
                            {
                                $exist = true;
                            }
                        }
                        if (!$exist){ $buscarReceptor[] = array('id'=>$autor);}
                        //var_dump($buscarReceptor);
                        foreach ($buscarReceptor as $key => $value)
                        {
                            $receptor = $value['id'];
                            $datosMsj[] = array('remitente'=>(int)$idUsuario, 
                                        'receptor'=>$receptor, 
                                        'contenido'=>'Rechazo un documento', 
                                        'status'=>1, 
                                        'n_doc'=>$nDoc);
                        }
                        foreach ($datosMsj as $key => $value)
                        {
                            $comprobacion = $this->comprobacionMsjController($value['receptor'], $value['n_doc']);
                            //var_dump($comprobacion);
                            if ($comprobacion=='insertar')
                            {
                                $msj = $this->insertarMsjController($value);
                            }elseif($comprobacion=='actualizar')
                            {
                                $msj = $this->actualizarMsjController($value);
                            }
                            //var_dump($value);
                        }
                        //var_dump($datosMsj);
                        header('Location:notRechazarDocOk');
                    }
                }
                
            }
        }
    }
    // INICIAN FUNCIONES PARA LA VITACORA
    //al subir un documento
    public function vitacoraSubirDocController($datos)
    {
        $respuesta = DocModel::vitacoraSubirDocModel('vitacora',$datos);
    }
    //INSERTAR UN MENSAJE AL SUBIR DOCUMENTOS
    public function insertarMsjController($datos)
    {
        $respuesta = DocModel::insertarMsjModel('mensajes', $datos);
    }
    //ACTUALIZAR UN MENSAJE EN LA EDITAR, RECHAZAR, ACTIVAR Y RECHAZAR
    public function actualizarMsjController($datos)
    {
        $respuesta = DocModel::actualizarMsjModel('mensajes', $datos);
    }
    //DEVUELVE UNA INSTRUCCION SI COINCIDE O NO EL REMITENTE DEL MENSAJE CON LOS REGISTROS SEGUN EL PARAM N_DOC
    public function comprobacionMsjController($receptor, $n_doc)
    {
        $respuesta = DocModel::comprobacionMsjModel('mensajes', $receptor, $n_doc);
        //return $respuesta;
        if ($respuesta['total']==0)
        {
            $instruccion = 'insertar';
        }elseif($respuesta['total']>0){
            $instruccion = 'actualizar';
        }
        return $instruccion;
    }
    //DEVUELVE UN ARRAY CON LOS JEFES DE REDACCION PARA LAS ACCIONES CUANDO SUBEN UN DOC
    public function buscarReceptorController($idDeptoUsuario)
    {
        $respuesta = DocModel::buscarReceptorModel('usuarios', $idDeptoUsuario);
        return $respuesta;
    }
    //DEVUELVE UN ARRRAY CON LOS JEFES DE REDACCION Y EDITOR
    public function buscarReceptoresJefesYEditoresController($idDeptoUsuario)
    {
        $respuesta = DocModel::buscarReceptoresJefesYEditoresModel('usuarios', $idDeptoUsuario);
        return $respuesta;
    }
    //RETORNA UN ARREGLO CON EL ID DE TODOS LOS RECEPTORES DE MENSAJES CON EL MISMO N_DOC
    public function buscarUsuariosNotificadosController($nDoc)
    {
        $respuesta = DocModel::buscarUsuariosNotificadosModel('mensajes', $nDoc);
        return $respuesta;
    }
    //DATOS DE DOCUMENTO INDIVIDUAL
    public function documentoIndividualSubidoController($rol, $n_doc)
    {
        $respuesta = DocModel::documentoIndividualSubidoModel($n_doc);
        foreach ($respuesta as $key => $value)
        {
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
            $editar = ($rol=='editor') ? '' : '<td>
            <a 
                href="index.php?action=editarDoc&idDoc='.$value['idDoc'].'" 
                class="btn btn-warning">
                Editar
            </a>
            </td>' ;
                $aprobar = ($rol=='editor' || $rol=='redactor') ? '' : '<td>
                <button 
                    href="'.$value['idDoc'].'" 
                    documento="'.substr($value["url_doc"], 11).'" 
                    id="aprobar'.$value['idDoc'].'" 
                    class="btn btn-color btn-twitter">
                    Aprobar
                </button>
            </td>' ;
            $publicar = ($rol=='jefeRedaccion' || $rol=='redactor') ? '' : '<td>
            <button 
                href="'.$value['idDoc'].'" 
                documento="'.substr($value["url_doc"], 11).'" 
                id="eliminar'.$value['idDoc'].'" 
                class="btn btn-success">
                Publicar
            </button>
            </td>' ;
            $botonVacio = '<td>
            <button 
                class="btn btn-default">
                No aplica
            </button>
            </td>' ;
            $rechazar = ($rol=='redactor') ? '' : '<td>
            <a 
                href="index.php?action=rechazarDoc&idDoc='.$value['idDoc'].'" 
                class="btn btn-danger">
                Rechazar
            </a>
            </td>' ;
            $etiquetaAprobar = '';
            if ($rol=='jefeRedaccion') {
                $etiquetaAprobar = ($value["status"]==2) ? $botonVacio : $aprobar ;
            }
            $etiquetaPublicar = '';
            if ($rol=='editor') {
                $etiquetaPublicar = ($value["status"]!=2) ? $botonVacio : $publicar ;
            }
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
                            <a 
                                target="_blank" href="'.$value["url_doc"].'" 
                                class="btn btn-primary">
                                Ver en linea
							</a>
                        </td>
                        '.$editar.'
                        '.$etiquetaAprobar.'
                        '.$etiquetaPublicar.'
                        '.$rechazar.'
					</tr>';
        }
    }
    //DECUELVE EL NUMERO DE DOCUMENTO DE UN DOCUMENTO SUBIDO
    public function buscarNdocController($id_doc)
    {
        $respuesta = DocModel::buscarNdocModel('documentos', $id_doc);
        $n_doc = $respuesta['n_doc'];
        return $n_doc;
    }
    //DEVUELVE EL AUTOR DEL DOCUMENTO SUBIDO
    public function buscarAutorController($id_doc)
    {
        $respuesta = DocModel::buscarAutorModel('documentos', $id_doc);
        $autor = $respuesta['id_usuario'];
        return $autor;
    }
    //DEVULEVE EL ID DEL DEPARTAMENTO DEL DOCUMENTO SUBIDO
    public function buscaridDeptoDocController($idDoc)
    {
        $respuesta = DocModel::buscaridDeptoDocModel('documentos', $idDoc);
        return $respuesta;
    }
}
?>