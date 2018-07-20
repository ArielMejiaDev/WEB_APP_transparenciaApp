<?php
require_once 'conexion.php';
class AjaxModuleModel extends Conexion
{
    //LISTAR CATEGORIAS CON LINKS A LA VISTA DOCUMENTOS SEGUN IDNUMERAL, AÑO Y MES
    public function listarCategoriasAjaxModel($tabla1, $tabla2, $datos)
    {
        $sql = "SELECT $tabla1.id_categoria, $tabla2.descripcion,";
        $sql .= " COUNT($tabla1.id_categoria) AS totalDocs";
        $sql .= " FROM $tabla1 INNER JOIN $tabla2";
        $sql .= " ON $tabla1.id_categoria=$tabla2.id";
        $sql .= " WHERE $tabla1.id_numeral=:idNumeral AND $tabla1.year=:year";
        $sql .= " AND $tabla1.mes=:mes";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(':idNumeral', $datos['idNumeral'], PDO::PARAM_INT);
        $stmt->bindParam(':year', $datos['year'], PDO::PARAM_STR);
        $stmt->bindParam(':mes', $datos['mes'], PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}