<?php
class DocumentosController
{
    //LISTAR DOCUMENTOS PARA VERLOS EN LINEA
    public function listarDocsController()
    {
        if (isset($_GET['idNumeral']) && !empty($_GET['idNumeral']) && 
            isset($_GET['year']) && !empty($_GET['year']) && 
            isset($_GET['mes']) && !empty($_GET['mes']) && 
            isset($_GET['idCategoria']) && !empty($_GET['idCategoria']))
        {
            $datos = array('idNumeral'=>$_GET['idNumeral'], 
                            'year'=>$_GET['year'], 
                            'mes'=>$_GET['mes'], 
                            'idCategoria'=>$_GET['idCategoria']);
            $resp = DocumentosModel::listarDocsModel('documentos', $datos);
            foreach ($resp as $key => $value)
            {
                echo '<a target="_blank" href="http://localhost/app/backend/'.$value['url_doc'].'" class="list-group-item">
                <span class="text-primary mdi mdi-collection-pdf icon"></span>
                '.substr(utf8_encode($value['url_doc']),11).'
            </a>';
            }
        }
    }
}