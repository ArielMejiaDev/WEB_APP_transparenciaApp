<?php
class AjaxModuleController
{
    //LISTAR CATEGORIA SEGUN EL IDNUMERAL, EL AÑO Y EL MES
    public function listarCategoriasAjaxController($datos)
    {
        $resp = AjaxModuleModel::listarCategoriasAjaxModel('documentos', 'categorias', $datos);
        //var_dump($resp);
        foreach ($resp as $key => $value)
        {
            if ($value['totalDocs']>0)
            {
                echo '<a href="?action=documentos&idNumeral='.$datos['idNumeral'].'&year='.$datos['year'].'&mes='.$datos['mes'].'&idCategoria='.$value['id_categoria'].'" class="list-group-item">
                    <span class="badge badge-primary">'.$value['totalDocs'].'</span> 
                    <span class="text-primary mdi mdi-info icon"></span>
                    '.utf8_encode($value['descripcion']).'
                </a>';
            }else{
                echo '<a href="#" class="list-group-item"> 
                    <span class="text-danger mdi mdi-alert-triangle icon"></span>
                    No hay documentos disponibles.
                </a>';
            }
        }
    }
}