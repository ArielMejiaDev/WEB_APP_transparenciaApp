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
        $sql = "INSERT INTO $tabla(id_numeral, id_usuario,";
        $sql .= " id_departamento, id_categoria, fecha_publicacion, fecha_doc,";
        $sql .= " mes, url_doc, n_doc, status, year)";
        $sql .= " VALUES(:id_numeral, :id_usuario, :id_departamento, :id_categoria,";
        $sql .= " :fecha_publicacion , :fecha_doc, :mes, :url_doc, :n_doc, :status, :year)";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(':id_numeral', $datos['idNumeral'], PDO::PARAM_INT);
        $stmt->bindParam(':id_usuario', $datos['id_usuario'], PDO::PARAM_INT);
        $stmt->bindParam(':id_departamento', $datos['id_departamento'], PDO::PARAM_INT);
        $stmt->bindParam(':id_categoria', $datos['idCategoria'], PDO::PARAM_INT);
        $stmt->bindParam(':fecha_publicacion', $datos['fecha_publicacion'], PDO::PARAM_STR);
        $stmt->bindParam(':fecha_doc', $datos['fecha_doc'], PDO::PARAM_STR);
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
        $sql .= "(id_numeral, id_usuario, id_departamento, fecha_publicacion, fecha_doc, year, mes, url_doc, n_doc, status)";
        $sql .= " VALUES ";
        $sql .= "(:id_numeral2, :id_usuario, :id_departamento, :fecha_publicacion2, :fecha_doc2, :year2, :mes2, :doc2, :n_doc2, :status2)";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(':id_numeral2', $datos['idNumeral2'], PDO::PARAM_INT);
        $stmt->bindParam(':id_usuario', $datos['id_usuario'], PDO::PARAM_INT);
        $stmt->bindParam(':id_departamento', $datos['id_departamento'], PDO::PARAM_INT);
        $stmt->bindParam(':fecha_publicacion2', $datos['fecha_publicacion2'], PDO::PARAM_STR);
        $stmt->bindParam(':fecha_doc2', $datos['fecha_doc2'], PDO::PARAM_STR);
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

    //REVISAR SI EL DOC PDF YA EXISTE
    public function validarDocTitleAjaxModel($url_doc,$tabla){
        $sql = "SELECT COUNT(url_doc) AS cuenta FROM documentos";
        $sql .= " WHERE url_doc=:url_doc";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(':url_doc',$url_doc,PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //LISTAR ARCHIVOS SUBIDOS GENERALES PARA ROLES DE ADMIN Y JEFES DE REDACCION
    public function listarDocumentosSubidosGeneralModel($tabla1, $tabla2, $tabla3, $tabla4, $tabla5){
        $sql = "SELECT $tabla2.descripcion AS descNum , $tabla3.descripcion AS descCat , $tabla1.id , $tabla4.usuario, $tabla5.nombres AS nombreDepto , $tabla1.id_usuario , $tabla1.id_departamento , $tabla1.id_numeral , $tabla1.id_categoria , $tabla1.fecha_doc, $tabla1.url_doc, $tabla1.n_doc , $tabla1.status FROM (((($tabla1 INNER JOIN $tabla2 ON $tabla1.id_numeral = $tabla2.id) LEFT JOIN $tabla3 ON $tabla1.id_categoria = $tabla3.id) INNER JOIN $tabla4 ON $tabla1.id_usuario = $tabla4.id)INNER JOIN $tabla5 ON $tabla1.id_departamento = $tabla5.id )";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
}
?>