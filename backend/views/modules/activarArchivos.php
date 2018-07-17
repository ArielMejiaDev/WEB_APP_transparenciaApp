<?php  
session_start();
if (!$_SESSION['verificar']) {
  header('Location:index.php');
}
$listarArchivosSubidosGeneral = new DocController();
//$listarArchivosSubidosGeneral->activarDocController();
?>
<?php require_once "navbar.php"; ?>
<?php require_once "sidebar.php"; ?>
<div class="be-content">
	<div class="page-head">
	  <h2 class="page-head-title">Archivos extemporaneos</h2>
	  <ol class="breadcrumb page-head-nav">
	    <li><a href="#">Inicio</a></li>
	    <li><a href="#">Archivos</a></li>
	    <li class="active">Lista Archivos extemporaneos</li>
	  </ol>
	</div>
	<div class="main-content container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default panel-table">
					<div class="panel-heading">Archivos
			          <div class="tools"><span class="icon mdi mdi-download"></span><span class="icon mdi mdi-more-vert"></span>
			          </div>
			        </div>
			        <div class="panel-body">
			        	<div class="table-responsive">
			        		<table id="table6" class="table table-striped table-hover table-fw-widget">
                                <thead>
                                    <tr>
                                        <th>Numeral</th>
                                        <th>Categoria</th>
                                        <th>Documento</th>
                                        <th># Documento</th>
                                        <th>Status</th>
                                        <th>Fecha del Doc</th>
                                        <th>Depto</th>
                                        <th>Usuario</th>
                                        <th>Ver en Linea</th>
                                        <th>Activar</th>
                                    </tr>
                                </thead>
			            	<tbody>
                                <div id="botones">
                                <?php  
                                    $listarArchivosSubidosGeneral->listarDocumentosExtemporaneosController();
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
<script>
	var botonesAprobar = document.getElementsByClassName('btn btn-color btn-twitter');
	for (let i = 0; i < botonesAprobar.length; i++) {
		botonesAprobar[i].addEventListener('click',capturarEventoAprobar,false);
	}
	function capturarEventoAprobar(e){
		e.preventDefault();
		var id = e.target.getAttribute('href');
		var documento = e.target.getAttribute('documento');
		mostrarMensajeAprobacion(id, documento);
	}
	function mostrarMensajeAprobacion(id, documento){
		swal({
		  title: 'Deseas aprobar el documento '+documento,
		  text: "Este paso no se puede revertir!",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si, eliminar'
		}).then((result) => {
		  if (result.value) {
		    window.location="index.php?action=listarArchivosSubidosGeneral&aprobar="+id;
		  }else if (
			    // Read more about handling dismissals
			    result.dismiss === swal.DismissReason.cancel
			  ) {
			    swal(
			      'Cancelado',
			      'No se elimino ningun numeral',
			      'error'
			    )
			  }
		})
	}
</script>
