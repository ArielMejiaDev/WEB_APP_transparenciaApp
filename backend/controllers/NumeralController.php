<?php
class NumeralController{
	//metodo para crear numeral
	public function crearNumeralController(){
		$expRegNombres = '/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/';
		if (isset($_POST['descripcionCrearNumeral'])) {
			if (!empty($_POST['descripcionCrearNumeral'])) {
				if (preg_match($expRegNombres, $_POST['descripcionCrearNumeral'])) {
					//var_dump($_POST['descripcionCrearNumeral']);
					$dato = utf8_decode($_POST['descripcionCrearNumeral']);
					$respuesta = NumeralModel::crearNumeralModel($dato,"numerales");
					if ($respuesta=='success') {
						header('Location:notCrearNumeralesOk');
					}
				}else{
					echo "	<script>
							swal({
							  type: 'error',
							  title: 'Alerta...',
							  text: 'No esta permitido el uso de caracteres especiales',
							})
						</script>";
				}
			}else{
				echo "	<script>
							swal({
							  type: 'error',
							  title: 'Alerta...',
							  text: 'El numeral no puede quedar vacio',
							})
						</script>";
			}
		}
	}

	//listar numerales
	public function listarNumeralesController(){
		$respuesta = NumeralModel::listarNumeralesModel("numerales");
		//var_dump($respuesta);
		foreach ($respuesta as $key => $value) {
			echo   '<tr class="odd gradeX">
						<td>'.utf8_encode($value["descripcion"]).'</td>
						<td>
							<a href="index.php?action=agregarReglaNumeral&id='.$value['id'].'" class="btn btn-color btn-twitter">Agregar/Editar Regla
							</a>
						</td>
						<td>
							<button href="'.$value['id'].'" aviso="El aviso" numeral="'.utf8_encode($value['descripcion']).'" id="eliminarRegla'.$value['id'].'" class="btn btn-danger">Eliminar Regla
							</button>
						</td>
						<td>
							<a href="index.php?action=editarNumeral&id='.$value['id'].'" class="btn btn-primary">Editar
							</a>
						</td>
						<td>
							<button href="'.$value['id'].'" numeral="'.utf8_encode($value['descripcion']).'" id="eliminar'.$value['id'].'" class="btn btn-danger">Eliminar
							</button>
						</td>
					</tr>';
		}
	}

	//crear formulario para editar numeral
	public function crearEditarNumeralFormController(){
		if (isset($_GET['id'])) {
			$dato = $_GET['id'];
			$respuesta = NumeralModel::crearEditarNumeralFormModel($dato,"numerales");
			//var_dump($respuesta);
			echo '<form style="border-radius: 0px;" class="form-horizontal group-border-dashed" onsubmit="return validarEditarNumeral()" method="post">
			                    <div class="form-group">
			                    	<input type="hidden" class="form-control" id="idEditarNumeral" name="idEditarNumeral" value="'.$respuesta['id'].'">
			                      <label class="col-sm-3 control-label" for="descripcionEditarNumeral">Numeral:</label>
			                      <div class="col-sm-6">
			                        <input type="text" class="form-control" id="descripcionEditarNumeral" name="descripcionEditarNumeral" value="'.utf8_encode($respuesta['descripcion']).'">
			                        <p id="avisoDescripcionEditarNumeral" class="text-danger text-muted" style="display: none"></p>
			                      </div>
			                    </div>
			                    <div class="form-group">
			                    	<div class="col-sm-6 col-md-offset-3">
			                    		<button type="submit" class="btn btn-info"><i class="icon mdi mdi-edit"></i> Editar Numeral</button>
			                    	</div>
			                    </div>
		                  	</form>';
		}
	}

	//editar numeral
	public function actualizarNumeralController(){
		if (isset($_POST['idEditarNumeral']) && isset($_POST['descripcionEditarNumeral']) ) {
			if (!empty($_POST['idEditarNumeral']) && !empty($_POST['descripcionEditarNumeral'])) {
				$datos = array('id'=>$_POST['idEditarNumeral'],'descripcion'=>utf8_decode($_POST['descripcionEditarNumeral']));
				//echo '<pre>',print_r($datos),'<pre>';
				//var_dump($datos);
				$respuesta = NumeralModel::actualizarNumeralModel($datos,"numerales");
				if ($respuesta == 'success') {
					header('Location:notEditarNumeralOk');
				}
			}
		}
	}

	//validar que no exista el numeral al crearlo con ajax
	public function validarCrearNumeralAjaxController($dato){
		$respuesta = NumeralModel::validarCrearNumeralAjaxModel($dato,"numerales");
		//echo $dato;
		$existencia = (int)$respuesta['cuentaNumeral'];
		if ($existencia>0) {
			return 'Existe';
		}
	}

	//eliminar numeral
	public function eliminarNumeralController(){
		if (isset($_GET['eliminar'])) {
			$dato = $_GET['eliminar'];
			$respuesta = NumeralModel::eliminarNumeralModel($dato,"numerales");
			if ($respuesta=='success') {
				header('Location:notEliminarNumeralOk');
			}
		}
	}

	//actualizar status del numeral e insertar regla
	public function agregarReglaNumeralController(){
		$expRegNombres = '/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/';
		$expRegTexto = '/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9,.!? ]*$/';
		$expRegNum = '/^[0-9]*$/';
		if (isset($_POST['idAgregarReglaNumeral']) && isset($_POST['avisoAgregarReglaNumeral']) ) 
		{
			if (!empty($_POST['idAgregarReglaNumeral']) && !empty($_POST['avisoAgregarReglaNumeral']) ) 
			{
				if (preg_match($expRegTexto, $_POST['avisoAgregarReglaNumeral']) && 
					preg_match($expRegNum, $_POST['idAgregarReglaNumeral']) ) 
				{
					$datos = array(
									'id'=>$_POST['idAgregarReglaNumeral'], 
									'aviso'=>utf8_decode($_POST['avisoAgregarReglaNumeral']), 
									'status'=>1
								);
					//var_dump($datos);
					$respuesta = NumeralModel::agregarReglaNumeralModel($datos,"numerales");
					if ($respuesta=='success') {
						header('Location:notAgregarReglaNumeralOk');
					}
				}else{
					echo "	<script>
								swal({
								  type: 'error',
								  title: 'Oops...',
								  text: 'No es permitido el uso de caracteres especiales',
								})
							</script>";
				}
			}else{
				echo "	<script>
							swal({
							  type: 'error',
							  title: 'Oops...',
							  text: 'No se puede agregar un aviso de numeral vacio',
							})
						</script>";
			}
		}
	}

	//eliminar una regla (ACTUALIZA EL STATUS A 0 Y BORRA LA REGLA)
	public function eliminarAvisoNumeralController(){
		if (isset($_GET['eliminarAviso'])) {
			if (!empty($_GET['eliminarAviso'])) {
				$dato = $_GET['eliminarAviso'];
				echo $dato;
				$respuesta = NumeralModel::eliminarAvisoNumeralModel($dato,"numerales");
				if ($respuesta=='success') {
					header('Location:notEliminarAvisoNumeralOk');
				}
			}
		}
	} 

	//VALIDAR EDITAR NUMERAL PARA QUE NO SE REPITA NUMERAL CON AJAX
	public function validarEditarNumeralAjaxController($dato){
		$respuesta = NumeralModel::validarEditarNumeralAjaxController($dato,"numerales");
		$descripcion = $respuesta['descripcion'];
		echo utf8_encode($descripcion);
	}

	//VALIDAR EDITAR DESCRIPCION DEL NUMERAL PARA NO REPETIR NUMERAL CON AJAX
	public function validarEditarDescripcionNumeralAjaxController($dato){
		$respuesta = NumeralModel::validarEditarDescripcionNumeralAjaxModel(utf8_decode($dato),"numerales");
		//var_dump($dato);
		$cuenta = $respuesta['cuenta'];
		if ($cuenta>0) {
			echo 'existe';
		}else{
			echo 'no existe';
		}
	}
}