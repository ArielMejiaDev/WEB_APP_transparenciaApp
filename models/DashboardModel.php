<?php
require_once "Conexion.php";
class DashboardModel extends Conexion{
	//cuenta el numero de usuarios
	public function contarUsuariosModel($tabla)
	{
		$sql = "SELECT COUNT(*) AS total FROM $tabla";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	//imprime el numero de documentos publicados
	public function contarDocsPublicadosModel($tabla)
	{
		$sql = "SELECT COUNT(*) AS total FROM $tabla WHERE status=3";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	//IMPRIME DOCUMENTOS APROBADOS
	public function contarDocsAprobadosModel($tabla)
	{
		$sql = "SELECT COUNT(*) AS total FROM $tabla WHERE status=2";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	//IMPRIME EL NUMERO DE DOCUMENTOS RECHAZADOS
	public function contarDocsRechazadosModel($tabla)
	{
		$sql = "SELECT COUNT(*) AS total FROM $tabla WHERE status=4";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
}