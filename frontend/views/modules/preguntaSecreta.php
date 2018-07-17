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
	                				<label for="preguntaSecreta" class="control-label text-danger"><h3><strong>¿ <?php echo utf8_encode($_GET['preguntaSeguridad']); ?> ?</strong></h3></label>
	              				</div>
	              				<div class="form-group">
	                				<input id="usuarioSeguridad" name="usuarioSeguridad" type="hidden" placeholder="" class="form-control" value="<?php echo utf8_encode($_GET['usuario']);  ?>">
	              				</div>
	              				<div class="form-group">
	                				<input id="preguntaSeguridad" name="preguntaSeguridad" type="hidden" placeholder="" class="form-control" value="<?php echo utf8_encode($_GET['preguntaSeguridad']);  ?>">
	              				</div>
	              				<div class="form-group">
	                				<input id="respuestaSeguridad" name="respuestaSeguridad" type="password" placeholder="Responde a la pregunta" class="form-control">
	              				</div>
	              				<?php  
	              					$comprobarPreguntaSeguridad = new IngresoController();
	              					$comprobarPreguntaSeguridad->comprobarRespuestaSeguraController();
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