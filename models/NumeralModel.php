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

	//validar con ajax que no exista el numeral a crear
	public function validarCrearNumeralAjaxModel($dato,$tabla){
		$sql = "SELECT COUNT(*) AS cuentaNumeral FROM $tabla WHERE descripcion=:descripcion";
		$stmt=Conexion::conectar()->prepare($sql);
		$stmt->bindParam(':descripcion',$dato,PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	//ELIMINAR NUMERAL
	public function eliminarNumeralModel($dato,$tabla){
		$sql = "DELETE FROM $tabla WHERE id =:id";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(':id',$dato,PDO::PARAM_INT);
		if ($stmt->execute()) {
			return 'success';
		}else{
			return 'false';
		}
	}

	//AGREGAR REGLA AL NUMERAL Y ACTUALIZAR STATUS
	public function agregarReglaNumeralModel($datos,$tabla){
		$sql = "UPDATE $tabla SET status=1 , aviso=:aviso WHERE id=:id";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(':id',$datos['id'],PDO::PARAM_INT);
		$stmt->bindParam(':aviso',$datos['aviso'],PDO::PARAM_STR);
		if ($stmt->execute()) {
			return 'success';
		}else{
			return 'error';
		}
	}

	//ELIMINAR (ACTUALIZAR STATUS A 0 Y ACTUALIZAR AVISO A ESPACIO VACIO).
	public function eliminarAvisoNumeralModel($dato,$tabla){
		$sql = "UPDATE $tabla SET status = 0, aviso ='' WHERE id=:id";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(':id',$dato,PDO::PARAM_INT);
		if ($stmt->execute()) {
			return 'success';
		}else{
			return 'error';
		}
	}

	//VALIDAR NUMERAL CON AJAX PARA NO REPETIR NUMERAL
	public function validarEditarNumeralAjaxController($dato,$tabla){
		$sql = "SELECT descripcion FROM $tabla WHERE id=:id";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(':id',$dato,PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	//VALIDAR NUMERAL CON AJAX PARA NO REPETIR NUMERAL EVALUANDO LA DESCRIPCION
	public function validarEditarDescripcionNumeralAjaxModel($dato,$tabla){
		$sql = "SELECT COUNT(descripcion) AS cuentaDos FROM $tabla WHERE descripcion = :dato";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(':dato',$dato,PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
}