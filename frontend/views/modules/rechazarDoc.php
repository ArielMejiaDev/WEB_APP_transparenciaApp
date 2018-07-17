<?php  
session_start();
if (!$_SESSION['verificar']) {
  header('Location:index.php');
}
$rechazarDoc = new DocController();
$datosUsuario = new DatosUsuarioController();
$datos = $datosUsuario->getDatosUsuarioController();
$idUsuario = $datos['id'];
$idDeptoUsuario = $datos['id_departamento'];
$idDoc = $_GET['idDoc'];
$rechazarDoc->rechazarDocController($idUsuario, $idDeptoUsuario);
include_once "navbar.php";
include_once "sidebar.php";
?>
<div class="be-wrapper be-fixed-sidebar">
    <div class="be-content">
        <div class="main-content container-fluid">
	    	<div class="row">
	            <div class="col-md-12">
	              	<div class="panel panel-default panel-border-color panel-border-color-danger">
	                	<div class="panel-heading panel-heading-divider">
	                		<i class="icon mdi mdi-edit"></i> Rechazar Documento<span class="panel-subtitle">Rechaza y justifica un Documento para su correcion.</span>
	                	</div>
		                <div class="panel-body">
                              <form onsubmit="" style="border-radius: 0px;" class="form-horizontal group-border-dashed" method="post" enctype="multipart/form-data">
								<div class="form-group" id="formGroupCatEditar">
									<label class="col-sm-3 control-label" for="justificacion">Justificación</label>
									<div class="col-sm-6">
										<textarea class="form-control" name="justificacion" id="justificacion"></textarea>
										<p id="avisoJustificacion" class="text-danger text-muted" style="display: none"></p>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-6 col-md-offset-3">
										<button type="submit" class="btn btn-danger"><i class="icon mdi mdi-close"></i> Rechazar Documento</button>
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