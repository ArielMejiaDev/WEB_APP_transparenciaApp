<?php  
session_start();
if (!$_SESSION['verificar']) {
  header('Location:index.php');
}
$crearUsuario = new UsuariosController();
$crearUsuario->CrearUsuarioController();
if (isset($_GET['not'])) {
	if ($_GET['not']=='success') {
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
?>
<div class="be-wrapper be-fixed-sidebar">
	<div class="be-content">
	    <div class="main-content container-fluid">
			<div class="row">
	          	<?php include_once "views/modules/header.php"; ?>
	        	<?php include_once "views/modules/sidebar.php"; ?>
	        	<div class="row">
	<div class="col-sm-12">
	  	<div class="panel panel-default panel-border-color panel-border-color-primary">
	        <div class="panel-heading panel-heading-divider"><i class="icon mdi mdi-accounts"></i> Usuarios		<span class="panel-subtitle">lista de usuarios.</span>
	        </div>
    		<div class="panel panel-default panel-table">
	            <div class="panel-heading">Default
	              <div class="tools"><span class="icon mdi mdi-download"></span><span class="icon mdi mdi-more-vert"></span></div>
	            </div>
            	<div class="panel-body">
	              	<table id="usuarios" class="table table-striped table-hover table-fw-widget">
	                    <thead>
	                      <tr>
	                        <th>Usuario</th>
	                        <th>Rol</th>
	                        <th>Editar</th>
	                        <th>Eliminar</th>
	                      </tr>
	                    </thead>
	                    <tbody>
							<tr class="odd gradeX">
								<td>Trident</td>
								<td>
								  Internet
								  Explorer 4.0
								</td>
								<td>Win 95+</td>
								<td class="center"> 4</td>
							</tr>
							<tr class="odd gradeA">
								<td>Trident</td>
								<td>Internet Explorer 7</td>
								<td>Win XP SP2+</td>
								<td class="center">7</td>
							</tr>
							<tr class="even gradeA">
								<td>Trident</td>
								<td>AOL browser (AOL desktop)</td>
								<td>Win XP</td>
								<td class="center">6</td>
							</tr>
							<tr class="gradeA">
								<td>Gecko</td>
								<td>Firefox 1.0</td>
								<td>Win 98+ / OSX.2+</td>
								<td class="center">1.7</td>
							</tr>
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

    
    <script type="text/javascript">
      $(document).ready(function(){
      	//initialize the javascript
      	App.init();
      	App.dataTables();
      });
    </script>