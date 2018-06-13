<?php  
session_start();
if (!$_SESSION['verificar']) {
  header('Location:index.php');
}
if (isset($_GET['action'])) {
	if ($_GET['action']=='notSubirArchivoOk') {
		echo "
		<script>
			swal({
			  position: 'top-end',
			  type: 'success',
			  title: 'Archivo Subido exitosamente!',
			  showConfirmButton: false,
			  timer: 1500
			})
		</script>";
	}
}
$listarArchivosSubidosGeneral = new DocController();
?>
<?php require_once "navbar.php"; ?>
<?php require_once "sidebar.php"; ?>
<div class="be-content">
	<div class="page-head">
	  <h2 class="page-head-title">Archivos subidos para redactores</h2>
	  <ol class="breadcrumb page-head-nav">
	    <li><a href="#">Inicio</a></li>
	    <li><a href="#">Archivos</a></li>
	    <li class="active">Lista Archivos</li>
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
                                    <th>Publicar</th>
                                    <th>Rechazar</th>
			                        <th>Editar</th>
                                    <th>Ver en Linea</th>
			                      </tr>
			                    </thead>
			                	<tbody>
			                		<div id="botones">
			                		<?php  
										$listarArchivosSubidosGeneral->listarDocumentosSubidosGeneralController();
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
	var botonesEliminar = document.getElementsByClassName("btn btn-danger");
	//console.log(botonesEliminar);
	for (var i = 0; i < botonesEliminar.length; i++) {
		botonesEliminar[i].addEventListener('click',capturarEvento,false);
	}
	function capturarEvento(e){
		e.preventDefault();
		var id = e.target.getAttribute('href');
		var categoria = e.target.getAttribute('categoria');
		var aviso = e.target.getAttribute('aviso');
		if (aviso) {
			console.log(id+categoria);
			mostrarMensajeAviso(id,categoria);
		}else{
			console.log(id+categoria);
			mostrarMensajeCategoria(id,categoria);
		}
	}
	function mostrarMensajeCategoria(id,categoria){
		swal({
		  title: 'Deseas eliminar el categoria de '+categoria,
		  text: "Este paso no se puede revertir!",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si, eliminar'
		}).then((result) => {
		  if (result.value) {
		    window.location="index.php?action=listarCategorias&eliminar="+id;
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
	function mostrarMensajeAviso(id,categoria){
		swal({
		  title: 'Deseas eliminar el aviso del Numeral '+categoria,
		  text: "Este paso no se puede revertir!",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si, eliminar'
		}).then((result) => {
		  if (result.value) {
		    window.location="index.php?action=listarCategorias&eliminarAviso="+id;
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
	var hora = new Date();
	document.title="Archivos Subidos";
</script>
