<?php  
session_start();
if (!$_SESSION['verificar']) {
  header('Location:index.php');
}
$datosUsuario = new DatosUsuarioController();
$datos = $datosUsuario->getDatosUsuarioController();
$idUsuario = $datos['id'];
$idDeptoUsuario = $datos['id_departamento'];
$subirArchivos = new DocController();
$subirArchivos->subirArchivoController($idUsuario, $idDeptoUsuario);

$subirArchivos2 = NEW DocController();
$subirArchivos2->subirArchivoSinCategoriaController();
?>
<?php require_once "navbar.php"; ?>
<?php require_once "sidebar.php"; ?>
<div class="be-content">
	<div class="main-content container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default panel-table">
			    	<div class="panel-body">
			      		<div class="row">
							<div class="col-md-12">
						  		<div class="panel panel-default panel-border-color panel-border-color-primary">
							    <div class="panel-heading panel-heading-divider">Subir Archivos<span class="panel-subtitle">Sube el documento PDF al sistema</span>
							    </div>
							    <div class="panel-body">
									<form style="border-radius: 0px;" class="form-horizontal group-border-dashed" onsubmit="" method="post" enctype=multipart/form-data>
										<div class="form-group">
											<label class="col-sm-3 control-label" for="idNumeral">Númeral</label>
											<div class="col-sm-6">
												<select name="idNumeral" id="idNumeral" class="form-control">
													<option>Seleccione una Categoria</option>
													<?php 
														$subirArchivos->cargarOptionsNumeralesController(); 
													?>
												</select>
												<p id="avisoIdNumeral" class="text-danger text-muted" style="display: none"></p>
											</div>
										</div>
										<div class="form-group" id="formGroupCat" style="display: block">
											<label class="col-sm-3 control-label" for="idCategoria">Categoria</label>
											<div class="col-sm-6">
												<select name="idCategoria" id="idCategoria" class="form-control">
												<option value="0">Si existe categoria se cargara automaticamente</option>
												</select>
												<p id="avisoIdCategoria" class="text-danger text-muted" style="display: none"></p>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label" for="fecha"> Fecha </label>
											<div class="col-md-3 col-xs-7">
												<div data-min-view="2" data-date-format="yyyy-mm-dd" class="input-group date datetimepicker">
												<input id="fecha" name="fecha" size="16" type="text" value="" class="form-control"><span class="input-group-addon btn btn-primary"><i class="icon-th mdi mdi-calendar"></i></span>
												</div>
											</div>
										</div>
										<div class="form-group">
										<div class="col-sm-6 col-md-offset-3">
											<label class="btn btn-rounded btn-space btn-warning btn-lg" for="doc"><i class="icon icon-left mdi mdi-collection-pdf"></i> Subir Archivo PDF</label>
										</div>
											<div class="col-sm-6">
												<input style="display: none" type="file" id="doc" name="doc">
												<p id="avisoIdCategoria" class="text-danger text-muted" style="display: none"></p>
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-6 col-md-offset-3">
												<button type="submit" class="btn btn-info"><i class="icon mdi mdi-long-arrow-up"></i> Subir Documento</button>
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
	</div>
</div>
