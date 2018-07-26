<?php
class InformesController
{
    //INFORME DE DOCUMENTOS POR STATUS
    public function informeDocsPorStatusController()
    {
        if (isset($_POST['statusInforme']) && !empty($_POST['statusInforme']) && 
            isset($_POST['fechaInicialInforme']) && !empty($_POST['fechaInicialInforme']) && 
            isset($_POST['fechaFinalInforme']) && !empty($_POST['fechaFinalInforme'])
        ) {
            $datos = array('status'=>(int)$_POST['statusInforme'], 
                            'fechaInicial'=>$_POST['fechaInicialInforme'], 
                            'fechaFinal'=>$_POST['fechaFinalInforme']);
            //var_dump($datos);
            $resp = InformesModel::informeDocsPorStatusModel($datos);
            //var_dump($resp);
            $datos = '';
            if (count($resp)>0) {
                foreach ($resp as $key => $value) {
                    switch ($value["status"]) {
                        case '1':
                            $descripcionStatus = 'Documentos Pendientes';
                            break;
                        case '2':
                            $descripcionStatus = 'Documentos Aprobados';
                            break;
                        case '3':
                            $descripcionStatus = 'Documentos Publicados';
                            break;
                        case '4':
                            $descripcionStatus = 'Documentos Rechazados';
                            break;
                        case '5':
                            $descripcionStatus = 'Documentos Extemporaneos';
                            break;
                        default:
                            break;
                    }
                    $datos.='   <tr nobr="true">>  
                                  <td align="center">'.utf8_encode($value["usuario"]).'</td>
                                  <td align="center">'.utf8_encode($value["departamento"]).'</td>
                                  <td align="center">'.utf8_encode($value["numeralesDescripcion"]).'</td>  
                                  <td align="center">'.utf8_encode($value["categoriasDescripcion"]).'</td> 
                                  <td align="center">'.utf8_encode($value["n_doc"]).'</td>  
                                  <td align="center">'.date("d-m-Y", strtotime($value["fecha_publicacion"])).'</td>
                                  <td align="center">'.date("d-m-Y", strtotime($value["fecha_doc"])).'</td>
                                  <td align="center">'.utf8_encode($descripcionStatus).'</td>
                                </tr>';
                }
            }else{
                $datos = '<tr>  
                            <td colspan="8" align="center">NO HAY DOCUMENTOS SUBIDOS CON ESTE STATUS.</td>
                        </tr>';
            }
            return $datos;
        }
    }
    //OBTENER LA DESCRIPCION PARA EL TITULO DE LOS INFORMES
    public function getTituloController()
    {
        if (isset($_POST['statusInforme']) && !empty($_POST['statusInforme'])) {
            switch ($_POST['statusInforme']) {
                case '1':
                    return 'Documentos Pendientes';
                    break;
                case '2':
                    return 'Documentos Aprobados';
                    break;
                case '3':
                    return 'Documentos Publicados';
                    break;
                case '4':
                    return 'Documentos Rechazados';
                    break;
                case '5':
                    return 'Documentos Extemporaneos';
                    break;
                default:
                    break;
            }
        }
    }

    //DEVUELVE EL USUARIO QUE GENERO EL DOCUMENTO
    public function getUserController()
    {
        if (isset($_POST['idUsuario']) && !empty($_POST['idUsuario'])) {
            $idUsuario = $_POST['idUsuario'];
            $resp = InformesModel::getUserModel('usuarios', $idUsuario);
            $usuario = $resp['usuario'];
            return $usuario;
        }
    }

    //INFORME DE VITACORA
    public function informeVitacoraController()
    {
        if (isset($_POST['fechaInicialInformeVitacora']) && !empty($_POST['fechaInicialInformeVitacora']) && 
            isset($_POST['fechaFinalInformeVitacora']) && !empty($_POST['fechaFinalInformeVitacora'])) {
            $datos = array('fechaInicial'=>$_POST['fechaInicialInformeVitacora'], 
                        'fechaFinal'=>$_POST['fechaFinalInformeVitacora']);
            $resp = InformesModel::informeVitacoraModel($datos);
            //var_dump($resp);
            $datos = '';
            if (count($resp)>0) {
                foreach ($resp as $key => $value) {
                    $datos.='   <tr nobr="true">  
                                  <td align="center">'.utf8_encode($value["usuario"]).'</td>
                                  <td align="center">'.utf8_encode($value["depto"]).'</td> 
                                  <td align="center">'.utf8_encode($value["desc_actividad"]).'</td> 
                                  <td align="center">'.utf8_encode($value["hora"]).'</td>
                                </tr>';
                }
            }else{
                $datos = '<tr>  
                            <td colspan="8" align="center">NO HAY DOCUMENTOS SUBIDOS CON ESTE STATUS.</td>
                        </tr>';
            }
            return $datos;
        }
    }
}