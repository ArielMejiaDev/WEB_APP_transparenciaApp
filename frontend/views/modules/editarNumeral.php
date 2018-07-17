<?php  
session_start();
if (!$_SESSION['verificar']) {
  header('Location:index.php');
}
$editarNumeral = new NumeralController();
$editarNumeral->actualizarNumeralController();

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
	                		<i class="icon mdi mdi-edit"></i> Editar Numeral<span class="panel-subtitle">Edita un nuevo Numeral.</span>
	                	</div>
		                <div class="panel-body">
		                  	<?php $editarNumeral->crearEditarNumeralFormController(); ?>
		                </div>
	              	</div>
	            </div>
	      	</div>
    	</div>
  	</div>
</div>