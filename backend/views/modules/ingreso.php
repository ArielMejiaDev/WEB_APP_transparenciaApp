<div class="be-splash-screen">
	<div class="be-wrapper be-login">
		<div class="be-content">
		    <div class="main-content container-fluid">
		      	<div class="splash-container">
		        	<div class="panel panel-default panel-border-color panel-border-color-primary">
		          		<div class="panel-heading"><img src="views/images/favicon.ico" alt="logo" width="50" height="50" class="logo-img"><span class="splash-description">Por favor ingresa tus datos para ingresar al sistema.</span>
		          		</div>
	          			<div class="panel-body">
	            			<form method="post">
	              				<div class="form-group">
	                				<input id="usuarioIngreso" name="usuarioIngreso" type="text" placeholder="Usuario" autocomplete="off" class="form-control">
	              				</div>
	              				<div class="form-group">
	                				<input id="passwordIngreso" name="passwordIngreso" type="password" placeholder="Contraseña" class="form-control">
	              				</div>
	              				<div class="form-group row login-tools">
	                				<div class="col-xs-6 login-forgot-password pull-right"><a href="#">¿Olvidaste tu contraseña?</a></div>
	              				</div>
	              				<?php  
	              					$validarUsuario = new IngresoController();
	              					$validarUsuario->validarIngresoController();
	              					if (isset($_GET['action'])) {
	              						if ($_GET['action'] == 'errorIngreso') {
	              							echo 	'<div role="alert" class="alert alert-contrast alert-danger alert-dismissible">
		                    						<div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
		                    						<div class="message">
		                      						<button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Alerta!</strong> Usuario y/o Contraseña incorrectos, favor volver a ingresar datos.
		                    						</div>
		                 						</div>';
	              						}
	              						if ($_GET['action'] == 'errorTresFallosIngreso') {
	              							echo 	'<div role="alert" class="alert alert-contrast alert-danger alert-dismissible">
		                    						<div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
		                    						<div class="message">
		                      						<button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Alerta!</strong> Ops! se han fallado 3 veces en ingresar al sistema, deberá contestar la pregunta secreta.
		                    						</div>
		                 						</div>';
	              						}
	              					}
	              				?>
	              				<div class="form-group login-submit">
	                				<button id="validarUsuario" data-dismiss="modal" type="submit" class="btn btn-primary btn-xl">Ingresar</button>
	              				</div>
	            			</form>
	          			</div>
		        	</div>
		      	</div>
		    </div>
		</div>
	</div>
</div>