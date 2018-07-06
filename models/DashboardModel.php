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
	//IMPRIME LOS ULTIMOS 5 DOCUMENTOS SUBIDOS
	public function docsSubidosRecientesModel($tabla1, $tabla2)
	{
		$sql = "SELECT $tabla1.nombres, $tabla1.apellidos,";
		$sql .= " $tabla2.n_doc, $tabla2.fecha_doc, $tabla2.status";
		$sql .= " FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.id = $tabla2.id_usuario";
		$sql .=" ORDER BY $tabla2.fecha_doc DESC LIMIT 5";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	//IMPRIME EL TOTAL DE DOCUMENTOS EN EL SERVIDOR
	public function totalDocsServidorModel($tabla)
	{
		$sql = "SELECT COUNT(*) AS total FROM $tabla";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	//LISTAR LOS ULTIMOS 5 REGISTROS DE LA VITACORA
	public function listarVitacoraModel($tabla1, $tabla2)
	{
		$sql = "SELECT $tabla1.foto, $tabla1.nombres, $tabla1.apellidos,";
		$sql .= " $tabla2.desc_actividad, $tabla2.hora FROM $tabla1";
		$sql .= " INNER JOIN $tabla2 ON $tabla1.id=$tabla2.id_usuario";
		$sql .= " ORDER BY $tabla2.hora DESC LIMIT 5";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}