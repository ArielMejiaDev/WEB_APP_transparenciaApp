<?php
require_once 'Conexion.php';
class DocumentosModel extends Conexion
{
    //LISTAR DOCUMENTOS PARA VER EN LINEA
    public function listarDocsModel($tabla, $datos)
    {
        $sql = "SELECT $tabla.url_doc FROM $tabla";
        $sql .= " WHERE $tabla.id_numeral=:idNumeral";
        $sql .= " AND $tabla.year=:year";
        $sql .= " AND $tabla.mes=:mes";
        $sql .= " AND $tabla.id_categoria=:idCategoria";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(':idNumeral', $datos['idNumeral'], PDO::PARAM_INT);
        $stmt->bindParam(':year', $datos['year'], PDO::PARAM_STR);
        $stmt->bindParam(':mes', $datos['mes'], PDO::PARAM_STR);
        $stmt->bindParam(':idCategoria', $datos['idCategoria'], PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}