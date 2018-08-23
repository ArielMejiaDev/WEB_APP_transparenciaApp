<?php
class UsuariosController{
	// INSERTARA UN USUARIO EN LA BASE DE DATOS
	public function CrearUsuarioController()
	{
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
					$expRegNombres = '/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/';
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
											$_POST['urlFotoCrearUsuario'] = "views/images/user.png";
										}

										if (empty($_POST['rolCrearUsuario'])) {
											$_POST['rolCrearUsuario'] = "redactor";
										}

										$datos = array(
										"nombres"=>utf8_decode($_POST['nombresCrearUsuario']),
										"apellidos"=>utf8_decode($_POST['apellidosCrearUsuario']),
										"usuario"=>$_POST['usuarioCrearUsuario'],
										"password"=>password_hash($_POST['passwordCrearUsuario'],PASSWORD_DEFAULT),
										"confirmacionPassword"=>$_POST['repPasswordCrearUsuario'],
										"email"=>$_POST['emailCrearUsuario'],
										"departamento"=>$_POST['deptoCrearUsuario'],
										"urlFoto"=>$_POST['urlFotoCrearUsuario'],
										"rol"=>$_POST['rolCrearUsuario'],
										"preguntaSecreta"=>utf8_decode($_POST['preguntaSeguridadCrearUsuario']),
										"respuestaSecreta"=>utf8_decode($_POST['respuestaSeguridadCrearUsuario']));
										echo "<pre>",print_r($datos),"</pre>";
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
			$rol = ($value["rol"]=='jefeRedaccion') ? "Jefe de Redacción" : $value["rol"];
			echo   '<tr class="odd gradeX">
						<td>'.$value["usuario"].'</td>
						<td>'.$rol.'</td>
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

	public function crearFormEditarUsuarioController()
	{
		if (isset($_GET['id'])) {
				$dato = $_GET['id']; 
				$respuesta = UsuariosModel::crearFormEditarUsuarioModel($dato,"usuarios","departamentos");			

				//echo '<pre>',print_r($respuesta),'</pre>';
				echo '	<form style="border-radius: 0px;" class="form-horizontal group-border-dashed" onsubmit="return validarEditarUsuario()" method="post">
							<input type="hidden" id="valorRol" value="'.utf8_encode($respuesta['rol']).'" name="valorRol">
							<input type="hidden" id="idEditarUsuario" value="'.utf8_encode($respuesta['id']).'" name="idEditarUsuario">
	                        <div class="form-group">
	                          <label class="col-sm-3 control-label" for="nombresEditarUsuario">Nombres</label>
	                          <div class="col-sm-6">
	                            <input type="text" class="form-control" id="nombresEditarUsuario" name="nombresEditarUsuario" autofocus value="'.utf8_encode($respuesta['usuariosNombres']).'">
	                            <p id="avisoNombresEditarUsuario" class="text-danger text-muted" style="display: none"></p>
	                          </div>
	                          <label id="avisoNombresCrearUsuario" class="text-muted text-danger"></label>
	                        </div>
	                        <div class="form-group">
	                          <label class="col-sm-3 control-label" for="apellidosEditarUsuario">Apellidos</label>
	                          <div class="col-sm-6">
	                            <input type="text" class="form-control" id="apellidosEditarUsuario" name="apellidosEditarUsuario" value="'.utf8_encode($respuesta['apellidos']).'">
	                            <p id="avisoApellidosEditarUsuario" class="text-danger text-muted" style="display: none"></p>
	                          </div>
	                        </div>
	                        <div class="form-group">
	                          <label class="col-sm-3 control-label" for="usuarioEditarUsuario">Usuario</label>
	                          <div class="col-sm-6">
	                            <input type="text" class="form-control" id="usuarioEditarUsuario" name="usuarioEditarUsuario" value="'.utf8_encode($respuesta['usuario']).'" >
	                            <p id="avisoUsuarioEditarUsuario" class="text-danger text-muted" style="display: none"></p>
	                          </div>
	                        </div>
	                        <div class="form-group">
	                          <label class="col-sm-3 control-label" for="passwordEditarUsuario">Password</label>
	                          <div class="col-sm-6">
	                            <input type="password" class="form-control" id="passwordEditarUsuario" name="passwordEditarUsuario" placeholder="Aquí puede cambiar su contraseña" value="'.utf8_encode($respuesta['password']).'">
	                            <p id="avisoPasswordEditarUsuario" class="text-danger text-muted" style="display: none"></p>
	                          </div>
	                        </div>
	                        <div class="form-group">
	                          <label class="col-sm-3 control-label" for="repPasswordEditarUsuario">Repita password</label>
	                          <div class="col-sm-6">
	                            <input type="password" class="form-control" id="repPasswordEditarUsuario" name="repPasswordEditarUsuario" placeholder="Aquí debe confirmar su contraseña">
	                            <p id="avisoRepPasswordEditarUsuario" class="text-danger text-muted" style="display: none"></p>
	                          </div>
	                        </div>
	                        <div class="form-group">
	                          <label class="col-sm-3 control-label" for="emailEditarUsuario">Email</label>
	                          <div class="col-sm-6">
	                            <input type="email" class="form-control" id="emailEditarUsuario" name="emailEditarUsuario" value="'.utf8_encode($respuesta['email']).'">
	                            <p id="avisoEmailEditarUsuario" class="text-danger text-muted" style="display: none"></p>
	                          </div>
	                        </div>
	                        <div class="form-group">
							  <label class="col-sm-3 control-label" for="deptoEditarUsuario">Departamento:</label>
							  <div class="col-sm-6">
							    <select class="form-control" id="deptoEditarUsuario" name="deptoEditarUsuario">
							      <option value="'.$respuesta['id_departamento'].'">'.$respuesta['nombres'].'</option>
							    </select>
							    <p id="avisoDeptoEditarUsuario" class="text-danger text-muted" style="display: none"></p>
							  </div>
							</div>
	                        <div class="form-group">
	                          <label class="col-sm-3 control-label" for="urlFotoEditarUsuario">Url Foto</label>
	                          <div class="col-sm-6">
	                            <input type="text" class="form-control" id="urlFotoEditarUsuario" name="urlFotoEditarUsuario" value="'.$respuesta['foto'].'">
	                            <p id="avisoUrlFotoEditarUsuario" class="text-danger text-muted" style="display: none"></p>
	                          </div>
	                        </div>
	                        <div class="form-group">
	                          <label class="col-sm-3 control-label">Rol</label>
	                          <div class="col-sm-6">
								<label class="radio-inline">
									<input type="radio" class="radioButton" id="redactor" name="rolEditarUsuario" value="redactor">Redactor
								</label>
								<label class="radio-inline">
									<input type="radio" class="radioButton" id="jefeRedaccion" name="rolEditarUsuario" value="jefeRedaccion">Jefe de Redacción
								</label>
								<label class="radio-inline">
									<input type="radio" class="radioButton" id="editor" name="rolEditarUsuario" value="editor">Editor
								</label>
								<label class="radio-inline">
									<input type="radio" class="radioButton" id="admin" name="rolEditarUsuario" value="admin">Admin
								</label>
	                          </div>
	                          <p id="avisoRolEditarUsuario" class="text-danger text-muted" style="display: none"></p>
	                        </div>
	                        <div class="form-group">
	                          <label class="col-sm-3 control-label" for="preguntaSeguridadEditarUsuario">Escribe tu pregunta de seguridad</label>
	                          <div class="col-sm-6">
	                            <div class="input-group xs-mb-15"><span class="input-group-addon">¿</span>
	                              <input type="text" class="form-control" id="preguntaSeguridadEditarUsuario" name="preguntaSeguridadEditarUsuario" value="'.utf8_encode($respuesta['pregunta_seguridad']).'"><span class="input-group-addon">?</span>
	                            </div>
	                          </div>
	                        </div>
	                        <div class="form-group" style="display: none" id="contenedorAvisoPreguntaSeguridadEditarUsuario">
	                          <div class="col-sm-6 col-sm-offset-3">
	                            <p id="avisoPreguntaSeguridadEditarUsuario" class="text-danger text-muted" style="display: none"></p>
	                          </div>
	                        </div>
	                        <div class="form-group">
	                          <label class="col-sm-3 control-label" for="respuestaSeguridadEditarUsuario">Escribe tu respuesta de seguridad</label>
	                          <div class="col-sm-6">
	                            <input type="text" class="form-control" id="respuestaSeguridadEditarUsuario" name="respuestaSeguridadEditarUsuario" value="'.utf8_encode($respuesta['respuesta_seguridad']).'">
	                            <p id="avisoRespuestaSeguridadEditarUsuario" class="text-danger text-muted" style="display: none"></p>
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

	public function actualizarUsuarioController()
	{
		if (isset($_POST['nombresEditarUsuario'])) {
			//empezamos a validar
			//que no vayan vacios y que no sean expresiones regulares
			if (isset(
				$_POST['idEditarUsuario']) ||
				isset($_POST['nombresEditarUsuario']) || 
				isset($_POST['apellidosEditarUsuario']) || 
				isset($_POST['usuarioEditarUsuario']) || 
				isset($_POST['passwordEditarUsuario']) || 
				isset($_POST['repPasswordEditarUsuario']) || 
				isset($_POST['emailEditarUsuario']) || 
				isset($_POST['urlFotoEditarUsuario']) || 
				isset($_POST['roEditarrUsuario']) || 
				isset($_POST['preguntaSeguridadEditarUsuario']) || 
				isset($_POST['respuestaSeguridadEditarUsuario'])) {
				


				if (
				!empty($_POST['idEditarUsuario']) ||
				!empty($_POST['nombresEditarUsuario']) || 
				!empty($_POST['apellidosEditarUsuario']) || 
				!empty($_POST['usuarioEditarUsuario']) || 
				!empty($_POST['passwordEditarUsuario']) || 
				!empty($_POST['repPasswordEditarUsuario']) || 
				!empty($_POST['emailEditarUsuario']) || 
				!empty($_POST['rolEditarUsuario']) || 
				!empty($_POST['preguntaSeguridadEditarUsuario']) || 
				!empty($_POST['respuestaSeguridadEditarUsuario'])) {

					//validar que no se reciban expresiones regulares

					// $expRegNombres = '/^(?![ .]+$)[a-zA-Z .]*$/';
					$expRegNombres = '/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/';
					$expRegCamposTexto = '/^[a-zA-Z0-9]*$/';
					// $expRegCamposTexto = '/^[a-zA-Z0-9]*$/';
					$expRegPassword = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).*$/';
					$expRegEmail = '/^\w+([\.\+\-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/';
					$expRegUrl = '/([a-zA-Z]:(\\w+)*\\[a-zA-Z0_9]+)?.png|jpg/';
					// $expRegUrl = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';

					if (preg_match($expRegCamposTexto, $_POST['idEditarUsuario'])
					&&	preg_match($expRegNombres, $_POST['nombresEditarUsuario'])
					&&	preg_match($expRegNombres, $_POST['apellidosEditarUsuario'])  
					&&	preg_match($expRegCamposTexto, $_POST['usuarioEditarUsuario']) 
					&&	preg_match($expRegUrl, $_POST['urlFotoEditarUsuario']) 
					&&	preg_match($expRegCamposTexto, $_POST['rolEditarUsuario']) 
					&&	preg_match($expRegNombres, $_POST['preguntaSeguridadEditarUsuario']) 
					&&	preg_match($expRegNombres, $_POST['respuestaSeguridadEditarUsuario'])) {
						//que cumplan con los requerimientos de las contraseñas y que sean iguales
						
						if (preg_match($expRegPassword, $_POST['passwordEditarUsuario']) 
						&& 	preg_match($expRegPassword, $_POST['repPasswordEditarUsuario']) ) {

							if ($_POST['passwordEditarUsuario']==$_POST['repPasswordEditarUsuario']) {
								
								if (preg_match($expRegEmail, $_POST['emailEditarUsuario'])) {

									if (empty($_POST['urlFotoEditarUsuario'])) {
										$_POST['urlFotoEditarUsuario'] = "views/images/user.png";
									}

									if (empty($_POST['rolEditarUsuario'])) {
										$_POST['rolEditarUsuario'] = "usuario";
									}

									$datos = array(
									"id"=>$_POST['idEditarUsuario'],
									"nombres"=>utf8_decode($_POST['nombresEditarUsuario']),
									"apellidos"=>utf8_decode($_POST['apellidosEditarUsuario']),
									"usuario"=>$_POST['usuarioEditarUsuario'],
									"password"=>$_POST['passwordEditarUsuario'],
									"confirmacionPassword"=>$_POST['repPasswordEditarUsuario'],
									"email"=>$_POST['emailEditarUsuario'],
									"urlFoto"=>$_POST['urlFotoEditarUsuario'],
									"rol"=>$_POST['rolEditarUsuario'],
									"preguntaSecreta"=>utf8_decode($_POST['preguntaSeguridadEditarUsuario']),
									"respuestaSecreta"=>utf8_decode($_POST['respuestaSeguridadEditarUsuario']));
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

	//VALIDAR QUE EL USUARIO DEL ID ENVIADO SEA IGUAL NO SEA IGUAL AL CAMPO USUARIO
	public function validarIdEditarUsuarioAjaxController($dato){
		$respuesta = UsuariosModel::validarIdEditarUsuarioAjaxModel($dato,'usuarios');
		$usuario = $respuesta['usuario'];
		echo $usuario;
	}
	//VALIDAR QUE EL USUARIO QUE NO PUEDE SER IGUAL AL QUE CORRESPONDE AL ID ENVIADO NO ESTE YA EN LA BD
	public function validarUsuarioEditarUsuarioAjaxController($dato){
		$respuesta = UsuariosModel::validarUsuarioEditarUsuarioAjaxModel(utf8_decode($dato),'usuarios');
		$existencia = (int)$respuesta['cuenta'];
		if ($existencia>0) {
			echo 'existe';
		}
	}

	//VALIDAR ID PARA MAIL CON AJAX
	public function validarIdMailEditarUsuarioAjaxController($dato){
		$respuesta = UsuariosModel::validarIdMailEditarUsuarioAjaxModel($dato,'usuarios');
		$email = $respuesta['email'];
		echo $email;
	}

	//VALIDAR QUE NO ESTE YA EL MAIL EN LA BD
	public function validarEmailEditarUsuarioAjaxController($dato){
		$respuesta = UsuariosModel::validarEmailEditarUsuarioAjaxModel($dato,'usuarios');
		$cuenta = (int)$respuesta['cuenta'];
		if ($cuenta>0) {
			echo 'existe';
		}
	}
}