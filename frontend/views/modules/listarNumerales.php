<?php  
session_start();
if (!$_SESSION['verificar']) {
  header('Location:index.php');
}
if (isset($_GET['action'])) {
	if ($_GET['action']=='notCrearNumeralesOk') {
		echo "
		<script>
			swal({
			  position: 'top-end',
			  type: 'success',
			  title: 'Numeral Creado exitosamente!',
			  showConfirmButton: false,
			  timer: 1500
			})
		</script>";
	}
}
if (isset($_GET['action'])) {
	if ($_GET['action']=='notEditarNumeralOk') {
		echo "
		<script>
			swal({
			  position: 'top-end',
			  type: 'success',
			  title: 'Numeral Editado exitosamente!',
			  showConfirmButton: false,
			  timer: 1500
			})
		</script>";
	}
}
if (isset($_GET['action'])) {
	if ($_GET['action']=='notEliminarNumeralOk') {
		echo "
		<script>
			swal({
			  position: 'top-end',
			  type: 'success',
			  title: 'Numeral Eliminado exitosamente!',
			  showConfirmButton: false,
			  timer: 1500
			})
		</script>";
	}
}
if (isset($_GET['action'])) {
	if ($_GET['action']=='notAgregarReglaNumeralOk') {
		echo "
		<script>
			swal({
			  position: 'top-end',
			  type: 'success',
			  title: 'Nueva Regla establecida exitosamente!',
			  showConfirmButton: false,
			  timer: 1500
			})
		</script>";
	}
}
if (isset($_GET['action'])) {
	if ($_GET['action']=='notEliminarAvisoNumeralOk') {
		echo "
		<script>
			swal({
			  position: 'top-end',
			  type: 'success',
			  title: 'Regla eliminada exitosamente!',
			  showConfirmButton: false,
			  timer: 1500
			})
		</script>";
	}
}
$listarNumerales = new NumeralController();
$listarNumerales->eliminarNumeralController();
$listarNumerales->eliminarAvisoNumeralController();
//$listarNumerales->listarNumeralesController();
?>
<?php require_once "navbar.php"; ?>
<?php require_once "sidebar.php"; ?>
<div class="be-content">
	<div class="page-head">
	  <h2 class="page-head-title">Numerales</h2>
	  <ol class="breadcrumb page-head-nav">
	    <li><a href="#">Inicio</a></li>
	    <li><a href="#">Numerales</a></li>
	    <li class="active">Lista Numerales</li>
	  </ol>
	</div>
	<div class="main-content container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default panel-table">
					<div class="panel-heading">Numerales
			          <div class="tools"><span class="icon mdi mdi-download"></span><span class="icon mdi mdi-more-vert"></span>
			          </div>
			        </div>
			        <div class="panel-body">
			        	<div class="table-responsive">
			        		<table id="table6" class="table table-striped table-hover table-fw-widget">
			                    <thead>
			                      <tr>
			                        <th>Numerales</th>
			                        <th>Agregar Regla</th>
			                        <th>Eliminar Regla</th>
			                        <th>Editar</th>
			                        <th>Eliminar</th>
			                      </tr>
			                    </thead>
			                	<tbody>
			                		<div id="botones">
			                		<?php  
										$listarNumerales->listarNumeralesController();
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
		var numeral = e.target.getAttribute('numeral');
		var aviso = e.target.getAttribute('aviso');
		if (aviso) {
			console.log(id+numeral);
			mostrarMensajeAviso(id,numeral);
		}else{
			console.log(id+numeral);
			mostrarMensajeNumeral(id,numeral);
		}
	}
	function mostrarMensajeNumeral(id,numeral){
		swal({
		  title: 'Deseas eliminar el numeral de '+numeral,
		  text: "Este paso no se puede revertir!",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si, eliminar'
		}).then((result) => {
		  if (result.value) {
		    window.location="index.php?action=listarNumerales&eliminar="+id;
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
	function mostrarMensajeAviso(id,numeral){
		swal({
		  title: 'Deseas eliminar el aviso del Numeral '+numeral,
		  text: "Este paso no se puede revertir!",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si, eliminar'
		}).then((result) => {
		  if (result.value) {
		    window.location="index.php?action=listarNumerales&eliminarAviso="+id;
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
	document.title="Numerales";
</script>
