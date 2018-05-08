<?php
require_once "Conexion.php";
class UsuariosModel extends Conexion{
	//INSERTAR USUARIO EN LA BASE DE DATOS
	public function CrearUsuarioModel($datos,$tabla){
		$sql = "INSERT INTO $tabla (nombres, apellidos, usuario, password, email, foto, rol,pregunta_seguridad, respuesta_seguridad) VALUES (:nombres, :apellidos, :usuario, :password, :email, :foto, :rol, :pregunta_seguridad, :respuesta_seguridad)";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(':nombres',$datos['nombres'],PDO::PARAM_STR);
		$stmt->bindParam(':apellidos',$datos['apellidos'],PDO::PARAM_STR);
		$stmt->bindParam(':usuario',$datos['usuario'],PDO::PARAM_STR);
		$stmt->bindParam(':password',$datos['password'],PDO::PARAM_STR);
		$stmt->bindParam(':email',$datos['email'],PDO::PARAM_STR);
		$stmt->bindParam(':foto',$datos['urlFoto'],PDO::PARAM_STR);
		$stmt->bindParam(':rol',$datos['rol'],PDO::PARAM_STR);
		$stmt->bindParam(':pregunta_seguridad',$datos['preguntaSecreta'],PDO::PARAM_STR);
		$stmt->bindParam(':respuesta_seguridad',$datos['respuestaSecreta'],PDO::PARAM_STR);
		if ($stmt->execute()) {
			return 'success';
		}else{
			return 'error';
		}
	}

	public function validarUsuarioAjaxModel($datos,$tabla){
		$sql = "SELECT COUNT(*) AS existencia FROM $tabla WHERE usuario = :usuario ";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(':usuario',$_POST['usuario'],PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function validarEmailAjaxModel($datos,$tabla){
		$sql = "SELECT COUNT(*) AS existencia FROM $tabla WHERE email=:email";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(':email',$_POST['email'],PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
}