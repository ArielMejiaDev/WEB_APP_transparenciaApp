<?php
//CLASE PARA EL SIDEBAR
class SidebarController
{   
    //METODO PARA LISTAR LOS NUMERALES EN EL SIDEBAR
    public function listarNumeralesController()
    {
        $respuesta = SidebarModel::listarNumeralesModel('numerales');
        foreach ($respuesta as $key => $value)
        {
            echo '<li class="parent"><a href="?action=main&idNumeral='.$value['id'].'" numId="'.$value['id'].'"><span><small>'.utf8_encode($value['descripcion']).'</small></span></a>
            </li>';
        }
    }
}