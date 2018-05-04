<?php
class UsuariosController{
	// INSERTARA UN USUARIO EN LA BASE DE DATOS
	public function CrearUsuarioController(){
		if (isset($_POST['nombresCrearUsuario'])) {
			//empezamos a validar
			//que no vayan vacios y que no sean expresiones regulares
			if (isset(
				$_POST['nombresCrearUsuario']) && 
				isset($_POST['apellidosCrearUsuario']) && 
				isset($_POST['usuarioCrearUsuario']) && 
				isset($_POST['passwordCrearUsuario']) && 
				isset($_POST['repPasswordCrearUsuario']) && 
				isset($_POST['emailCrearUsuario']) && 
				isset($_POST['urlFotoCrearUsuario']) && 
				isset($_POST['rolCrearUsuario']) && 
				isset($_POST['preguntaSeguridadCrearUsuario']) && 
				isset($_POST['respuestaSeguridadCrearUsuario'])) {
				


				if (!empty(
				$_POST['nombresCrearUsuario']) && 
				!empty($_POST['apellidosCrearUsuario']) && 
				!empty($_POST['usuarioCrearUsuario']) && 
				!empty($_POST['passwordCrearUsuario']) && 
				!empty($_POST['repPasswordCrearUsuario']) && 
				!empty($_POST['emailCrearUsuario']) && 
				!empty($_POST['rolCrearUsuario']) && 
				!empty($_POST['preguntaSeguridadCrearUsuario']) && 
				!empty($_POST['respuestaSeguridadCrearUsuario'])) {

					//validar que no se reciban expresiones regulares

					$expRegNombres = '/^(?![ .]+$)[a-zA-Z .]*$/';
					$expRegCamposTexto = '/^[a-zA-Z0-9]*$/';
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
										header('Location:index.php?action=dashboard');
									}else{
										echo '	<div class="col-sm-6 col-sm-offset-3">
												<div role="alert" class="alert alert-contrast alert-danger alert-dismissible">
											    <div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
											        <div class="message">
											          <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Alerta!</strong> No se pudo insertar el nuevo usuario.
											        </div>
											  	</div>
											</div>';
									}
								
								}else{
									echo '	<div class="col-sm-6 col-sm-offset-3">
												<div role="alert" class="alert alert-contrast alert-danger alert-dismissible">
											    <div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
											        <div class="message">
											          <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Alerta!</strong> Por favor ingresar un correo electronico valido.
											        </div>
											  	</div>
											</div>';
								}//VALIDACION DEL EMAIL	

							}else{
								echo '	<div class="col-sm-6 col-sm-offset-3">
												<div role="alert" class="alert alert-contrast alert-danger alert-dismissible">
											    <div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
											        <div class="message">
											          <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Alerta!</strong> Las contraseñas no coinciden.
											        </div>
											  	</div>
											</div>';
							}//VALIDACION DE QUE LOS PASSWORDS SEAN IGUALES

													
						}else{
							echo '	<div class="col-sm-6 col-sm-offset-3">
										<div role="alert" class="alert alert-contrast alert-danger alert-dismissible">
									    <div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
									        <div class="message">
									          <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Alerta!</strong> La contraseña debe incluir 1 Mayuscula, 1 minuscula y 1 número como minimo.
									        </div>
									  	</div>
									</div>';
						}//VALIDACION DE LOS PASSWORDS
					}else{
						echo '	<div class="col-sm-6 col-sm-offset-3">
									<div role="alert" class="alert alert-contrast alert-danger alert-dismissible">
								    <div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
								        <div class="message">
								          <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Alerta!</strong> No esta permitido el ingreso de caracteres especiales.
								        </div>
								  	</div>
								</div>';
					}//VALIDACION DE CAMPOS TEXTO PARA EVITAR EXPRESIONES REGULARES
				}else{
					echo '	<div class="col-sm-6 col-sm-offset-3">
								<div role="alert" class="alert alert-contrast alert-danger alert-dismissible">
							    <div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
							        <div class="message">
							          <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Alerta!</strong> No puede quedar ningun campo vacio a excepcion de la foto.
							        </div>
							  	</div>
							</div>';
				}//VALIDACION DE QUE LOS CAMPOS NO ESTEN VACIOS
			}else{
				echo '	<div class="col-sm-6 col-sm-offset-3">
							<div role="alert" class="alert alert-contrast alert-danger alert-dismissible">
						    <div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
						        <div class="message">
						          <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Alerta!</strong> No puede quedar vacio ningun campo a excepcion de la foto.
						        </div>
						  	</div>
						</div>';
			}//VALIDACION DE QUE EXISTAN LAS VARIABLES POST QUE SE RECIBEN
		}//VALIDACION INICIAL PARA COMPROBAR QUE ESTE SETEADO EL PRIMER VALOR
	}// FIN DEL METODO CREAR USUARIO CONTROLLER PARA INSERTAR USUARIOS EN LA BASE DE DATOS
}
