<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="views/images/favicon.ico">
    <title>Transparencia App</title>
    <link rel="stylesheet" type="text/css" href="views/lib/perfect-scrollbar/css/perfect-scrollbar.min.css"/>
    <link rel="stylesheet" type="text/css" href="views/lib/material-design-icons/css/material-design-iconic-font.min.css"/>

    <script src="views/js/sweetalert2.all.js"></script>
    <link rel="stylesheet" type="text/css" href="views/lib/jquery.vectormap/jquery-jvectormap-1.2.2.css"/>
    <link rel="stylesheet" type="text/css" href="views/lib/jqvmap/jqvmap.min.css"/>
    <link rel="stylesheet" type="text/css" href="views/lib/datetimepicker/css/bootstrap-datetimepicker.min.css"/>

    <link rel="stylesheet" type="text/css" href="views/lib/datatables/css/dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" href="views/css/style.css" type="text/css"/>
    
  </head>
  <body>
    <div class="be-wrapper">
      
      <?php 
        $enlace = new EnlacesController();
        $enlace->loadEnlaces();
      ?>  
      
    </div>
    <script src="views/lib/jquery/jquery.min.js" type="text/javascript"></script>
    <script src="views/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
    <script src="views/js/main.js" type="text/javascript"></script>
    <script src="views/lib/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>

    <script src="views/lib/datatables/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="views/lib/datatables/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <script src="views/lib/datatables/plugins/buttons/js/dataTables.buttons.js" type="text/javascript"></script>
    <script src="views/lib/datatables/plugins/buttons/js/jszip.min.js"></script>
    <script src="views/lib/datatables/plugins/buttons/js/pdfmake.min.js"></script>
    <script src="views/lib/datatables/plugins/buttons/js/vfs_fonts.js"></script>
    <script src="views/lib/datatables/plugins/buttons/js/buttons.html5.js" type="text/javascript"></script>
    <script src="views/lib/datatables/plugins/buttons/js/buttons.flash.js" type="text/javascript"></script>

    <script src="views/lib/datatables/plugins/buttons/js/buttons.print.js" type="text/javascript"></script>
    <script src="views/lib/datatables/plugins/buttons/js/buttons.colVis.js" type="text/javascript"></script>
    <script src="views/lib/datatables/plugins/buttons/js/buttons.bootstrap.js" type="text/javascript"></script>
    <script src="views/js/app-tables-datatables.js" type="text/javascript"></script>

    <!-- DASHBOARD -->
    <script src="views/lib/jquery-flot/jquery.flot.js" type="text/javascript"></script>
    <script src="views/lib/jquery-flot/jquery.flot.pie.js" type="text/javascript"></script>
    <script src="views/lib/jquery-flot/jquery.flot.resize.js" type="text/javascript"></script>
    <script src="views/lib/jquery-flot/plugins/jquery.flot.orderBars.js" type="text/javascript"></script>
    <script src="views/lib/jquery-flot/plugins/curvedLines.js" type="text/javascript"></script>
    <script src="views/lib/jquery.sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <script src="views/lib/countup/countUp.min.js" type="text/javascript"></script>
    <script src="views/lib/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
    <script src="views/lib/jqvmap/jquery.vmap.min.js" type="text/javascript"></script>
    <script src="views/lib/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
    <script src="views/js/app-dashboard.js" type="text/javascript"></script> 

    <?php  
        


            if ($_GET['action'] == 'dashboard') {
                echo '  <script type="text/javascript">
                          $(document).ready(function(){
                            //initialize the javascript
                            App.init();
                            App.dashboard();
                          });
                        </script>';
            }else{
                echo '  <script>
                          $(document).ready(function(){
                            //initialize the javascript
                            App.init();
                            App.dataTables();
                          });
                        </script>';
            }
    ?>
        

    <!-- MODULOS PERSONALIZADOS -->
    <script src="views/js/validarNuevoPassword.js"></script>
    <script src="views/js/validarCrearUsuario.js"></script>
    <script src="views/js/validarEditarUsuario.js"></script>
    <script src="views/js/automatizarActulizarUsuario.js"></script>
    <script src="views/js/validarCrearDepartamento.js"></script>
    <script src="views/js/validarEditarDepartamento.js"></script>
    <script src="views/js/validarNumeral.js"></script>
    <script src="views/js/validarCategoria.js"></script>
    <!-- FIN DE MODULOS PERSONALIZADOS -->
  </body>
</html>