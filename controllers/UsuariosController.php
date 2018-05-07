<?php
class UsuariosController{
	// INSERTARA UN USUARIO EN LA BASE DE DATOS
	public function CrearUsuarioController(){
		if (isset($_POST['nombresCrearUsuario'])) {
			//empezamos a validar
			//que no vayan vacios y que no sean expresiones regulares
			if (isset(
				$_POST['nombresCrearUsuario']) || 
				isset($_POST['apellidosCrearUsuario']) || 
				isset($_POST['usuarioCrearUsuario']) || 
				isset($_POST['passwordCrearUsuario']) || 
				isset($_POST['repPasswordCrearUsuario']) || 
				isset($_POST['emailCrearUsuario']) || 
				isset($_POST['urlFotoCrearUsuario']) || 
				isset($_POST['rolCrearUsuario']) || 
				isset($_POST['preguntaSeguridadCrearUsuario']) || 
				isset($_POST['respuestaSeguridadCrearUsuario'])) {
				


				if (!empty(
				$_POST['nombresCrearUsuario']) || 
				!empty($_POST['apellidosCrearUsuario']) || 
				!empty($_POST['usuarioCrearUsuario']) || 
				!empty($_POST['passwordCrearUsuario']) || 
				!empty($_POST['repPasswordCrearUsuario']) || 
				!empty($_POST['emailCrearUsuario']) || 
				!empty($_POST['rolCrearUsuario']) || 
				!empty($_POST['preguntaSeguridadCrearUsuario']) || 
				!empty($_POST['respuestaSeguridadCrearUsuario'])) {

					//validar que no se reciban expresiones regulares

					// $expRegNombres = '/^(?![ .]+$)[a-zA-Z .]*$/';
					$expRegNombres = '/^(?![ .]+$)[a-zA-Z .]*$/';
					$expRegCamposTexto = '/^[a-zA-Z0-9]*$/';
					// $expRegCamposTexto = '/^[a-zA-Z0-9]*$/';
					$expRegPassword = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).*$/';
					$expRegEmail = '/^\w+([\.\+\-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/';

					if (preg_match($expRegNombres, $_POST['nombresCrearUsuario'])
					&&	preg_match($expRegNombres, $_POST['apellidosCrearUsuario'])  
					&&	preg_match($expRegCamposTexto, $_POST['usuarioCrearUsuario']) 
					&&	preg_match($expRegCamposTexto, $_POST['urlFotoCrearUsuario']) 
					&&	preg_match($expRegCamposTexto, $_POST['rolCrearUsuario']) 
					&&	preg_match($expRegCamposTexto, $_POST['preguntaSeguridadCrearUsuario']) 
					&&	preg_match($expRegCamposTexto, $_POST['respuestaSeguridadCrearUsuario'])) {
						//que cumplan con los requerimientos de las contraseñas y que sean iguales
						
						if (preg_match($expRegPassword, $_POST['passwordCrearUsuario']) 
						&& 	preg_match($expRegPassword, $_POST['repPasswordCrearUsuario']) ) {

							if ($_POST['passwordCrearUsuario']==$_POST['repPasswordCrearUsuario']) {
								
								if (preg_match($expRegEmail, $_POST['emailCrearUsuario'])) {

									if (empty($_POST['urlFotoCrearUsuario'])) {
										$_POST['urlFotoCrearUsuario'] = "views/images/avatar.png";
									}

									if (empty($_POST['rolCrearUsuario'])) {
										$_POST['rolCrearUsuario'] = "usuario";
									}

									$datos = array(
									"nombres"=>$_POST['nombresCrearUsuario'],
									"apellidos"=>$_POST['apellidosCrearUsuario'],
									"usuario"=>$_POST['usuarioCrearUsuario'],
									"password"=>$_POST['passwordCrearUsuario'],
									"confirmacionPassword"=>$_POST['repPasswordCrearUsuario'],
									"email"=>$_POST['emailCrearUsuario'],
									"urlFoto"=>$_POST['urlFotoCrearUsuario'],
									"rol"=>$_POST['rolCrearUsuario'],
									"preguntaSecreta"=>$_POST['preguntaSeguridadCrearUsuario'],
									"respuestaSecreta"=>$_POST['respuestaSeguridadCrearUsuario']);
									//echo "<pre>",print_r($datos),"</pre>";
									$respuesta = UsuariosModel::CrearUsuarioModel($datos,"usuarios");
									if ($respuesta=='success') {
										header('Location:index.php?action=crearUsuario&not=success');
									}else{
										echo "	<script>
													swal({
													  type: 'error',
													  title: 'Oops...',
													  text: 'No se pudo crear el nuevo usuario',
													})
												</script>";
									}
								
								}else{
									echo "	<script>
											swal({
											  type: 'error',
											  title: 'Oops...',
											  text: 'Por favor ingrese un correo elecronico valido',
											})
										</script>";
								}//VALIDACION DEL EMAIL	

							}else{
								echo "	<script>
											swal({
											  type: 'error',
											  title: 'Alerta...',
											  text: 'Las contraseñas no coinciden',
											})
										</script>";
							}//VALIDACION DE QUE LOS PASSWORDS SEAN IGUALES

													
						}else{
							echo "	<script>
										swal({
										  type: 'error',
										  title: 'Alerta...',
										  text: 'Las contraseñas deben contener 1 mayuscula, 1 minuscula y 1 número minimo y NO DEBE CONTENER CARACTERES ESPECIALES',
										})
									</script>";
						}//VALIDACION DE LOS PASSWORDS
					}else{
						echo "	<script>
										swal({
										  type: 'error',
										  title: 'Alerta...',
										  text: 'No esta permitido el ingreso de caracteres especiales',
										})
									</script>";
					}//VALIDACION DE CAMPOS TEXTO PARA EVITAR EXPRESIONES REGULARES
				}else{
					echo "	<script>
								swal({
								  type: 'error',
								  title: 'Alerta...',
								  text: 'No puede quedar ningun campo vacio a excepcion de la foto',
								})
							</script>";
				}//VALIDACION DE QUE LOS CAMPOS NO ESTEN VACIOS
			}else{
				echo "	<script>
							swal({
							  type: 'error',
							  title: 'Alerta...',
							  text: 'No puede quedar ningun campo vacio a excepcion de la foto',
							})
						</script>";
			}//VALIDACION DE QUE EXISTAN LAS VARIABLES POST QUE SE RECIBEN
		}//VALIDACION INICIAL PARA COMPROBAR QUE ESTE SETEADO EL PRIMER VALOR
	}// FIN DEL METODO CREAR USUARIO CONTROLLER PARA INSERTAR USUARIOS EN LA BASE DE DATOS

	public function validarUsuarioAjaxController($datos){
		$respuesta = UsuariosModel::validarUsuarioAjaxModel($datos,"usuarios");
		//var_dump($respuesta);
		$existe=(int)$respuesta['existencia'];
		//var_dump($existe);
		if ($existe>0) {
			return 'existe';
		}
	}


	public function validarEmailAjaxController($datos){
		$respuesta = UsuariosModel::validarEmailAjaxModel($datos,"usuarios");
		$existe=(int)$respuesta['existencia'];
		if ($existe>0) {
			return 'existe';
		}
	}
}