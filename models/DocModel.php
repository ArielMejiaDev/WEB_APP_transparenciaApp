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

    //modelo para insertar datos del archivo subido en al tabla docs
    public function subirArchivoConCategoriaModel($datos, $tabla)
    {
        $sql = "INSERT INTO $tabla(id_numeral, id_categoria, fecha, mes, url_doc, n_doc, status, year) VALUES (:id_numeral, :id_categoria, :fecha, :mes, :url_doc, :n_doc, :status, :year)";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(':id_numeral', $datos['idNumeral'], PDO::PARAM_INT);
        $stmt->bindParam(':id_categoria', $datos['idCategoria'], PDO::PARAM_INT);
        $stmt->bindParam(':fecha', $datos['fecha'], PDO::PARAM_STR);
        $stmt->bindParam(':year', $datos['year'], PDO::PARAM_INT);
        $stmt->bindParam(':mes', $datos['mes'], PDO::PARAM_STR);
        $stmt->bindParam(':url_doc', $datos['url_doc'], PDO::PARAM_STR);
        $stmt->bindParam(':n_doc', $datos['n_doc'], PDO::PARAM_STR);
        $stmt->bindParam(':status', $datos['status'], PDO::PARAM_STR);
        if ($stmt->execute()) {
            return 'success';
        }else{
            return 'error';
        }
    }

    //modelo para insertar datos del documento subido cuando no tiene categoria
    public function subirArchivoSinCategoriaModel($datos,$tabla)
    {
        $sql = "INSERT INTO $tabla";
        $sql .= "(id_numeral, fecha, year, mes, url_doc, n_doc, status )";
        $sql .= " VALUES ";
        $sql .= "(:id_numeral2, :fecha2, :year2, :mes2, :doc2, :n_doc2, :status2)";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(':id_numeral2', $datos['idNumeral2'], PDO::PARAM_INT);
        $stmt->bindParam(':fecha2', $datos['fecha2'], PDO::PARAM_STR);
        $stmt->bindParam(':year2', $datos['year2'], PDO::PARAM_INT);
        $stmt->bindParam(':mes2', $datos['mes2'], PDO::PARAM_STR);
        $stmt->bindParam(':doc2', $datos['doc2'], PDO::PARAM_STR);
        $stmt->bindParam(':n_doc2', $datos['n_doc2'], PDO::PARAM_STR);
        $stmt->bindParam(':status2', $datos['status2'], PDO::PARAM_STR);
        if ($stmt->execute()) {
            return 'success';
        }else{
            return 'error';
        }
    }
}
?>