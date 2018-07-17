<?php  
session_start();
if (!$_SESSION['verificar']) {
  header('Location:index.php');
}
$activarDoc = new DocController();
$datosUsuario = new DatosUsuarioController();
$datos = $datosUsuario->getDatosUsuarioController();
$idUsuario = $datos['id'];
$idDeptoUsuario = $datos['id_departamento'];
$idDoc = $_GET['idDoc'];
$activarDoc->activarDocController($idUsuario, $idDeptoUsuario);
include_once "navbar.php";
include_once "sidebar.php";
?>
<div class="be-wrapper be-fixed-sidebar">
    <div class="be-content">
        <div class="main-content container-fluid">
	    	<div class="row">
	            <div class="col-md-12">
	              	<div class="panel panel-default panel-border-color panel-border-color-warning">
	                	<div class="panel-heading panel-heading-divider">
	                		<i class="icon mdi mdi-edit"></i> Activar documento<span class="panel-subtitle">Activa un Documento Subido al servidor de forma extemporanea para que pueda ser editado, aprobado o rechazado y publicado en el sitio de transparencia.</span>
	                	</div>
		                <div class="panel-body">
                        <form style="border-radius: 0px;" class="form-horizontal group-border-dashed" 
                            onsubmit="return validarActivarDoc()" method="post">
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="nombresCrearUsuario">Observaciones:</label>
                                <div class="col-sm-6">
                                <textarea class="form-control" id="observaciones" name="observaciones" autofocus></textarea>
                                <p id="avisoObservaciones" class="text-danger text-muted" style="display: none"></p>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-offset-3">
                                <button type="submit" class="btn btn-warning"><i class="icon mdi mdi-check"></i> Activar Documento</button>
                            </div>
                        </form>
		                </div>
	              	</div>
	            </div>
	      	</div>
    	</div>
  	</div>
</div>