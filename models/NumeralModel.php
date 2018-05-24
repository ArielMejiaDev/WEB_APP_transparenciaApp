<?php
require_once 'Conexion.php';
class NumeralModel extends Conexion{
	//metodo para crear numeral
	public function crearNumeralModel($dato,$tabla){
		$sql = "INSERT INTO $tabla (descripcion) VALUES (:descripcion)";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(':descripcion',$dato,PDO::PARAM_STR);
		if ($stmt->execute()) {
			return 'success';
		}else{
			return 'error';
		}
	}

	//listar numerales
	public function listarNumeralesModel($tabla){
		$sql = "SELECT * FROM $tabla";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	//crear formulario para editar numeral
	public function crearEditarNumeralFormModel($dato,$tabla){
		$sql = "SELECT * FROM  $tabla WHERE id =:id";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(':id',$dato,PDO::PARAM_INT);
		if ($stmt->execute()) {
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}
	}

	//actualizar numeral
	public function actualizarNumeralModel($datos,$tabla){
		$sql = "UPDATE $tabla SET descripcion=:descripcion WHERE id=:id";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(':id',$datos['id'],PDO::PARAM_INT);
		$stmt->bindParam(':descripcion',$datos['descripcion'],PDO::PARAM_STR);
		if ($stmt->execute()) {
			return 'success';
		}else{
			return 'error';
		}
	}
}