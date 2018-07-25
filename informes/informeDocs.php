<?php
setlocale(LC_ALL, "es_GT.UTF-8", "es_GT", "esp");
date_default_timezone_set('America/Guatemala');
require_once 'InformesController.php';
require_once 'InformesModel.php';
$informe = new InformesController();
$titulo = $informe->getTituloController();
//SE LLAMA AL ARCHIVO DE ENCABEZADO Y PIE DE PAGINA PERSONALIZADO
require_once('EncabezadoPiePagina.php');
// INSTANCIANDO EL OBJETO PDF CON PARAMETROS PARA EL CONSTRUCTOR DE LA LIBRERIA
require_once('ConfPdf.php');
$pdf->SetFont('helvetica', '', 12);
$pdf->AddPage('L');
$content = '';  
        $content .= '  
        <h3 align="center">Informe de '.$titulo.'</h3><br /><br />  
        <table class="table table-hover invoice" border="1" cellspacing="0" cellpadding="5">  
           <thead> 
                <tr bgcolor="#eee">
                    <th align="center">Usuario</th> 
                    <th align="center">Numeral</th> 
                    <th align="center">Categoria</th>
                    <th align="center"># Doc</th> 
                    <th align="center">Fecha Publicación</th>
                    <th align="center">Fecha del Documento</th>                
                    <th align="center">Status</th>
                </tr> 
            </thead> 
        ';  
        $content .= $informe->informeDocsPorStatusController();;  
        $content .= '</table>';  
        $pdf->writeHTML($content);  
        $pdf->Output('Informe de '.$titulo.' '. date('h i s d-m-Y').'.pdf', 'I');