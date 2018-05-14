<?php  
session_start();
if (!$_SESSION['verificar']) {
  header('Location:index.php');
}
$editarDepto = new DepartamentosController();
if (isset($_GET['action'])) {
	if ($_GET['action']=='notCrearDeptoOk') {
		echo "	<script>
					swal({
					  position: 'top-end',
					  type: 'success',
					  title: 'Departamento grabado exitosamente!',
					  showConfirmButton: false,
					  timer: 2000
					})
				</script>";
	}
}
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
	                		<i class="icon mdi mdi-edit"></i> Editar Departamento<span class="panel-subtitle">Edita un nuevo Departamento.</span>
	                	</div>
		                <div class="panel-body">
		                  	<?php $editarDepto->crearEditarDepartamentoFormController(); ?>
		                </div>
	              	</div>
	            </div>
	      	</div>
    	</div>
  	</div>
</div>