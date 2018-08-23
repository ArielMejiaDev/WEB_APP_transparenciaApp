<?php
require_once 'Conexion.php';
class InformesModel extends Conexion
{
    //INFORME DE DOCS POR STATUS
    public function informeDocsPorStatusModel($datos)
    {
        $sql = "SELECT usuarios.usuario, ";
        $sql .= "departamentos.nombres AS departamento, ";
        $sql .= "numerales.descripcion AS numeralesDescripcion, ";
        $sql .= "categorias.descripcion AS categoriasDescripcion, ";
        $sql .= "documentos.n_doc, ";
        $sql .= "documentos.fecha_publicacion, ";
        $sql .= "documentos.fecha_doc, ";
        $sql .= "documentos.status, ";
        $sql .= "departamentos.nombres ";
        $sql .= "FROM (((( documentos INNER JOIN usuarios ON documentos.id_usuario=usuarios.id) ";
        $sql .= "INNER JOIN numerales ON documentos.id_numeral=numerales.id) ";
        $sql .= "INNER JOIN categorias ON documentos.id_categoria=categorias.id) ";
        $sql .= "INNER JOIN departamentos ON documentos.id_departamento=departamentos.id) ";
        $sql .= "WHERE documentos.status=:status AND documentos.fecha_publicacion BETWEEN :fechaInicial AND :fechaFinal";
        $stmt= Conexion::connect()->prepare($sql);
        $stmt->bindParam(':status',$datos['status'], PDO::PARAM_INT);
        $stmt->bindParam(':fechaInicial',$datos['fechaInicial'], PDO::PARAM_STR);
        $stmt->bindParam(':fechaFinal',$datos['fechaFinal'], PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //DEVUELVE EL USUARIO QUE GENERO EL DOCUMENTO
    public function getUserModel($tabla, $idUsuario)
    {
        $sql = "SELECT $tabla.usuario FROM $tabla WHERE $tabla.id=:id";
        $stmt = Conexion::connect()->prepare($sql);
        $stmt->bindParam(':id', $idUsuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    //INFORME DE VITACORA
    public function informeVitacoraModel($datos)
    {
        $sql = "SELECT usuarios.usuario, ";
        $sql .= "departamentos.nombres AS depto, ";
        $sql .= "vitacora.desc_actividad, ";
        $sql .= "vitacora.hora ";
        $sql .= "FROM ((vitacora INNER JOIN usuarios ON ";
        $sql .= "vitacora.id_usuario=usuarios.id) ";
        $sql .= "INNER JOIN departamentos ON ";
        $sql .= "usuarios.id_departamento=departamentos.id)";
        $stmt = Conexion::connect()->prepare($sql);
        $stmt->bindParam(':fechaInicial', $datos['fechaInicial'], PDO::PARAM_STR);
        $stmt->bindParam(':fechaFinal', $datos['fechaFinal'], PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}