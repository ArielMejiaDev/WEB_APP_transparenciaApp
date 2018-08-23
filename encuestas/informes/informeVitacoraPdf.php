<?php
if (isset($_POST['fechaInicialInformeVitacora']) && !empty($_POST['fechaInicialInformeVitacora']) && 
isset($_POST['fechaFinalInformeVitacora']) && !empty($_POST['fechaFinalInformeVitacora']))
{
    setlocale(LC_ALL, "es_GT.UTF-8", "es_GT", "esp");
    date_default_timezone_set('America/Guatemala');
    require_once 'InformesController.php';
    require_once 'InformesModel.php';
    $informe = new InformesController();
    $titulo = 'Vitacora.';
    $leyenda = $informe->getLeyendaController($_POST['fechaInicialInformeVitacora'], $_POST['fechaFinalInformeVitacora']); 
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
            <table class="table" border="1" cellspacing="0" cellpadding="0" >  
            <thead> 
                    <tr bgcolor="#eee">
                        <th align="center">Usuario</th> 
                        <th align="center">Departamento</th> 
                        <th align="center">Actividad</th> 
                        <th align="center">Fecha y hora</th>
                    </tr> 
                </thead> 
            ';  
            $content .= $informe->informeVitacoraController();  
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
