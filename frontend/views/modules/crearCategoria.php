<?php  
session_start();
if (!$_SESSION['verificar']) {
  header('Location:index.php');
}
$crearCategoria = new CategoriaController();
$crearCategoria->crearCategoriaController();
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
		                	<i class="icon mdi mdi-plus"></i> Crear Categoria<span class="panel-subtitle">Crea un nueva categoria.</span>
		                </div>
		                <div class="panel-body">
		                  	<form style="border-radius: 0px;" class="form-horizontal group-border-dashed" onsubmit="return validarCrearCategoria()" method="post">
		                  		<div class="form-group">
			                      <label class="col-sm-3 control-label" for="idNumeralCrearCategoria">Numeral</label>
			                      <div class="col-sm-6">
			                        <select name="idNumeralCrearCategoria" id="idNumeralCrearCategoria" class="form-control">
			                        	<?php $crearCategoria->cargarSelectNumeralesController() ?>
			                        </select>
			                        <p id="avisoIdNumeralCrearCategoria" class="text-danger text-muted" style="display: none"></p>
			                      </div>
			                    </div>
			                    <div class="form-group">
			                      <label class="col-sm-3 control-label" for="descripcionCrearCategoria">Categoria</label>
			                      <div class="col-sm-6">
			                        <input type="text" class="form-control" id="descripcionCrearCategoria" name="descripcionCrearCategoria" autofocus>
			                        <p id="avisoDescripcionCrearCategoria" class="text-danger text-muted" style="display: none"></p>
			                      </div>
			                    </div>
			                    <div class="form-group">
			                    	<div class="col-sm-6 col-md-offset-3">
			                    		<button type="submit" class="btn btn-info"><i class="icon mdi mdi-plus"></i> Crear Categoria</button>
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