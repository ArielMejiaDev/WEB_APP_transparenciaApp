<?php
require_once 'Conexion.php';
class NotificacionesModel extends Conexion
{
    public function listarNotificacionesSubidasModel($idUsuario)
    {
        $sql = "SELECT usuarios.foto, usuarios.nombres, usuarios.apellidos, ";
        $sql .= "mensajes.contenido, mensajes.n_doc FROM usuarios ";
        $sql .= "INNER JOIN mensajes ON usuarios.id=mensajes.remitente ";
        $sql .= "WHERE mensajes.receptor=:idUsuario AND mensajes.status=1 ORDER BY mensajes.id DESC";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function totalNotificacionesSubidasModel($idUsuario)
    {
        $sql = "SELECT COUNT(*) AS total FROM usuarios ";
        $sql .= "INNER JOIN mensajes ON usuarios.id=mensajes.remitente ";
        $sql .= "WHERE mensajes.receptor=:idUsuario";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    //CAMBIAR EL STATUS DE UNA NOTIFICACION A LEIDA
    public function cambiarStatusModel($tabla, $n_doc)
    {
        $sql = "UPDATE $tabla SET status = 0 WHERE $tabla.n_doc = :n_doc";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(':n_doc', $n_doc, PDO::PARAM_STR);
        $stmt->execute();
    }
}