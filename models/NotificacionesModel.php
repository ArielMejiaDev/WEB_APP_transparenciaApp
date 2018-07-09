<?php
require_once 'Conexion.php';
class NotificacionesModel extends Conexion
{
    public function listarNotificacionesSubidasModel($idUsuario)
    {
        $sql = "SELECT usuarios.foto, usuarios.nombres, usuarios.apellidos, ";
        $sql .= "mensajes.contenido, mensajes.n_doc FROM usuarios ";
        $sql .= "INNER JOIN mensajes ON usuarios.id=mensajes.remitente ";
        $sql .= "WHERE mensajes.receptor=:idUsuario";
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
}