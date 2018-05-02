<div class="be-splash-screen">
	<div class="be-wrapper be-login">
		<div class="be-content">
		    <div class="main-content container-fluid">
		      	<div class="splash-container">
		        	<div class="panel panel-default panel-border-color panel-border-color-primary">
		          		<div class="panel-heading"><img src="views/images/favicon.ico" alt="logo" width="50" height="50" class="logo-img"><span class="splash-description">Por favor ingrese su nueva contraseña, debe contener 8 digitos y al menos una mayuscula y una minuscula</span>
		          		</div>
	          			<div class="panel-body">
	            			<form method="post" onsubmit="return validarPassword2()">
	            				<div class="form-group">
	                				<input id="usuario" name="usuario" type="hidden" class="form-control" value="<?php echo $_GET['usuario']; ?>">
	              				</div>
	              				<div class="form-group">
	                				<input id="nuevoPassword" name="nuevoPassword" type="text" placeholder="Nueva Contraseña" autocomplete="off" class="form-control" autofocus>
	              				</div>
	              				<div class="form-group">
	                				<input id="repitePassword" name="repitePassword" type="text" placeholder="Repite la nueva Contraseña" class="form-control" onblur="validarPassword()">
	              				</div>
	              				<div role="alert" class="alert alert-contrast alert-danger alert-dismissible" style="display: none;" id="validarPassword">
	              					<div class="icon"><span class="mdi mdi-close-circle-o"></span></div><div class="message"><button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Alerta!</strong> No coincide la contraseña!</div>
	              				</div>
	              				<?php  
	              					$validarUsuario = new IngresoController();
	              					$validarUsuario->cambiarContraseñaController();
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