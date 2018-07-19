<?php
class MainController
{
    //DEVUELVE LA DESCRIPCION DEL NUMERAL
    public function printNumeralOnScreenController()
    {
        if (isset($_GET['idNumeral']) && !empty($_GET['idNumeral'])) {
            $dato = $_GET['idNumeral'];
            $resp = MainModel::printNumeralOnScreenModel('numerales', $dato);
            $descripcion = utf8_encode($resp['descripcion']);
            echo $descripcion;
        }
    }
}