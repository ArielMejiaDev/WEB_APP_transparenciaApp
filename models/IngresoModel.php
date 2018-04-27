<?php  
require_once "Conexion.php";
class IngresoModel extends Conexion{
	public function validarIngresoModel($datos){
		$sql = "SELECT * FROM usuarios WHERE usuario = :usuario";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(':usuario',$datos['usuarioIngreso'], PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	public function actualizarIntentosModel($datos){
		$sql = "UPDATE usuarios SET intentos = :intentos WHERE usuario = :usuario";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(':usuario',$datos['usuario'],PDO::PARAM_STR);
		$stmt->bindParam(':intentos',$datos['intentos'],PDO::PARAM_INT);
		$stmt->execute();
	}

	public function comprobarRespuestaSeguraModel($datos){
		$sql = "SELECT * FROM usuarios WHERE usuario = :usuario";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(':usuario',$datos['usuario'], PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);

	}
}
?>