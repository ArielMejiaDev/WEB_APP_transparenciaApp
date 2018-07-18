<?php
require_once 'Conexion.php';
//CLASE PARA EL SIDEBAR
class SidebarModel extends Conexion
{   
    //METODO PARA LISTAR LOS NUMERALES EN EL SIDEBAR
    public function listarNumeralesModel($tabla)
    {
        $sql = "SELECT $tabla.id, $tabla.descripcion FROM $tabla";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}