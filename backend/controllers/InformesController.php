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
            var_dump($resp);
        }
    }
}