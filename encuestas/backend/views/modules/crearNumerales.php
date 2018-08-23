<?php  
session_start();
if (!$_SESSION['verificar']) {
  header('Location:index.php');
}
$crearUsuario = new NumeralController();
$crearUsuario->crearNumeralController();
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
		                	<i class="icon mdi mdi-plus"></i> Crear Numerales<span class="panel-subtitle">Crea un nuevo numeral.</span>
		                </div>
		                <div class="panel-body">
		                  	<form style="border-radius: 0px;" class="form-horizontal group-border-dashed" onsubmit="return validarCrearNumeral()" method="post">
			                    <div class="form-group">
			                      <label class="col-sm-3 control-label" for="descripcionCrearNumeral">Númeral</label>
			                      <div class="col-sm-6">
			                        <input type="text" class="form-control" id="descripcionCrearNumeral" name="descripcionCrearNumeral" autofocus>
			                        <p id="avisoDescripcionCrearNumeral" class="text-danger text-muted" style="display: none"></p>
			                      </div>
			                    </div>
			                    <div class="form-group">
			                    	<div class="col-sm-6 col-md-offset-3">
			                    		<button type="submit" class="btn btn-info"><i class="icon mdi mdi-plus"></i> Crear Númeral</button>
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