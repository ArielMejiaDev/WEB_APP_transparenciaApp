<?php  
session_start();
if (!$_SESSION['verificar']) {
  header('Location:index.php');
}
$editarDoc = new DocController();
$datosUsuario = new DatosUsuarioController();
$datos = $datosUsuario->getDatosUsuarioController();
$idUsuario = $datos['id'];
$idDeptoUsuario = $datos['id_departamento'];
$idDoc = $_GET['idDoc'];
$editarDoc->actualizarDocController($idUsuario, $idDeptoUsuario);
include_once "navbar.php";
include_once "sidebar.php";
?>
<div class="be-wrapper be-fixed-sidebar">
    <div class="be-content">
        <div class="main-content container-fluid">
	    	<div class="row">
	            <div class="col-md-12">
	              	<div class="panel panel-default panel-border-color panel-border-color-primary">
	                	<div class="panel-heading panel-heading-divider">
	                		<i class="icon mdi mdi-edit"></i> Editar Documento<span class="panel-subtitle">Edita un Documento Subido al servidor.</span>
	                	</div>
		                <div class="panel-body">
                              <?php 
								$editarDoc->crearFormEditarDocController();
                              ?>
		                </div>
	              	</div>
	            </div>
	      	</div>
    	</div>
  	</div>
</div>
<script>
	addEventListener('load',inicializarEventos,false);
	var conexionCargarNumerales;
	function inicializarEventos(){
		conexionCargarNumerales = new XMLHttpRequest();
		conexionCargarNumerales.onreadystatechange = respAjaxCargarOptNumerales;
		var datos = new FormData();
		datos.append('tabla','numerales');
		conexionCargarNumerales.open('POST','views/modules/cargarOptionsNumeralesAjax.php',true);
		conexionCargarNumerales.send(datos);
	}
	function respAjaxCargarOptNumerales(){
		if (conexionCargarNumerales.readyState==4) {
			if (conexionCargarNumerales.status==200) {
				var select = document.getElementById('idNumeralEditarCategoria');
				var opt = conexionCargarNumerales.responseText;
				select.innerHTML+=opt;
				//console.log(opt);
			}
		}
	}
</script>