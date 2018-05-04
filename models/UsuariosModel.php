<?php
require_once "Conexion.php";
class UsuariosModel extends Conexion{
	//INSERTAR USUARIO EN LA BASE DE DATOS
	public function CrearUsuarioModel($datos,$tabla){
		$sql = "INSERT INTO $tabla (nombres, apellidos, usuario, password, email, foto, rol, pregunta_seguridad, respuesta_seguridad) VALUES (:nombres, :apellidos, :usuario, :password, :email, :foto, :rol, :pregunta_seguridad, :respuesta_seguridad)";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(':nombres',$datos['nombres'],PDO::PARAM_STR);
		$stmt->bindParam(':apellidos',$datos['apellidos'],PDO::PARAM_STR);
		$stmt->bindParam(':usuario',$datos['usuario'],PDO::PARAM_STR);
		$stmt->bindParam(':password',$datos['password'],PDO::PARAM_STR);
		$stmt->bindParam(':email',$datos['email'],PDO::PARAM_STR);
		$stmt->bindParam(':foto',$datos['urlFoto'],PDO::PARAM_STR);
		$stmt->bindParam(':rol',$datos['rol'],PDO::PARAM_STR);
		$stmt->bindParam(':pregunta_seguridad',$datos['preguntaSeguridad'],PDO::PARAM_STR);
		$stmt->bindParam(':respuesta_seguridad',$datos['respuestaSeguridad'],PDO::PARAM_STR);
		if ($stmt->execute()) {
			return 'success';
		}else{
			return 'error';
		}
	}
}