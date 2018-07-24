<?php  
session_start();
if (!$_SESSION['verificar']) {
  header('Location:index.php');
}
$datosUsuario = new DatosUsuarioController();
$datos = $datosUsuario->getDatosUsuarioController();
$idUsuario = $datos['id'];
$idDeptoUsuario = $datos['id_departamento'];
$datos = array('statusInforme'=>(int)$_POST['statusInforme'], 
                            'fechaInicialInforme'=>$_POST['fechaInicialInforme'], 
                        'fechaFinalInforme'=>$_POST['fechaFinalInforme']);
$informe = new InformesController();
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
                                    <div class="panel-heading panel-heading-divider">Informe<span class="panel-subtitle">Informe para descargar PDF o imprimirlo</span>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
			        		                        <table id="table6" class="table table-striped table-hover table-fw-widget">
										                <thead>
                                                            <tr>
                                                                <th>Usuario</th>
                                                                <th>Departamento</th>
                                                                <th>Numeral</th>
                                                                <th>Categoria</th>
                                                                <th>Fecha Publicación</th>
                                                                <th>Fecha del Documento</th>
                                                                <th># de Documento</th>
                                                                <th>Status</th>
                                                            </tr>       
										                </thead>
			            	                            <tbody>
											                <div id="botones">
                                                                <?php 
                                                                 $informe->generarInformeController();
                                                                ?>
											                </div>
										                </tbody>
	              	                                </table>
			        	                        </div>
                                            </div>
                                        </div>
                                    </div>
						  	    </div>
                            </div>
					    </div>
                    </div>
			    </div>
		    </div>
	    </div>
    </div>
</div>
<script>
    document.title="Informe de Documentos";
</script>
