<?php
require_once "Conexion.php";
class DepartamentosModel extends Conexion{
	//crear departamento
	public function crearDepartamentoModel($dato,$tabla){
		$sql = "INSERT INTO $tabla (nombres) VALUES (:nombreDepto)";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(':nombreDepto',$dato,PDO::PARAM_STR);
		if ($stmt->execute()) {
			return 'success';
		}else{
			return 'error';
		}
	}
	public function listarDepartamentosModel($tabla){
		$sql = "SELECT * FROM $tabla";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	//editar departamento
	public function crearEditarDepartamentoFormModel($dato,$tabla){
		$sql = "SELECT * FROM $tabla WHERE id=:id";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(':id',$dato,PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	//actualizar departamento
	public function actualizarDepartamentoModel($datos,$tabla){
		$sql = "UPDATE $tabla SET nombres=:nombreDepto WHERE id=:id";
		$stmt=Conexion::conectar()->prepare($sql);
		$stmt->bindParam(':id',$datos['id'],PDO::PARAM_INT);
		$stmt->bindParam(':nombreDepto',$datos['nombreDepto'],PDO::PARAM_STR);
		if ($stmt->execute()) {
			return 'success';
		}else{
			return 'error';
		}
	}

	//verificar que no exista un depto con el mismo nombre
	public function validarDepartamentoAjaxModel($dato,$tabla){
		$sql = "SELECT COUNT(*) AS existencia FROM $tabla WHERE nombres = :nombreDepto ";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(':nombreDepto',$dato,PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	//eliminar departamento
	public function eliminarDepartamentoModel($dato,$tabla){
		$sql = "DELETE FROM $tabla WHERE id=:id";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(':id',$dato,PDO::PARAM_INT);
		if ($stmt->execute()) {
			return 'success';
		}else{
			return 'error';
		}
	}



}