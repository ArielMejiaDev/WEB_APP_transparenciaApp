<?php  
session_start();
if (!$_SESSION['verificar']) 
{
  header('Location:index.php');
}
$datosUsuario = new DatosUsuarioController();
$datos = $datosUsuario->getDatosUsuarioController();
$rol = $datos['rol'];
$idUsuario = (int)$datos['id'];
$idDeptoUsuario = $datos['id_departamento'];
if (isset($_GET['n_doc']) && !empty($_GET['n_doc']))
{
    $n_doc = $_GET['n_doc'];
}
$listarArchivosSubidosGeneral = new DocController();
$listarArchivosSubidosGeneral->publicarDocController($idUsuario);
$listarArchivosSubidosGeneral->aprobarDocController($idUsuario);
?>
<?php require_once "navbar.php"; ?>
<?php require_once "sidebar.php"; ?>
<div class="be-content">
	<div class="page-head">
	  <h2 class="page-head-title">Archivo individual</h2>
	  <ol class="breadcrumb page-head-nav">
	    <li><a href="#">Inicio</a></li>
	    <li><a href="#">Archivos</a></li>
	    <li class="active">Archivo individual</li>
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
                                        <?php $editar = ($rol=='editor') ? '' : '<th>Editar</th>' ; ?>
                                        <?php echo $editar;?>
                                        <?php $aprobar = ($rol=='editor' || $rol=='redactor') ? '' : '<th>Aprobar</th>' ; ?>
                                        <?php echo $aprobar;?>
                                        <?php $publicar = ($rol=='jefeRedaccion' || $rol=='redactor') ? '' : '<th>Publicar</th>' ; ?>
                                        <?php echo $publicar;?>
                                        <?php $rechazar = ($rol=='redactor') ? '' : '<th>Rechazar</th>' ; ?>
                                        <?php echo $rechazar;?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <div id="botones">
                                    <?php
                                        $doc = $listarArchivosSubidosGeneral->documentoIndividualSubidoController($rol, $n_doc);
                                        var_dump($doc);
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
	var botonesPublicar = document.getElementsByClassName("btn btn-success");
	//console.log(botonesEliminar);
	for (var i = 0; i < botonesPublicar.length; i++) {
		botonesPublicar[i].addEventListener('click',capturarEvento,false);
	}
	function capturarEvento(e){
		e.preventDefault();
		var id = e.target.getAttribute('href');
		var documento = e.target.getAttribute('documento');
		var aviso = e.target.getAttribute('aviso');
		if (aviso) {
			console.log(id+categoria);
			mostrarMensajeAviso(id,categoria);
		}else{
			console.log(id+documento);
			mostrarMensajeCategoria(id,documento);
		}
	}
	function mostrarMensajeCategoria(id,documento){
		swal({
		  title: 'Deseas publicar el documento '+documento,
		  text: "Este paso no se puede revertir!",
		  type: 'question',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si, eliminar'
		}).then((result) => {
		  if (result.value) {
		    window.location="index.php?action=listarArchivosSubidosGeneral&publicar="+id;
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
	//ojo
	function mostrarMensajeAviso(id,categoria){
		swal({
		  title: 'Deseas eliminar el aviso del Numeral '+categoria,
		  text: "Este paso no se puede revertir!",
		  type: 'question',
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
	document.title="Archivo Individual";
</script>
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
		  type: 'question',
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
