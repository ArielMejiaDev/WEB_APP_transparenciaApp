<?php
class DepartamentosController{
	//crear departamento
	public function crearDepartamentoController(){
		$expRegNombres = '/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/';

		if (isset($_POST['nombreDepartamentoCrearDepto'])) {
			if (!empty($_POST['nombreDepartamentoCrearDepto'])) {
				if (preg_match($expRegNombres, $_POST['nombreDepartamentoCrearDepto'])) {
					$dato = $_POST['nombreDepartamentoCrearDepto'];
					$respuesta = DepartamentosModel::crearDepartamentoModel($dato,"departamentos");
					if ($respuesta=='success') {
						header('Location:notCrearDeptoOk');
					}else{
						echo "	<script>
								swal({
								  type: 'error',
								  title: 'Alerta...',
								  text: 'Érror no se pudo crear el departamento',
								})
							</script>";
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
							  text: 'No se puede crear ningun departamento vacio',
							})
						</script>";
			}
		}
	}

	//listar departamentos
	public function listarDepartamentosController(){
		$respuesta = DepartamentosModel::listarDepartamentosModel("departamentos");
		foreach ($respuesta as $key => $value) {
			echo   '<tr class="odd gradeX">
						<td>'.$value["nombres"].'</td>
						<td>
							<a href="index.php?action=editarDepartamento&id='.$value['id'].'" class="btn btn-primary">Editar
							</a>
						</td>
						<td>
							<button href="'.$value['id'].'" depto="'.$value['nombres'].'" id="eliminar'.$value['id'].'" class="btn btn-danger">Eliminar
							</button>
						</td>
					</tr>';
		}
	}

	//editar departamento
	public function crearEditarDepartamentoFormController(){
		if (isset($_GET['id'])) {
			$dato = $_GET['id'];
			$respuesta = DepartamentosModel::crearEditarDepartamentoFormModel($dato,"departamentos");
			echo '<form style="border-radius: 0px;" class="form-horizontal group-border-dashed" onsubmit="return validarDepartamentoForm()" method="post">
			                    <div class="form-group">
			                    	<input type="hidden" class="form-control" id="idDepartamentoCrearDepto" name="idDepartamentoCrearDepto" value="'.$respuesta['id'].'">
			                      <label class="col-sm-3 control-label" for="nombreDepartamentoCrearDepto">Departamento:</label>
			                      <div class="col-sm-6">
			                        <input type="text" class="form-control" id="nombreDepartamentoCrearDepto" name="nombreDepartamentoCrearDepto" value="'.$respuesta['nombres'].'">
			                        <p id="avisoNombreDepartamentoCrearDepto" class="text-danger text-muted" style="display: none"></p>
			                      </div>
			                    </div>
			                    <div class="form-group">
			                    	<div class="col-sm-6 col-md-offset-3">
			                    		<button type="submit" class="btn btn-info"><i class="icon mdi mdi-edit"></i> Editar Departamento</button>
			                    	</div>
			                    </div>
		                  	</form>';
		}
	}

	//actualizar departamento
	public function actualizarDepartamentoController(){
		if (isset($_POST['idDepartamentoCrearDepto']) && isset($_POST['nombreDepartamentoCrearDepto']) ) {
			if (!empty($_POST['idDepartamentoCrearDepto']) && !empty($_POST['nombreDepartamentoCrearDepto']) ) {
				$expRegNombres = '/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/';
				if (preg_match($expRegNombres, $_POST['nombreDepartamentoCrearDepto']) && 
					preg_match($expRegNombres, $_POST['idDepartamentoCrearDepto'])) {
					$datos = array('id'=>$_POST['idDepartamentoCrearDepto'],'nombreDepto'=>$_POST['nombreDepartamentoCrearDepto']);
					$respuesta = DepartamentosModel::actualizarDepartamentoModel($datos,'departamentos');
					if ($respuesta=='success') {
						header('Location:notActualizarDeptoOk');
					}
				}else{
					echo "	<script>
							swal({
							  type: 'error',
							  title: 'Oops...',
							  text: 'No esta permitido el uso de caracteres especiales',
							})
						</script>";
				}
			}else{
				echo "	<script>
							swal({
							  type: 'error',
							  title: 'Oops...',
							  text: 'No puede quedar vacio el departamento',
							})
						</script>";
			}
		}
	}

	//verificar que no existan otros deptos con el mismo nombre
	public function validarDepartamentoAjaxController($dato){
		$respuesta = DepartamentosModel::validarDepartamentoAjaxModel($dato,"departamentos");
		$existencia = (int)$respuesta['existencia'];
		if ($existencia>0) {
			return "existe";
		}
	}

	//eliminar departamento *OJO NO SE ELIMINARA UN DEPTO AL QUE YA ESTEN ASIGNADOS USUARIOS*
	public function eliminarDepartamentoController(){
		if (isset($_GET['eliminar'])) {
			$dato = $_GET['eliminar'];
			$respuesta = DepartamentosModel::eliminarDepartamentoModel($dato,"departamentos");
			if ($respuesta == 'success') {
				header('Location:notEliminarDeptoOk');
			}
		}
	}
}