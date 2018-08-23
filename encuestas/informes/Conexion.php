<?php
class Conexion
{
    //CONEXION CON LA BD
    public function connect()
    {
        $dbConn = new PDO('mysql:host=localhost;dbname=transparencia_app', 'root', '');
        return $dbConn;
    }
}