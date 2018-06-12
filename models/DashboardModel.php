<?php
require_once "Conexion.php";
class DashboardModel extends Conexion{
	//cuenta el numero de usuarios
	public function contarUsuariosModel($tabla){
		$sql = "SELECT COUNT(*) AS total FROM usuarios";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
}