<?php
class InformesModel
{
    //GENERA INFORME
    public function generarInformeModel($tabla, $datos)
    {
        $sql = "SELECT * FROM $tabla WHERE ";
        $sql .= "($tabla.fecha_publicacion ";
        $sql .= "BETWEEN :fechaInicial AND :fechaFinalInicial) ";
        $sql .= "AND $tabla.status=:status";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(':status', $datos['statusInforme'], PDO::PARAM_INT);
        $stmt->bindParam(':fechaInicial', $datos['fechaInicialInforme'], PDO::PARAM_STR);
        $stmt->bindParam(':fechaFinalInicial', $datos['fechaFinalInforme'], PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}