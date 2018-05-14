<?php
class DepartamentosModel{
	//crear departamento
	public function crearDepartamentoModel($dato,$tabla){
		$sql = "INSERT INTO $tabla (nombre) VALUES (:nombreDepto)";
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
}