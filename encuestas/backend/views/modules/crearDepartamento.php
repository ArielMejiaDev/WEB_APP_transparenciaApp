<?php  
session_start();
if (!$_SESSION['verificar']) {
  header('Location:index.php');
}
$crearDepto = new DepartamentosController();
$crearDepto->crearDepartamentoController();
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
	                		<i class="icon mdi mdi-plus"></i> Crear Departamento<span class="panel-subtitle">Crea un nuevo Departamento.</span>
	                	</div>
		                <div class="panel-body">
		                  	<form style="border-radius: 0px;" class="form-horizontal group-border-dashed" onsubmit="return validarDepartamentoForm()" method="post">
			                    <div class="form-group">
			                      <label class="col-sm-3 control-label" for="nombreDepartamentoCrearDepto">Departamento:</label>
			                      <div class="col-sm-6">
			                        <input type="text" class="form-control" id="nombreDepartamentoCrearDepto" name="nombreDepartamentoCrearDepto" autofocus>
			                        <p id="avisoNombreDepartamentoCrearDepto" class="text-danger text-muted" style="display: none"></p>
			                      </div>
			                    </div>
			                    <div class="form-group">
			                    	<div class="col-sm-6 col-md-offset-3">
			                    		<button type="submit" class="btn btn-info"><i class="icon mdi mdi-plus"></i> Crear Departamento</button>
			                    	</div>
			                    </div>
		                  	</form>
		                </div>
	              	</div>
	            </div>
	      	</div>
    	</div>
  	</div>
</div>