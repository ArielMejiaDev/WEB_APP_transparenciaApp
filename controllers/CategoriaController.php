<?php
class CategoriaController{
	//CREAR CATEGORIA
	public function crearCategoriaController(){
		$expRegNombres = '/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/';
		$expRegNum = '/^[0-9]*$/';
		if (isset($_POST['descripcionCrearCategoria']) && isset($_POST['idNumeralCrearCategoria'])) {
			if (!empty($_POST['descripcionCrearCategoria']) && !empty($_POST['idNumeralCrearCategoria'])) {
				if (preg_match($expRegNombres, $_POST['descripcionCrearCategoria']) || preg_match($expRegNum, $_POST['idNumeralCrearCategoria'])) {
					$datos = array('idNumeral'=>$_POST['idNumeralCrearCategoria'],'descripcion'=>$_POST['descripcionCrearCategoria']);
					echo '<pre>',print_r($datos),'</pre>';
					$respuesta = CategoriaModel::crearCategoriaModel($datos,"categorias");
					if ($respuesta=='success') {
						header('Location:notCrearCategoriaOk');
					}else{
						var_dump($respuesta);
					}
				}//no acepta expresiones regulares
			}//que no vaya vacio
		}
	}

	//CARGAR OPTIONS PARA EL SELECT DE NUMERALES
	public function cargarSelectNumeralesController(){
		$respuesta = CategoriaModel::cargarSelectNumeralesModel("Numerales");
		//var_dump($respuesta);
		foreach ($respuesta as $key => $value) {
			echo '<option value="'.$value['id'].'">'.utf8_encode($value['descripcion']).'</option>';
		}
	}

	//LISTAR CATEGORIAS
	public function listarCategoriasController(){
		$respuesta = CategoriaModel::listarCategoriaModel('categorias','numerales');
		//var_dump($respuesta);
		foreach ($respuesta as $key => $value) {
			echo   '<tr class="odd gradeX">
						<td>'.utf8_encode($value["descripcionNumeral"]).'</td>
						<td>'.utf8_encode($value["descripcion"]).'</td>
						<td>
							<a href="index.php?action=agregarReglaCategoria&id='.$value['id'].'" class="btn btn-color btn-twitter">Agregar/Editar Regla
							</a>
						</td>
						<td>
							<button href="'.$value['id'].'" aviso="El aviso" categoria="'.utf8_encode($value['descripcion']).'" id="eliminarRegla'.$value['id'].'" class="btn btn-danger">Eliminar Regla
							</button>
						</td>
						<td>
							<a href="index.php?action=editarCategoria&id='.$value['id'].'" class="btn btn-primary">Editar
							</a>
						</td>
						<td>
							<button href="'.$value['id'].'" categoria="'.utf8_encode($value['descripcion']).'" id="eliminar'.$value['id'].'" class="btn btn-danger">Eliminar
							</button>
						</td>
					</tr>';
		}
	}

	//ELIMINAR CONTROLLER
	public function eliminarCategoriaController(){
		if (isset($_GET['eliminar'])) {
			if (!empty($_GET['eliminar'])) {
				$dato = $_GET['eliminar'];
				$respuesta = CategoriaModel::eliminarCategoriaModel($dato,"categorias");
				if ($respuesta=='success') {
					header('Location:notEliminarCategoriaOk');
				}
			}
		}
	}

	//CREAR FORMULARIO PARA EDITAR CATEGORIA
	public function crearEditarCategoriaFormController(){
		$expRegNum = '/^[0-9]*$/';
		if (isset($_GET['id'])) {
			if (!empty($_GET['id'])) {
				if (preg_match($expRegNum, $_GET['id'])) {
					$dato = $_GET['id'];
					$respuesta = CategoriaModel::crearEditarCategoriaFormModel($dato,"categorias","numerales");
					//var_dump($respuesta);
					echo '<form style="border-radius: 0px;" class="form-horizontal group-border-dashed" onsubmit="return validarEditarNumeral()" method="post">
										<div class="form-group">
					                      <label class="col-sm-3 control-label" for="descripcionCrearCategoria">Numeral</label>
					                      <div class="col-sm-6">
					                        <select name="idNumeralEditarCategoria" id="idNumeralEditarCategoria" class="form-control">
					                        	<option value="'.$respuesta['numeralesId'].'">'.utf8_encode($respuesta['numeralesDescripcion']).'</option>
					                        </select>
					                        <p id="avisoDescripcionCrearCategoria" class="text-danger text-muted" style="display: none"></p>
					                      </div>
					                    </div>
					                    <div class="form-group">
					                    	<input type="hidden" class="form-control" id="idEditarCategoria" name="idEditarCategoria" value="'.$respuesta['id'].'">
					                      <label class="col-sm-3 control-label" for="descripcionEditarCategoria">Numeral:</label>
					                      <div class="col-sm-6">
					                        <input type="text" class="form-control" id="descripcionEditarCategoria" name="descripcionEditarCategoria" value="'.utf8_encode($respuesta['descripcion']).'">
					                        <p id="avisoDescripcionEditarCategoria" class="text-danger text-muted" style="display: none"></p>
					                      </div>
					                    </div>
					                    <div class="form-group">
					                    	<div class="col-sm-6 col-md-offset-3">
					                    		<button type="submit" class="btn btn-info"><i class="icon mdi mdi-edit"></i> Editar Categoria</button>
					                    	</div>
					                    </div>
				                  	</form>';
				}
			}
		}
	}

	//CARGAR NUMERALES PARA FORMULARIO DE EDITAR CATEGORIA
	public function cargarOptionsNumeralesAjaxController($tabla){
		$respuesta = CategoriaModel::cargarOptionsNumeralesAjaxModel($tabla);
		//var_dump($respuesta);
		foreach ($respuesta as $key => $value) {
			echo '<option value="'.$value['id'].'">'.utf8_encode($value['descripcion']).'</option>';
		}
	}

	//ACTUALIZAR CATEGORIA
	public function actualizarCategoriaController(){
		$expRegNombres = '/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/';
		$expRegNum = '/^[0-9]*$/';
		if (isset($_POST['idNumeralEditarCategoria']) && isset($_POST['idEditarCategoria']) && isset($_POST['descripcionEditarCategoria']) ) {
			if (!empty($_POST['idNumeralEditarCategoria']) && !empty($_POST['idEditarCategoria']) && !empty($_POST['descripcionEditarCategoria']) ) {
				if (preg_match($expRegNum, $_POST['idNumeralEditarCategoria']) || preg_match($expRegNum, $_POST['idEditarCategoria']) || preg_match($expRegNombres, $_POST['descripcionEditarCategoria'])) {
					$datos = array('idNumeral'=>$_POST['idNumeralEditarCategoria'],'idCategoria'=>$_POST['idEditarCategoria'],'descripcionCategoria'=>$_POST['descripcionEditarCategoria']);
					//var_dump($datos);
					$respuesta = CategoriaModel::actualizarCategoriaModel($datos,'categorias');
					if ($respuesta=='success') {
						header('Location:notActualizarCategoriaOk');
					}
				}
			}
		}
	}

	//AGREGAR AVISO A UNA CATEGORIA
	public function agregarReglaCategoriaController(){
		$expRegNombres = '/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/';
		$expRegNum = '/^[0-9]*$/';
		if (isset($_POST['idAgregarReglaCategoria']) && isset($_POST['avisoAgregarReglaCategoria']) ) {
			if (!empty($_POST['idAgregarReglaCategoria']) && !empty($_POST['avisoAgregarReglaCategoria']) ) {
				if (preg_match($expRegNum, $_POST['idAgregarReglaCategoria']) || preg_match($expRegNombres,$_POST['avisoAgregarReglaCategoria'])) {
					$datos = array('idCategoria'=>$_POST['idAgregarReglaCategoria'],'avisoCategoria'=>$_POST['avisoAgregarReglaCategoria']);
					//echo '<pre>',print_r($datos),'</pre>';
					$respuesta = CategoriaModel::agregarReglaCategoriaModel($datos,'categorias');
					if ($respuesta=='success') {
						header('Location:notCrearAvisoCategoriaOk');
					}
				}
			}
		}
	}

	//ELIMINAR AVISO (ACTUALIZAR STATUS A 0 Y ACTUALIZAR AVISO A BORRADO)
	public function eliminarAvisoCategoriaController(){
		$expRegNum = '/^[0-9]*$/';
		if (isset($_GET['eliminarAviso'])) {
			if (!empty($_GET['eliminarAviso'])) {
				if (preg_match($expRegNum, $_GET['eliminarAviso'])) {
					$dato = $_GET['eliminarAviso'];
					$respuesta = CategoriaModel::eliminarAvisoCategoriaModel($dato,'categorias');
					if ($respuesta=='success') {
						header('Location:notEliminarAvisoCategoriaOk');
					}
				}
			}
		}
	}
}