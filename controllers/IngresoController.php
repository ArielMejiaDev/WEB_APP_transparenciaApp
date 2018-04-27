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
							$_SESSION['verificar'] == true;
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
							header('Location:index.php?action=preguntaSecreta&preguntaSeguridad='.$respuesta["pregunta_seguridad"].'&usuario= '.$respuesta['usuario'].' ');
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
			var_dump($respuesta);
		}
	}
}
?>