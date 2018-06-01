<?php
require_once 'Conexion.php';
class CategoriaModel extends Conexion{
	//metodo para crear numeral
	public function crearCategoriaModel($datos,$tabla){
		$sql = "INSERT INTO $tabla (id_numeral, descripcion) VALUES (:id_numeral, :descripcion)";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(':id_numeral',$datos['idNumeral'],PDO::PARAM_STR);
		$stmt->bindParam(':descripcion',$datos['descripcion'],PDO::PARAM_STR);
		if ($stmt->execute()) {
			return 'success';
		}else{
			return 'error';
		}
	}

	//cargar un select para el formulario de crear categoria
	public function cargarSelectNumeralesModel($tabla){
		$sql = "SELECT * FROM $tabla";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	//LISTAR CATEGORIAS 
	public function listarCategoriaModel($tabla1,$tabla2){
		$sql = "SELECT $tabla2.descripcion AS descripcionNumeral, $tabla1.id, $tabla1.id_numeral, $tabla1.descripcion, $tabla1.status, $tabla1.aviso FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.id_numeral=$tabla2.id";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	//ELIMINAR CATEGORIA
	public function eliminarCategoriaModel($dato,$tabla){
		$sql = "DELETE FROM $tabla WHERE id =:id";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(':id',$dato,PDO::PARAM_INT);
		if ($stmt->execute()) {
			return 'success';
		}else{
			return 'false';
		}
	}

	//EDITAR CATEGORIA
	public function crearEditarCategoriaFormModel($dato,$tabla1,$tabla2){
		$sql = "SELECT $tabla1.id, $tabla1.id_numeral, $tabla1.descripcion, $tabla2.id AS numeralesId, $tabla2.descripcion AS numeralesDescripcion FROM $tabla1 INNER JOIN $tabla2 ON categorias.id_numeral=numerales.id WHERE categorias.id=:id";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(':id',$dato,PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	//CARGAR OPTIONS PARA EDITAR CATEGORIA
	public function cargarOptionsNumeralesAjaxModel($tabla){
		$sql = "SELECT * FROM $tabla";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	//ACTUALIZAR CATEGORIA
	public function actualizarCategoriaModel($datos,$tabla){
		$sql = "UPDATE $tabla SET id_numeral=:idNumeral,descripcion=:descripcionCategoria WHERE id=:idCategoria";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(':idNumeral',$datos['idNumeral'],PDO::PARAM_INT);
		$stmt->bindParam(':descripcionCategoria',$datos['descripcionCategoria'],PDO::PARAM_STR);
		$stmt->bindParam(':idCategoria',$datos['idCategoria'],PDO::PARAM_STR);		
		if ($stmt->execute()) {
			return 'success';
		}else{
			return 'error';
		}
	}
}