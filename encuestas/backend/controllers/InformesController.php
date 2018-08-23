<?php
class InformesController
{
    //GENERAR INFORME
    public function generarInformeController()
    {
        if (isset($_POST['statusInforme']) &&
             !empty($_POST['statusInforme']) &&
             isset($_POST['fechaInicialInforme']) &&
             !empty($_POST['fechaInicialInforme'])&&
             isset($_POST['fechaFinalInforme']) &&
             !empty($_POST['fechaFinalInforme'])) {
            $datos = array('statusInforme'=>(int)$_POST['statusInforme'], 
                            'fechaInicialInforme'=>$_POST['fechaInicialInforme'], 
                        'fechaFinalInforme'=>$_POST['fechaFinalInforme']);
            $resp = InformesModel::generarInformeModel('documentos', $datos);
            //var_dump($resp);
            foreach ($resp as $key => $value) {
                echo   '<tr class="odd gradeX">
                            <td>'.utf8_encode($value["id_usuario"]).'</td>
                            <td>'.utf8_encode($value["id_numeral"]).'</td>
                            <td>'.utf8_encode($value["id_categoria"]).'</td>
                            <td>'.utf8_encode($value["id_usuario"]).'</td>
                            <td>'.$value["n_doc"].'</td>
                            <td>'.date("d-m-Y", strtotime($value["fecha_publicacion"])).'</td>
                            <td>'.date("d-m-Y", strtotime($value["fecha_doc"])).'</td>
                            <td>'.$value["status"].'</td>
					    </tr>';
            }
        }
    }
}