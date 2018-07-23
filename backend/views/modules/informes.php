<?php  
session_start();
if (!$_SESSION['verificar']) {
  header('Location:index.php');
}
$datosUsuario = new DatosUsuarioController();
$datos = $datosUsuario->getDatosUsuarioController();
$idUsuario = $datos['id'];
$idDeptoUsuario = $datos['id_departamento'];
$rol = $datos['rol'];
if ($rol!='editor') {
    header('Location:index.php');
}
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
							    <div class="panel-heading panel-heading-divider">Informes<span class="panel-subtitle">Genera informes de los documentos en el sistema</span>
							    </div>
							    <div class="panel-body">
									<form onsubmit="return validarDoc()" style="border-radius: 0px;" class="form-horizontal group-border-dashed" onsubmit="" method="post" enctype=multipart/form-data>
										<div class="form-group">
											<label class="col-sm-3 control-label" for="idNumeral">Informe</label>
											<div class="col-sm-6">
												<select name="idNumeral" id="idNumeral" class="form-control" autofocus>
													<option>Seleccione el informe que desea generar</option>
													<option value="1">Documentos Pendientes</option>
                                                    <option value="4">Documentos Rechazados</option>
                                                    <option value="5">Documentos Extemporaneos</option>
                                                    <option value="2">Documentos Aprobados</option>
                                                    <option value="3">Documentos Publicados</option>
												</select>
												<p id="avisoIdNumeral" class="text-danger text-muted" style="display: none"></p>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label" for="fechaInforme"> Fecha </label>
											<div class="col-md-3 col-xs-7">
												<div data-min-view="2" data-date-format="yyyy-mm-dd" class="input-group date datetimepicker">
												<input id="fechaInforme" name="fechaInforme" size="16" type="text" value="" class="form-control"><span class="input-group-addon btn btn-primary"><i class="icon-th mdi mdi-calendar"></i></span>
												</div>
												<p id="avisoFecha" class="text-danger text-muted" style="display: none;"></p>
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-6 col-md-offset-3">
												<button type="submit" class="btn btn-info"><i class="icon mdi mdi-print"></i> Generar Informe</button>
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
