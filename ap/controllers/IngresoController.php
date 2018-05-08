<?php  
class IngresoController{
	public function validarIngresoController(){
		if (isset($_POST['usuarioIngreso'])) {
			if (preg_match('/^[a-zA-Z0-9]*$/', $_POST['usuarioIngreso']) && preg_match('/^[a-zA-Z0-9]*$/', $_POST['passwordIngreso'])) {
				if ( !empty( $_POST['usuarioIngreso'] ) && !empty( $_POST['passwordIngreso'] ) ) {
					$datos = array("usuarioIngreso"=>$_POST['usuarioIngreso'] , "passwordIngreso"=>$_POST['passwordIngreso']);
					$respuesta = IngresoModel::validarIngresoModel($datos);
					$maximoIntentos = 2;
					$intentos = $respuesta['intentos'];//trae el numero de la bd de intentos
						if ($intentos<$maximoIntentos) {
							if ($respuesta['usuario'] == $_POST['usuarioIngreso'] && $respuesta['password'] == $_POST['passwordIngreso']) {
							$intentos = 0;
							$datosActulizarIntentos = array("usuario"=>$_POST['usuarioIngreso'], "intentos"=>$intentos);
							$respuestaActualizarIntentos = IngresoModel::actualizarIntentosModel($datosActulizarIntentos);
							session_start();
							$_SESSION['verificar'] = true;
							$_SESSION['usuario'] = $_POST['usuarioIngreso'];
							header('Location:index.php?action=dashboard');

						}else{
							++$intentos;
							$datosActulizarIntentos = array("usuario"=>$_POST['usuarioIngreso'], "intentos"=>$intentos);
							$respuestaActualizarIntentos = IngresoModel::actualizarIntentosModel($datosActulizarIntentos);
							header('Location:index.php?action=errorIngreso');
						}
					}else{
							$intentos = 0;
							$datosActulizarIntentos = array("usuario"=>$_POST['usuarioIngreso'], "intentos"=>$intentos);
							$respuestaActualizarIntentos = IngresoModel::actualizarIntentosModel($datosActulizarIntentos);
							header('Location:index.php?action=preguntaSecreta&preguntaSeguridad='.$respuesta["pregunta_seguridad"].'&usuario='.$respuesta['usuario'].' ');
					}
					
				}else{
					// SI ENVIA DATOS VACIOS
					echo 	'<div role="alert" class="alert alert-contrast alert-danger alert-dismissible">
		                    	<div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
		                    	<div class="message">
		                      	<button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Alerta!</strong> Usuario y/o Contraseña vacios.
		                    	</div>
		                 	</div>';
				}
			}else{
				//SI ENVIA CARACTERES ESPECIALES
				echo 	'<div role="alert" class="alert alert-contrast alert-danger alert-dismissible">
		                    <div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
		                    <div class="message">
		                      <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Alerta!</strong> Usuario y/o Contraseña invalidos.
		                    </div>
		                 </div>';
			}
		} //primer if
	}
	// COMPROBAR LA PREGUNTA DE SEGURIDAD PARA DEJARLO ENTRAR A FORMULARIO PARA EDITAR SU CONTRASEÑA
	public function comprobarRespuestaSeguraController(){
		if (isset($_POST['usuarioSeguridad'])) {
			//echo "Usuario : " . $_POST['usuarioSeguridad'] . "<br/>Pregunta de Seguridad: " . $_POST['preguntaSeguridad'] . "<br/>Respuesta de Seguridad: " . $_POST['respuestaSeguridad'];
			$datos = array("usuario"=>$_POST['usuarioSeguridad'], "pregunta"=>$_POST['preguntaSeguridad'] , "respuesta"=>$_POST['respuestaSeguridad']); 
			//var_dump($datos['usuario']);
			$respuesta = IngresoModel::comprobarRespuestaSeguraModel($datos);
			if ($_POST['usuarioSeguridad']==utf8_encode($respuesta['usuario']) && $_POST['preguntaSeguridad']==utf8_encode($respuesta['pregunta_seguridad']) && $_POST['respuestaSeguridad']==utf8_encode($respuesta['respuesta_seguridad'])) {
					$_SESSION['verificar'] == true;
					$_SESSION['usuario'] = $_POST['usuarioIngreso'];
					header('Location:index.php?action=formCambiarPassword&usuario='.$_POST['usuarioSeguridad'].'');
			}else{
				echo 	'<div role="alert" class="alert alert-contrast alert-danger alert-dismissible">
		                    <div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
		                    <div class="message">
		                      <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Alerta!</strong> la respuesta de seguridad no coincide, por favor volver a intentar.
		                    </div>
		                 </div>';
			}
		}
	}

	//CONTROLADOR PARA CAMBIAR LA CONTRASEÑA EN EL FORMULARIO DE CAMBIAR CONTRASEÑA
	public function cambiarContraseñaController(){
		//si esta seteados los valores del formulario
		if (isset($_POST['usuario']) && isset($_POST['nuevoPassword']) && isset($_POST['repitePassword']) ){
			//si no coinciden con alguna expresion regular
			if (preg_match('/^[a-zA-Z0-9]*$/', $_POST['usuario']) && preg_match('/^[a-zA-Z0-9]*$/', $_POST['nuevoPassword']) && preg_match('/^[a-zA-Z0-9]*$/', $_POST['repitePassword']) ) {
				// si no estan vacios
				if (!empty($_POST['usuario']) && !empty($_POST['nuevoPassword']) && !empty($_POST['repitePassword']) ) {
					if (strlen($_POST['nuevoPassword'])>=8) {
						if (preg_match("/[A-Z]/", $_POST['nuevoPassword']) ) {
							if (preg_match("/[a-z]/", $_POST['nuevoPassword']) ) {
								if (preg_match("/[0-9]/", $_POST['nuevoPassword']) ) {
									// si coinciden las contraseñas
									if ($_POST['nuevoPassword'] == $_POST['repitePassword']) {
										$datos = array("usuario"=>$_POST['usuario'],"password"=>$_POST['nuevoPassword']);
										//var_dump($datos);
										$respuesta = IngresoModel::cambiarContraseñaModel($datos,"usuarios");
										if ($respuesta=='success') {
											header('Location:index.php');
										}else{
											echo 	'<div role="alert" class="alert alert-contrast alert-danger alert-dismissible">
						                    	<div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
						                    	<div class="message">
						                      		<button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Alerta!</strong> Error.
						                    	</div>
						                 	</div>';
										}
									}
								}else{
									echo 	'<div role="alert" class="alert alert-contrast alert-danger alert-dismissible">
				                    	<div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
				                    	<div class="message">
				                      		<button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Alerta!</strong> La contraseña debe contener al menos un numero.
				                    	</div>
				                 	</div>';
								}
							}else{
								echo 	'<div role="alert" class="alert alert-contrast alert-danger alert-dismissible">
		                    	<div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
		                    	<div class="message">
		                      		<button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Alerta!</strong> La contraseña debe contener al menos una minuscula.
		                    	</div>
		                 	</div>';
							}
						}else{
							echo 	'<div role="alert" class="alert alert-contrast alert-danger alert-dismissible">
		                    	<div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
		                    	<div class="message">
		                      		<button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Alerta!</strong> La contraseña debe tener como minimo una mayuscula.
		                    	</div>
		                 	</div>';
						}
					}else{
						echo 	'<div role="alert" class="alert alert-contrast alert-danger alert-dismissible">
		                    	<div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
		                    	<div class="message">
		                      		<button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Alerta!</strong> La nueva contraseña debe contener un minimo de 8 digitos.
		                    	</div>
		                 	</div>';
					}
				}else{
					echo 	'<div role="alert" class="alert alert-contrast alert-danger alert-dismissible">
		                    	<div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
		                    	<div class="message">
		                      		<button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Alerta!</strong> La contraseña no puede estar vacia.
		                    	</div>
		                 	</div>';
				}
				
			}else{
				echo 	'<div role="alert" class="alert alert-contrast alert-danger alert-dismissible">
		                    	<div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
		                    	<div class="message">
		                      		<button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Alerta!</strong> No estan permitidos los caracteres especiales.
		                    	</div>
		                 	</div>';
			}
		}
	}
}
?>