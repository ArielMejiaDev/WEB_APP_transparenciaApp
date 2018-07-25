<?php
require_once 'Conexion.php';
class InformesModel extends Conexion
{
    //INFORME DE DOCS POR STATUS
    public function informeDocsPorStatusModel($datos)
    {
        $sql = "SELECT usuarios.usuario, ";
        $sql .= "numerales.descripcion AS numeralesDescripcion, ";
        $sql .= "categorias.descripcion AS categoriasDescripcion, ";
        $sql .= "documentos.n_doc, ";
        $sql .= "documentos.fecha_publicacion, ";
        $sql .= "documentos.fecha_doc, ";
        $sql .= "documentos.status ";
        $sql .= "FROM ((( documentos INNER JOIN usuarios ON documentos.id_usuario=usuarios.id) ";
        $sql .= "INNER JOIN numerales ON documentos.id_numeral=numerales.id) ";
        $sql .= "INNER JOIN categorias ON documentos.id_categoria=categorias.id) ";
        $sql .= "WHERE documentos.status=:status ";
        $sql .= "AND documentos.fecha_publicacion BETWEEN :fechaInicial AND :fechaFinal";
        $stmt= Conexion::connect()->prepare($sql);
        $stmt->bindParam(':status',$datos['status'], PDO::PARAM_INT);
        $stmt->bindParam(':fechaInicial',$datos['fechaInicial'], PDO::PARAM_STR);
        $stmt->bindParam(':fechaFinal',$datos['fechaFinal'], PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}