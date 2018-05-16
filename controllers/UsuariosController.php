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
				isset($_POST['deptoCrearUsuario']) ||
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
				!empty($_POST['deptoCrearUsuario']) || 
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
					&&	preg_match($expRegNombres, $_POST['preguntaSeguridadCrearUsuario']) 
					&&	preg_match($expRegNombres, $_POST['respuestaSeguridadCrearUsuario'])) {
						//que cumplan con los requerimientos de las contraseñas y que sean iguales
						
						if (preg_match($expRegPassword, $_POST['passwordCrearUsuario']) 
						&& 	preg_match($expRegPassword, $_POST['repPasswordCrearUsuario']) ) {

							if ($_POST['passwordCrearUsuario']==$_POST['repPasswordCrearUsuario']) {
								
								if (preg_match($expRegEmail, $_POST['emailCrearUsuario'])) {

									if ($_POST['deptoCrearUsuario']!=0) {
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
										"password"=>password_hash($_POST['passwordCrearUsuario'],PASSWORD_DEFAULT),
										"confirmacionPassword"=>$_POST['repPasswordCrearUsuario'],
										"email"=>$_POST['emailCrearUsuario'],
										"departamento"=>$_POST['deptoCrearUsuario'],
										"urlFoto"=>$_POST['urlFotoCrearUsuario'],
										"rol"=>$_POST['rolCrearUsuario'],
										"preguntaSecreta"=>$_POST['preguntaSeguridadCrearUsuario'],
										"respuestaSecreta"=>$_POST['respuestaSeguridadCrearUsuario']);
										//echo "<pre>",print_r($datos),"</pre>";
										$respuesta = UsuariosModel::CrearUsuarioModel($datos,"usuarios");
										if ($respuesta=='success') {
											header('Location:notCrearUsuarioOk');
										}else{
											echo "	<script>
														swal({
														  type: 'error',
														  title: 'Oops...',
														  text: 'No se pudo crear el nuevo usuario *revisar respuesta del servidor',
														})
													</script>";
										}
									}else{
									echo "	<script>
											swal({
											  type: 'error',
											  title: 'Oops...',
											  text: 'Por favor debe seleccionar un departamento para el usuario',
											})
										</script>";
								}//VALIDACION DEL DEPARTAMENTO
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

	public function listarUsuariosController(){
		$respuesta = UsuariosModel::listarUsuariosModel("usuarios");
		//echo '<pre>',print_r($respuesta),'</pre>';
		$i=0;
		//$nombres = $respuesta['nombres'];
		foreach ($respuesta as $key => $value) {
			echo   '<tr class="odd gradeX">
						<td>'.$value["usuario"].'</td>
						<td>'.$value["rol"].'</td>
						<td>
							<a href="index.php?action=editarUsuario&id='.$value['id'].'" class="btn btn-primary">Editar
							</a>
						</td>
						<td>
							<button href="'.$value['id'].'" usuario="'.$value['usuario'].'" id="eliminar'.$value['id'].'" class="btn btn-danger">Eliminar
							</button>
						</td>
					</tr>';	
			$i++;              
		}
	}

	public function eliminarUsuariosController(){
		if (isset($_GET['eliminar'])) {
			$dato = $_GET['eliminar'];
			$respuesta = UsuariosModel::eliminarUsuariosModel($dato,"usuarios");
			if ($respuesta =='success') {
				// echo "	<script>
				// 			window.location.replace='notEliminarUsuarioOk';
				// 		</script>";
				echo header("Location:notEliminarUsuarioOk");
			}
		}
	}

	public function crearFormEditarUsuarioController(){
		if (isset($_GET['id'])) {
				$dato = $_GET['id']; 
				$respuesta = UsuariosModel::crearFormEditarUsuarioModel($dato,"usuarios","departamentos");
				

				//echo '<pre>',print_r($respuesta),'</pre>';
				echo '	<form style="border-radius: 0px;" class="form-horizontal group-border-dashed" onsubmit="return validarPassword()" method="post">
							<input type="hidden" id="valorRol" value="'.utf8_encode($respuesta['rol']).'" name="valorRol">
							<input type="hidden" id="idCrearUsuario" value="'.utf8_encode($respuesta['id']).'" name="idCrearUsuario">
	                        <div class="form-group">
	                          <label class="col-sm-3 control-label" for="nombresCrearUsuario">Nombres</label>
	                          <div class="col-sm-6">
	                            <input type="text" class="form-control" id="nombresCrearUsuario" name="nombresCrearUsuario" autofocus value="'.utf8_encode($respuesta['usuariosNombres']).'">
	                            <p id="avisoNombresCrearUsuario" class="text-danger text-muted" style="display: none"></p>
	                          </div>
	                          <label id="avisoNombresCrearUsuario" class="text-muted text-danger"></label>
	                        </div>
	                        <div class="form-group">
	                          <label class="col-sm-3 control-label" for="apellidosCrearUsuario">Apellidos</label>
	                          <div class="col-sm-6">
	                            <input type="text" class="form-control" id="apellidosCrearUsuario" name="apellidosCrearUsuario" value="'.utf8_encode($respuesta['apellidos']).'">
	                            <p id="avisoApellidosCrearUsuario" class="text-danger text-muted" style="display: none"></p>
	                          </div>
	                        </div>
	                        <div class="form-group">
	                          <label class="col-sm-3 control-label" for="usuarioCrearUsuario">Usuario</label>
	                          <div class="col-sm-6">
	                            <input type="text" class="form-control" id="usuarioCrearUsuario" name="usuarioCrearUsuario" value="'.utf8_encode($respuesta['usuario']).'" >
	                            <p id="avisoUsuarioCrearUsuario" class="text-danger text-muted" style="display: none"></p>
	                          </div>
	                        </div>
	                        <div class="form-group">
	                          <label class="col-sm-3 control-label" for="passwordCrearUsuario">Password</label>
	                          <div class="col-sm-6">
	                            <input type="password" class="form-control" id="passwordCrearUsuario" name="passwordCrearUsuario" placeholder="Aquí puede cambiar su contraseña" value="'.utf8_encode($respuesta['password']).'">
	                            <p id="avisoPasswordCrearUsuario" class="text-danger text-muted" style="display: none"></p>
	                          </div>
	                        </div>
	                        <div class="form-group">
	                          <label class="col-sm-3 control-label" for="repPasswordCrearUsuario">Repita password</label>
	                          <div class="col-sm-6">
	                            <input type="password" class="form-control" id="repPasswordCrearUsuario" name="repPasswordCrearUsuario" placeholder="Aquí debe confirmar su contraseña">
	                            <p id="avisoRepPasswordCrearUsuario" class="text-danger text-muted" style="display: none"></p>
	                          </div>
	                        </div>
	                        <div class="form-group">
	                          <label class="col-sm-3 control-label" for="emailCrearUsuario">Email</label>
	                          <div class="col-sm-6">
	                            <input type="email" class="form-control" id="emailCrearUsuario" name="emailCrearUsuario" value="'.utf8_encode($respuesta['email']).'">
	                            <p id="avisoEmailCrearUsuario" class="text-danger text-muted" style="display: none"></p>
	                          </div>
	                        </div>
	                        <div class="form-group">
							  <label class="col-sm-3 control-label" for="deptoCrearUsuario">Departamento:</label>
							  <div class="col-sm-6">
							    <select class="form-control" id="deptoCrearUsuario" name="deptoCrearUsuario">
							      <option value="'.$respuesta['id_departamento'].'">'.$respuesta['nombres'].'</option>
							    </select>
							  </div>
							</div>
	                        <div class="form-group">
	                          <label class="col-sm-3 control-label" for="urlFotoCrearUsuario">Url Foto</label>
	                          <div class="col-sm-6">
	                            <input type="text" class="form-control" id="urlFotoCrearUsuario" name="urlFotoCrearUsuario">
	                            <p id="avisoUrlFotoCrearUsuario" class="text-danger text-muted" style="display: none"></p>
	                          </div>
	                        </div>
	                        <div class="form-group">
	                          <label class="col-sm-3 control-label">Rol</label>
	                          <div class="col-sm-6">
								<label class="radio-inline">
									<input type="radio" class="radioButton" id="rol1" name="rolCrearUsuario" value="usuario">Usuario
								</label>
								<label class="radio-inline">
									<input type="radio" class="radioButton" id="rol2" name="rolCrearUsuario" value="editor">Editor
								</label>
								<label class="radio-inline">
									<input type="radio" class="radioButton" id="rol3" name="rolCrearUsuario" value="admin">Admin
								</label>
	                          </div>
	                        </div>
	                        <div class="form-group">
	                          <label class="col-sm-3 control-label" for="preguntaSeguridadCrearUsuario">Escribe tu pregunta de seguridad</label>
	                          <div class="col-sm-6">
	                            <div class="input-group xs-mb-15"><span class="input-group-addon">¿</span>
	                              <input type="text" class="form-control" id="preguntaSeguridadCrearUsuario" name="preguntaSeguridadCrearUsuario" value="'.utf8_encode($respuesta['pregunta_seguridad']).'"><span class="input-group-addon">?</span>
	                            </div>
	                          </div>
	                        </div>
	                        <div class="form-group" style="display: none" id="contenedorAvisoPreguntaSeguridadCrearUsuario">
	                          <div class="col-sm-6 col-sm-offset-3">
	                            <p id="avisoPreguntaSeguridadCrearUsuario" class="text-danger text-muted" style="display: none"></p>
	                          </div>
	                        </div>
	                        <div class="form-group">
	                          <label class="col-sm-3 control-label" for="respuestaSeguridadCrearUsuario">Escribe tu respuesta de seguridad</label>
	                          <div class="col-sm-6">
	                            <input type="password" class="form-control" id="respuestaSeguridadCrearUsuario" name="respuestaSeguridadCrearUsuario" value="'.utf8_encode($respuesta['respuesta_seguridad']).'">
	                            <p id="avisoRespuestaSeguridadCrearUsuario" class="text-danger text-muted" style="display: none"></p>
	                          </div>
	                        </div>
	                        <div class="form-group">
	                          <div class="col-sm-6 col-md-offset-3">
	                            <button type="submit" class="btn btn-info"><i class="icon mdi mdi-account-add"></i> Crear Usuario</button>
	                          </div>
	                        </div>
	                    </form>';
		}
	}

	public function actualizarUsuarioController(){
		if (isset($_POST['nombresCrearUsuario'])) {
			//empezamos a validar
			//que no vayan vacios y que no sean expresiones regulares
			if (isset(
				$_POST['idCrearUsuario']) ||
				isset($_POST['nombresCrearUsuario']) || 
				isset($_POST['apellidosCrearUsuario']) || 
				isset($_POST['usuarioCrearUsuario']) || 
				isset($_POST['passwordCrearUsuario']) || 
				isset($_POST['repPasswordCrearUsuario']) || 
				isset($_POST['emailCrearUsuario']) || 
				isset($_POST['urlFotoCrearUsuario']) || 
				isset($_POST['rolCrearUsuario']) || 
				isset($_POST['preguntaSeguridadCrearUsuario']) || 
				isset($_POST['respuestaSeguridadCrearUsuario'])) {
				


				if (
				!empty($_POST['idCrearUsuario']) ||
				!empty($_POST['nombresCrearUsuario']) || 
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

					if (preg_match($expRegCamposTexto, $_POST['idCrearUsuario'])
					&&	preg_match($expRegNombres, $_POST['nombresCrearUsuario'])
					&&	preg_match($expRegNombres, $_POST['apellidosCrearUsuario'])  
					&&	preg_match($expRegCamposTexto, $_POST['usuarioCrearUsuario']) 
					&&	preg_match($expRegCamposTexto, $_POST['urlFotoCrearUsuario']) 
					&&	preg_match($expRegCamposTexto, $_POST['rolCrearUsuario']) 
					&&	preg_match($expRegNombres, $_POST['preguntaSeguridadCrearUsuario']) 
					&&	preg_match($expRegNombres, $_POST['respuestaSeguridadCrearUsuario'])) {
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
									"id"=>$_POST['idCrearUsuario'],
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
									$respuesta = UsuariosModel::actualizarUsuarioModel($datos,"usuarios");
									if ($respuesta=='success') {
										header('Location:notEditarUsuarioOk');
									}else{
										echo "	<script>
													swal({
													  type: 'error',
													  title: 'Oops...',
													  text: 'No se pudo actualizar el usuario',
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

	//Crea un select para elegir el depto en el formulario de crear usuario
	public function crearSelectDeptosController(){
		$respuesta = UsuariosModel::crearSelectDeptosModel("departamentos");
		//echo "<pre>",print_r($respuesta),"</pre>";
		foreach ($respuesta as $key => $value) {
			echo '<option value="'.$value['id'].'">'.$value['nombres'].'</option>';
		}
	}



}