<?php
require_once 'Conexion.php';
class DocModel{
    //subir archivos
    

    //CARGAR OPTIONS CON ID Y DESCRIPCION DE LOS NUMERALES
    public function cargarOptionsNumeralesModel($tabla){
        $sql = "SELECT * FROM $tabla";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //DEVOLVER SI EXISTE O NO CATEGORIAS CON EL ID_NUMERAL QUE COINCIDAN CON EL ID ENVIADO
    public function validarDocAjaxModel($dato,$tabla){
        $sql = "SELECT COUNT($tabla.id) AS cuenta, $tabla.id, $tabla.descripcion FROM $tabla WHERE $tabla.id_numeral=:id ";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(':id',$dato,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>