<?php
require_once 'Conexion.php';
class DocModel{
    //CONTAR NUMERALES DE ARCHIVOS SUBIDOS AL SERVIDOR
    public function contarNumeralesDocsSubidosModel($dato,$tabla){
        $sql = "SELECT COUNT(id_numeral) AS cuenta FROM $tabla WHERE id_numeral=:id_numeral AND status != 5";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(':id_numeral',$dato,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    //CARGAR OPTIONS CON ID Y DESCRIPCION DE LOS NUMERALES
    public function cargarOptionsNumeralesModel($tabla){
        $sql = "SELECT * FROM $tabla WHERE status !=6";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //DEVOLVER SI EXISTE O NO CATEGORIAS CON EL ID_NUMERAL QUE COINCIDAN CON EL ID ENVIADO
    public function validarDocAjaxModel($dato,$tabla){
        $sql = "SELECT $tabla.id, $tabla.descripcion FROM $tabla WHERE $tabla.id_numeral=:id ";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(':id',$dato,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    public function listarDocumentosSubidosGeneralModel()
    {
        $sql = "SELECT documentos.id AS idDoc, documentos.id_usuario AS idUsuario, ";
        $sql .= "usuarios.usuario , documentos.id_departamento AS idDepto, ";
        $sql .= "departamentos.nombres AS nombreDepto, ";
        $sql .= "documentos.id_numeral AS idNumeral, ";
        $sql .= "numerales.descripcion AS numeralDesc, ";
        $sql .= "documentos.id_categoria AS idCategoria, ";
        $sql .= "categorias.descripcion AS categoriaDesc, ";
        $sql .= "documentos.fecha_doc, documentos.url_doc, ";
        $sql .= "documentos.n_doc, documentos.status FROM ";
        $sql .= "((((documentos INNER JOIN usuarios ON ";
        $sql .= "documentos.id_usuario=usuarios.id) INNER JOIN departamentos ON ";
        $sql .= "documentos.id_departamento = departamentos.id)";
        $sql .= " INNER JOIN numerales ON ";
        $sql .= "documentos.id_numeral = numerales.id) LEFT JOIN categorias ON ";
        $sql .= "documentos.id_categoria = categorias.id) ";
        $sql .= "WHERE documentos.status != 3";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
    //LISTAR ARCHIVOS SUBIDOS POR USUARIO
    public function listarDocumentosSubidosPorUsuarioModel($idUsuario)
    {
        $sql = "SELECT documentos.id AS idDoc, documentos.id_usuario AS idUsuario, ";
        $sql .= "usuarios.usuario , documentos.id_departamento AS idDepto, ";
        $sql .= "departamentos.nombres AS nombreDepto, ";
        $sql .= "documentos.id_numeral AS idNumeral, ";
        $sql .= "numerales.descripcion AS numeralDesc, ";
        $sql .= "documentos.id_categoria AS idCategoria, ";
        $sql .= "categorias.descripcion AS categoriaDesc, ";
        $sql .= "documentos.fecha_doc, documentos.url_doc, ";
        $sql .= "documentos.n_doc, documentos.status FROM ";
        $sql .= "((((documentos INNER JOIN usuarios ON ";
        $sql .= "documentos.id_usuario=usuarios.id) INNER JOIN departamentos ON ";
        $sql .= "documentos.id_departamento = departamentos.id)";
        $sql .= " INNER JOIN numerales ON ";
        $sql .= "documentos.id_numeral = numerales.id) LEFT JOIN categorias ON ";
        $sql .= "documentos.id_categoria = categorias.id) ";
        $sql .= "WHERE documentos.status != 3 AND usuarios.id=:id_usuario";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //LISTAR ARCHIVOS SUBIDOS POR DEPARTAMENTO
    public function listarDocumentosSubidosPorDeptoModel($idDeptoUsuario)
    {
        $sql = "SELECT documentos.id AS idDoc, documentos.id_usuario AS idUsuario, ";
        $sql .= "usuarios.usuario , documentos.id_departamento AS idDepto, ";
        $sql .= "departamentos.nombres AS nombreDepto, ";
        $sql .= "documentos.id_numeral AS idNumeral, ";
        $sql .= "numerales.descripcion AS numeralDesc, ";
        $sql .= "documentos.id_categoria AS idCategoria, ";
        $sql .= "categorias.descripcion AS categoriaDesc, ";
        $sql .= "documentos.fecha_doc, documentos.url_doc, ";
        $sql .= "documentos.n_doc, documentos.status FROM ";
        $sql .= "((((documentos INNER JOIN usuarios ON ";
        $sql .= "documentos.id_usuario=usuarios.id) INNER JOIN departamentos ON ";
        $sql .= "documentos.id_departamento = departamentos.id)";
        $sql .= " INNER JOIN numerales ON ";
        $sql .= "documentos.id_numeral = numerales.id) LEFT JOIN categorias ON ";
        $sql .= "documentos.id_categoria = categorias.id) ";
        $sql .= "WHERE documentos.status != 3 AND departamentos.id=:id_depto";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(':id_depto', $idDeptoUsuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //ACTIVAR DOCUMENTOS
    public function activarDocModel($datos, $tabla)
    {
        $sql = "UPDATE $tabla SET id_usuario=:idUsuario,id_departamento=:idDepto,";
        $sql .= "status=1,observaciones=:observaciones WHERE id=:idDoc";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(':idDoc',$datos['idDoc'],PDO::PARAM_INT);
        $stmt->bindParam(':idDepto',$datos['idDepto'],PDO::PARAM_INT);
        $stmt->bindParam(':idUsuario',$datos['idUsuario'],PDO::PARAM_INT);
        $stmt->bindParam(':observaciones',$datos['observaciones'],PDO::PARAM_STR);
        if ($stmt->execute())
        {
            return 'success';
        }else{
            return 'error';
        }
    }
    //LISTAR ARCHIVOS EXTEMPORANEOS
    public function listarDocumentosExtemporaneosModel()
    {
        $sql = "SELECT documentos.id AS idDoc, documentos.id_usuario AS idUsuario, ";
        $sql .= "usuarios.usuario , documentos.id_departamento AS idDepto, ";
        $sql .= "departamentos.nombres AS nombreDepto, ";
        $sql .= "documentos.id_numeral AS idNumeral, ";
        $sql .= "numerales.descripcion AS numeralDesc, ";
        $sql .= "documentos.id_categoria AS idCategoria, ";
        $sql .= "categorias.descripcion AS categoriaDesc, ";
        $sql .= "documentos.fecha_doc, documentos.url_doc, ";
        $sql .= "documentos.n_doc, documentos.status FROM ";
        $sql .= "((((documentos INNER JOIN usuarios ON ";
        $sql .= "documentos.id_usuario=usuarios.id) INNER JOIN departamentos ON ";
        $sql .= "documentos.id_departamento = departamentos.id)";
        $sql .= " INNER JOIN numerales ON ";
        $sql .= "documentos.id_numeral = numerales.id) LEFT JOIN categorias ON ";
        $sql .= "documentos.id_categoria = categorias.id) ";
        $sql .= "WHERE documentos.status = 5";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //aprobar documento
    public function aprobarDocModel($dato, $tabla)
    {
        $sql = "UPDATE $tabla SET status = 2 WHERE id = :id";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(':id',$dato,PDO::PARAM_INT);
        if ($stmt->execute()) {
            return 'success';
        }else{
            return 'error';
        }
    }
    //publicar documento
    public function publicarDocModel($dato,$tabla){
        $sql = "UPDATE $tabla SET status = 3 WHERE id = :id";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(':id',$dato,PDO::PARAM_INT);
        if ($stmt->execute()) {
            return 'success';
        }else{
            return 'error';
        }
    }
    //CREAR FORMULARIO
    public function crearFormEditarDocModel($dato,$tabla){
        $sql = "SELECT documentos.id, documentos.id_usuario, ";
        $sql .= "documentos.id_departamento, documentos.id_numeral,";
        $sql .= " numerales.descripcion AS descNumeral , documentos.id_categoria";
        $sql .= ",categorias.descripcion AS descCategoria , ";
        $sql .= "documentos.fecha_publicacion, documentos.fecha_doc, ";
        $sql .= "documentos.year, documentos.mes, documentos.url_doc,";
        $sql .= " documentos.n_doc, documentos.status, documentos.justificacion";
        $sql .= ", documentos.fecha_actualizado, documentos.n_doc FROM ";
        $sql .= "((documentos INNER JOIN numerales ON documentos.id_numeral =";
        $sql .= " numerales.id) INNER JOIN categorias ON ";
        $sql .= "documentos.id_categoria = categorias.id) WHERE documentos.id = :id";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(':id',$dato,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    //listar numerales
    public function listaNumeralesModel($tabla){
        $sql = "SELECT id, descripcion FROM $tabla WHERE status!=6";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //ACTULIZAR DOCUMENTOS CON CATEGORIAS
    public function actualizarArchivoConCategoriaModel($datos, $tabla){
        $sql = "UPDATE $tabla SET id_usuario=:id_usuario,id_departamento=:id_departamento,id_numeral=:id_numeral,id_categoria=:id_categoria,
        fecha_publicacion=:fecha_publicacion,fecha_doc=:fecha_doc,year=:year,mes=:mes,url_doc=:url_doc,n_doc=:n_doc,status=:status WHERE id=:id";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(':id', $datos['idDoc'], PDO::PARAM_INT);
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
    //ACTUALIZAR DOCUMENTO SIN CAMBIAR EL DOCUMENTO SUBIDO
    public function actualizarDocSinCambiarDocModel($datosSinDoc,$tabla){
        $sql = "UPDATE $tabla SET";
        $sql .= "id_usuario=:idUsuario,";
        $sql .= "id_departamento=:idDeptoUsuario,";
        $sql .= "id_numeral=:id_numeral,";
        $sql .= "id_categoria=:id_categoria,";
        $sql .= "fecha_doc=:fecha_doc,";
        $sql .= "year=:year,";
        $sql .= "mes=:mes ";
        $sql .= "WHERE id=:idDoc";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(':idUsuario', $datosSinDoc['idUsuario'], PDO::PARAM_INT);
        $stmt->bindParam(':idDeptoUsuario', $datosSinDoc['idDeptoUsuario'], PDO::PARAM_INT);
        $stmt->bindParam(':idDoc', $datosSinDoc['idDoc'], PDO::PARAM_INT);
        $stmt->bindParam(':idNumeralEditar', $datosSinDoc['idNumeralEditar'], PDO::PARAM_INT);
        $stmt->bindParam(':idCategoriaEditar', $datosSinDoc['idCategoriaEditar'], PDO::PARAM_INT);
        $stmt->bindParam(':fecha_docEditar', $datosSinDoc['fecha_docEditar'], PDO::PARAM_STR);
        $stmt->bindParam(':year', $datosSinDoc['year'], PDO::PARAM_STR);
        $stmt->bindParam(':mes', $datosSinDoc['mes'], PDO::PARAM_STR);
        if ($stmt->execute()) {
            return 'success';
        }else{
            return 'error';
        }
    }
    ///RECIVE EL ID DEL DOC Y DEVUELVE LA URL DEL DOC EL PATH 
    public function getUrlDocModel($idDoc, $tabla){
        $sql = "SELECT url_doc FROM $tabla WHERE id = :idDoc";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(':idDoc', $idDoc, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    //
    public function actualizarDocConCatConDocModel($datos, $tabla){
        $sql = "UPDATE $tabla SET ";
        $sql .= "id_usuario=:idUsuario,";
        $sql .= "id_departamento=:idDeptoUsuario,";
        $sql .= "id_numeral=:idNumeralEditar,";
        $sql .= "id_categoria=:idCategoriaEditar,";
        $sql .= "fecha_doc=:fecha_docEditar,";
        $sql .= "year=:year,";
        $sql .= "mes=:mes,";
        $sql .= "url_doc=:url_docEditar ";
        $sql .= "WHERE id=:idDoc";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(':idUsuario', $datos['idUsuario'], PDO::PARAM_INT);
        $stmt->bindParam(':idDeptoUsuario', $datos['idDeptoUsuario'], PDO::PARAM_INT);
        $stmt->bindParam(':idNumeralEditar', $datos['idNumeralEditar'], PDO::PARAM_INT);
        $stmt->bindParam(':idCategoriaEditar', $datos['idCategoriaEditar'], PDO::PARAM_INT);
        $stmt->bindParam(':fecha_docEditar', $datos['fecha_docEditar'], PDO::PARAM_STR);
        $stmt->bindParam(':year', $datos['year'], PDO::PARAM_STR);
        $stmt->bindParam(':mes', $datos['mes'], PDO::PARAM_STR);
        $stmt->bindParam(':url_docEditar', $datos['url_docEditar'], PDO::PARAM_STR);
        $stmt->bindParam(':idDoc', $datos['idDoc'], PDO::PARAM_INT);
        if ($stmt->execute()) {
            return 'success';
        }else{
            return 'error';
        }
    }
    //
    public function actualizarDocConCatSinDocModel($datos, $tabla){
          
        $sql = "UPDATE $tabla SET ";
        $sql .= "id_usuario=:idUsuario,";
        $sql .= "id_departamento=:idDeptoUsuario,";
        $sql .= "id_numeral=:idNumeralEditar,";
        $sql .= "id_categoria=:idCategoriaEditar,";
        $sql .= "fecha_doc=:fecha_docEditar,";
        $sql .= "year=:year,";
        $sql .= "mes=:mes ";
        $sql .= "WHERE id=:idDoc";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(':idUsuario', $datos['idUsuario'], PDO::PARAM_INT);
        $stmt->bindParam(':idDeptoUsuario', $datos['idDeptoUsuario'], PDO::PARAM_INT);
        $stmt->bindParam(':idDoc', $datos['idDoc'], PDO::PARAM_INT);
        $stmt->bindParam(':idNumeralEditar', $datos['idNumeralEditar'], PDO::PARAM_INT);
        $stmt->bindParam(':idCategoriaEditar', $datos['idCategoriaEditar'], PDO::PARAM_INT);
        $stmt->bindParam(':fecha_docEditar', $datos['fecha_docEditar'], PDO::PARAM_STR);
        $stmt->bindParam(':year', $datos['year'], PDO::PARAM_STR);
        $stmt->bindParam(':mes', $datos['mes'], PDO::PARAM_STR);
        if ($stmt->execute()) {
            return 'success';
        }else{
            return 'error';
        }
    }
    //RECHAZAR EL DOCUMENTO
    public function rechazarDocModel($datos, $tabla){
        $sql = "UPDATE $tabla SET status=4 , justificacion=:justificacion WHERE id = :idDoc";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(':idDoc',$datos['idDoc'],PDO::PARAM_INT);
        $stmt->bindParam(':justificacion',$datos['justificacion'],PDO::PARAM_STR);
        if ($stmt->execute()) {
            return 'success';
        }else{
            return 'error';
        }
    }
    //INICIAN FUNCIONES PARA LA VITACORA DE LOS DOCUMENTOS
    public function vitacoraSubirDocModel($tabla,$datos)
    {
        $sql = "INSERT INTO $tabla(id_usuario, desc_actividad, fecha) VALUES (:id_usuario,:desc_actividad,CURRENT_TIMESTAMP)";
        //$sql .= "";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(':id_usuario',$datos['id_usuario'],PDO::PARAM_INT);
        $stmt->bindParam(':desc_actividad',$datos['desc_actividad'],PDO::PARAM_STR);
        $stmt->execute();
    }
    //INSERTA UN MENSAJE CON CADA ACCION DE LOS DOCUMENTOS
    public function insertarMsjModel($tabla, $datos)
    {
        $sql = "INSERT INTO $tabla(remitente, receptor, contenido, status, n_doc) VALUES (:remitente,:receptor,:contenido,:status,:n_doc)";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(':remitente', $datos['remitente'], PDO::PARAM_INT);
        $stmt->bindParam(':receptor', $datos['receptor'], PDO::PARAM_INT);
        $stmt->bindParam(':contenido', $datos['contenido'], PDO::PARAM_STR);
        $stmt->bindParam(':status', $datos['status'], PDO::PARAM_INT);
        $stmt->bindParam(':n_doc', $datos['n_doc'], PDO::PARAM_STR);
        $stmt->execute();
    }
    //BUSCAR EL RECEPTOR PARA LA NOTIFICACION DE QUE SE SUBIO UN DOCUMENTO
    public function buscarReceptorModel($tabla, $idDeptoUsuario)
    {
        $sql = "SELECT id FROM $tabla WHERE usuarios.id_departamento=:id_departamento AND usuarios.rol='jefeRedaccion'";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(':id_departamento', $idDeptoUsuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //RETORNA LOS JEFES DE REDACCION Y EDITORES PARA NOTIFICACIONES AL APROBAR Y O RECHAZAR
    public function buscarReceptoresJefesYEditoresModel($tabla, $idDeptoUsuario)
    {
        $sql = "SELECT id FROM $tabla WHERE $tabla.id_departamento=:id_departamento AND $tabla.rol='jefeRedaccion' OR $tabla.rol='editor' ";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(':id_departamento', $idDeptoUsuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //MOSTRAR DATOS DE UN DOCUMENTO INDIVIDUAL
    public function documentoIndividualSubidoModel($n_doc)
    {
        $sql = "SELECT documentos.id AS idDoc, documentos.id_usuario AS idUsuario, ";
        $sql .= "usuarios.usuario , documentos.id_departamento AS idDepto, ";
        $sql .= "departamentos.nombres AS nombreDepto, ";
        $sql .= "documentos.id_numeral AS idNumeral, ";
        $sql .= "numerales.descripcion AS numeralDesc, ";
        $sql .= "documentos.id_categoria AS idCategoria, ";
        $sql .= "categorias.descripcion AS categoriaDesc, ";
        $sql .= "documentos.fecha_doc, documentos.url_doc, ";
        $sql .= "documentos.n_doc, documentos.status FROM ";
        $sql .= "((((documentos INNER JOIN usuarios ON ";
        $sql .= "documentos.id_usuario=usuarios.id) INNER JOIN departamentos ON ";
        $sql .= "documentos.id_departamento = departamentos.id)";
        $sql .= " INNER JOIN numerales ON ";
        $sql .= "documentos.id_numeral = numerales.id) LEFT JOIN categorias ON ";
        $sql .= "documentos.id_categoria = categorias.id) ";
        $sql .= "WHERE documentos.status != 3 AND documentos.n_doc=:n_doc";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(':n_doc', $n_doc, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //DEVUELVE EL N_DOC DE UN DOCUMENTO SUBIDO AL SERVIDOR
    public function buscarNdocModel($tabla, $id_doc)
    {
        $sql = "SELECT $tabla.n_doc FROM $tabla WHERE $tabla.id = :id_doc";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(':id_doc', $id_doc, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    //DEVUELVE EL AUTOR DE UN DOCUMENTOS SUBIDO AL SERVIDOR
    public function buscarAutorModel($tabla, $id_doc)
    {
        $sql = "SELECT $tabla.id_usuario FROM $tabla WHERE $tabla.id = :id_doc";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(':id_doc', $id_doc, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>