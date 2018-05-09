<?php  
session_start();
if (!$_SESSION['verificar']) {
  header('Location:index.php');
}

?>
<?php require_once "navbar.php"; ?>
<?php require_once "sidebar.php"; ?>
<div class="be-content">
	<div class="page-head">
	  <h2 class="page-head-title">Data Tables</h2>
	  <ol class="breadcrumb page-head-nav">
	    <li><a href="#">Home</a></li>
	    <li><a href="#">Tables</a></li>
	    <li class="active">Data Tables</li>
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
