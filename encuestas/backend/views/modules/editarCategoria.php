<?php  
session_start();
if (!$_SESSION['verificar']) {
  header('Location:index.php');
}
$editarCategoria = new CategoriaController();
$editarCategoria->actualizarCategoriaController();

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
	                		<i class="icon mdi mdi-edit"></i> Editar Categoria<span class="panel-subtitle">Edita un nuevo Categoria.</span>
	                	</div>
		                <div class="panel-body">
		                  	<?php $editarCategoria->crearEditarCategoriaFormController(); ?>
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