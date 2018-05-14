<?php
class DepartamentosController{
	//crear departamento
	public function crearDepartamentoController(){
		if (isset($_POST['nombreDepartamentoCrearDepto'])) {
			if (!empty($_POST['nombreDepartamentoCrearDepto'])) {
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
						<td>'.$value["nombre"].'</td>
						<td>
							<a href="index.php?action=editarDepartamento&id='.$value['id'].'" class="btn btn-primary">Editar
							</a>
						</td>
						<td>
							<button href="'.$value['id'].'" id="'.$value['id'].'" id="eliminar'.$value['id'].'" class="btn btn-danger">Eliminar
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
			                      <label class="col-sm-3 control-label" for="nombreDepartamentoCrearDepto">Departamento:</label>
			                      <div class="col-sm-6">
			                        <input type="text" class="form-control" id="nombreDepartamentoCrearDepto" name="nombreDepartamentoCrearDepto" autofocus value="'.$respuesta['nombre'].'">
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
}