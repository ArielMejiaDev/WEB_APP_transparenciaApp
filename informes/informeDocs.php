<?php
setlocale(LC_ALL, "es_GT.UTF-8", "es_GT", "esp");
date_default_timezone_set('America/Guatemala');
if (isset($_POST['statusInforme']) && !empty($_POST['statusInforme']) && 
    isset($_POST['fechaInicialInforme']) && !empty($_POST['fechaInicialInforme']) && 
    isset($_POST['fechaFinalInforme']) && !empty($_POST['fechaFinalInforme'])) {
    require_once 'InformesController.php';
    require_once 'InformesModel.php';
    $informe = new InformesController();
    $titulo = $informe->getTituloController();
    $leyenda = $informe->getLeyendaController($_POST['fechaInicialInforme'], $_POST['fechaFinalInforme']); 
    //SE LLAMA AL ARCHIVO DE ENCABEZADO Y PIE DE PAGINA PERSONALIZADO
    require_once('EncabezadoPiePagina.php');
    // INSTANCIANDO EL OBJETO PDF CON PARAMETROS PARA EL CONSTRUCTOR DE LA LIBRERIA
    require_once('ConfPdf.php');
    $pdf->SetFont('helvetica', '', 12);
    $pdf->AddPage('L');
    $content = '';  
            $content .= '  
            <h3 align="center">Informe de '.$titulo.'</h3>
            <p align="center">'.$leyenda.'</p> 
            <table class="table table-hover invoice" border="1" cellspacing="0" cellpadding="5">  
            <thead> 
                    <tr bgcolor="#eee">
                        <th align="center">Usuario</th> 
                        <th align="center">Departamento</th> 
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
}else{
    echo '
    <html>
        <head>
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>
            <script src="js/sweetalert2.all.js"></script>
        </head>
        <body>
        <script>
            

             
            const ipAPI = "://api.ipify.org?format=json"

            swal.queue([{
                type: "error",
                title: "Oops...",
            confirmButtonText: "Entendido",
            text:
                "Debe seleccionar ambas fechas para generar el informe",
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return fetch(ipAPI)
                .then(response => response.json())
                .then(data => swal.insertQueueStep(data.ip))
                .catch(() => {
                    window.close();
                })
            }
            }])
            
        </script>
        </body>
    </html>';
}