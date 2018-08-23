<?php 
require_once 'Conexion.php';
class MainModel extends Conexion
{
    //DEVUELVE LA DESCRIPCION DEL NUMERAL
    public function printNumeralOnScreenModel($tabla, $dato)
    {
        $sql = "SELECT $tabla.descripcion FROM $tabla WHERE $tabla.id=:idNumeral";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(':idNumeral', $dato, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);

    }
    //DEVUELVE EL STATUS DEL NUMERAL
    public function evalStatusNumeralModel($tabla, $dato)
    {
        $sql = "SELECT $tabla.status, $tabla.aviso FROM $tabla WHERE $tabla.id=:idNumeral";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(':idNumeral', $dato, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    //IMPRIME LOS TABS CON AÑOS Y MESES PARA CADA NUMERAL
    public function renderTabsModel($tabla, $idNumeral)
    {
        $sql = "SELECT $tabla.year FROM $tabla WHERE $tabla.id_numeral=:idNumeral GROUP BY year ORDER BY year DESC";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(':idNumeral', $idNumeral, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}