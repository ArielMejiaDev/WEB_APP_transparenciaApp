<?php  
session_start();
if (!$_SESSION['verificar']) {
  header('Location:index.php');
}
$editarNumeral = new CategoriaController();
$editarNumeral->agregarReglaCategoriaController();
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
	                		<i class="icon mdi mdi-edit"></i> Agregar Regla la categoria<span class="panel-subtitle">Valida una regla especial para la categoria respectivo.</span>
	                	</div>
		                <div class="panel-body">
		                  	<form style="border-radius: 0px;" class="form-horizontal group-border-dashed" onsubmit="return validarAgregarAvisoCategoria()" method="post">
			                    <div class="form-group">
			                    	<input type="hidden" class="form-control" id="idAgregarReglaCategoria" name="idAgregarReglaCategoria" value="<?php echo $_GET['id'] ?>">
			                      <label class="col-sm-3 control-label" for="avisoAgregarReglaCategoria">Regla para la categoria:</label>
			                      <div class="col-sm-6">
			                        <input type="text" class="form-control" id="avisoAgregarReglaCategoria" name="avisoAgregarReglaCategoria">
			                        <p id="avisoAvisoAgregarReglaCategoria" class="text-danger text-muted" style="display: none"></p>
			                      </div>
			                    </div>
			                    <div class="form-group">
			                    	<div class="col-sm-6 col-md-offset-3">
			                    		<button type="submit" class="btn btn-info"><i class="icon mdi mdi-edit"></i> Agregar Regla a la categoria</button>
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