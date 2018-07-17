<?php  
session_start();
if (!$_SESSION['verificar']) {
  header('Location:index.php');
}
if (isset($_GET['action'])) {
	if ($_GET['action']=='notEliminarUsuarioOk') {
		echo "
		<script>
			swal({
			  position: 'top-end',
			  type: 'success',
			  title: 'Usuario Eliminado!',
			  showConfirmButton: false,
			  timer: 1500
			})
		</script>";
	}
}
if (isset($_GET['action'])) {
  if ($_GET['action']=='notEditarUsuarioOk') {
    echo "  <script>
          swal({
            position: 'top-end',
            type: 'success',
            title: 'Usuario editado exitosamente!',
            showConfirmButton: false,
            timer: 1500
          })
        </script>";
  }
}
if (isset($_GET['action'])) {
	if ($_GET['action']=='notCrearUsuarioOk') {
		echo "	<script>
					swal({
					  position: 'top-end',
					  type: 'success',
					  title: 'Usuario grabado exitosamente!',
					  showConfirmButton: false,
					  timer: 1500
					})
				</script>";
	}
}
$usuarios = new UsuariosController();
$usuarios->eliminarUsuariosController();
?>
<?php require_once "navbar.php"; ?>
<?php require_once "sidebar.php"; ?>
<div class="be-content">
	<div class="page-head">
	  <h2 class="page-head-title">Usuarios</h2>
	  <ol class="breadcrumb page-head-nav">
	    <li><a href="#">Inicio</a></li>
	    <li><a href="#">Usuarios</a></li>
	    <li class="active">Lista Usuarios</li>
	  </ol>
	</div>
	<div class="main-content container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default panel-table">
					<div class="panel-heading">Escritorio
			          <div class="tools"><span class="icon mdi mdi-download"></span><span class="icon mdi mdi-more-vert"></span>
			          </div>
			        </div>
			        <div class="panel-body">
			        	<div class="table-responsive">
			        		<table id="table6" class="table table-striped table-hover table-fw-widget">
			                    <thead>
			                      <tr>
			                        <th>Usuario</th>
			                        <th>Rol</th>
			                        <th>Editar</th>
			                        <th>Eliminar</th>
			                      </tr>
			                    </thead>
			                	<tbody>
			                		<div id="botones">
			                		<?php  
										$usuarios->listarUsuariosController();
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
		var usuario = e.target.getAttribute('usuario');
		console.log(id);
		mostrarMensaje(id,usuario);
	}
	function mostrarMensaje(id,usuario){
		swal({
		  title: 'Deseas eliminar al usuario '+usuario,
		  text: "Este paso no se puede revertir!",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si, eliminar'
		}).then((result) => {
		  if (result.value) {
		    window.location="index.php?action=listarUsuarios&eliminar="+id;
		  }else if (
			    // Read more about handling dismissals
			    result.dismiss === swal.DismissReason.cancel
			  ) {
			    swal(
			      'Cancelado',
			      'No se elimino ningun registro',
			      'error'
			    )
			  }
		})
	}
	var hora = new Date();
	document.title="Usuarios";
</script>
<!-- <div id="mod-danger" tabindex="-1" role="dialog" class="modal fade" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
      </div>
      <div class="modal-body">
        <div class="text-center">
          <div class="text-danger"><span class="modal-main-icon mdi mdi-close-circle-o"></span></div>
          <h3>Danger!</h3>
          <p>Desea eliminar al usuario: <br><?php echo $id; ?></p>
          <div class="xs-mt-50">
            <button type="button" data-dismiss="modal" class="btn btn-space btn-default">Cancel</button>
            <button type="button" data-dismiss="modal" class="btn btn-space btn-danger">Proceed</button>
          </div>
        </div>
      </div>
      <div class="modal-footer"></div>
    </div>
  </div>
</div> -->
