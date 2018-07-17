<?php
require_once "Conexion.php";
class DatosUsuarioModel extends Conexion{
	public function getDatosUsuarioModel($usuario,$tabla){
		$sql = "SELECT * FROM $tabla WHERE usuario =:usuario";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam('usuario',$usuario,PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
}