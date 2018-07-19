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
    //DEVUELVE EL STATUS DEL NUMERAL
    public function evalStatusNumeralController()
    {
        if (isset($_GET['idNumeral']) && !empty($_GET['idNumeral']))
        {
            $dato = $_GET['idNumeral'];
            $resp = MainModel::evalStatusNumeralModel('numerales', $dato);
            $status = $resp['status'];
            $aviso = utf8_encode($resp['aviso']);
            $bannerAlerta='';
            if ($status==1)
            {
                $bannerAlerta = '<div class="panel panel-full-color panel-full-danger">
                                    <p class="text-center"><img width="100px" src="views/images/logo blanco y negro transparente.png" style="margin-top:20px;"></p>
                                    <div class="panel-heading panel-heading-contrast">Aviso
                                    <div class="tools"></div><span class="panel-subtitle">Importante!</span>
                                    </div>
                                    <div class="panel-body">
                                    <p> '.$aviso.'</p>
                                    </div>
                                </div>';
            }
        }
        return $bannerAlerta;
    }
    //IMPRIME EL TABS CON LOS AÑOS Y MESES DE CADA NUMERAL
    public function renderTabsController($idNumeral)
    {
        if (isset($_GET['idNumeral']) && !empty($_GET['idNumeral']))
        {
            $resp = MainModel::renderTabsModel('documentos', $idNumeral);
            foreach ($resp as $key => $value)
            {
                echo '<li class=""><a style="font-size:18px;font-weight: bold;" href="#'.$value['year'].'" data-toggle="tab" aria-expanded="true">'.$value['year'].'</a></li>';
            }   
        }
    }
    //imprimir el contenido de los tabs por años
    public function renderContentTabsController($idNumeral)
    {
        if (isset($_GET['idNumeral']) && !empty($_GET['idNumeral']))
        {
            $resp = MainModel::renderTabsModel('documentos', $idNumeral);
            foreach ($resp as $key => $value)
            {
                echo '<div id="'.$value['year'].'" class="tab-pane cont">
                <ul class="nav nav-pills nav-justified">
                    <li role="presentation"><a class="mes" idNumeral="'.$_GET['idNumeral'].'" year="'.$value['year'].'" mes="enero" href="#">Enero</a></li>
                    <li role="presentation"><a class="mes" idNumeral="'.$_GET['idNumeral'].'" year="'.$value['year'].'" mes="febrero" href="#">Febrero</a></li>
                    <li role="presentation"><a class="mes" idNumeral="'.$_GET['idNumeral'].'" year="'.$value['year'].'" mes="marzo" href="#">Marzo</a></li>
                    <li role="presentation"><a class="mes" idNumeral="'.$_GET['idNumeral'].'" year="'.$value['year'].'" mes="abril" href="#">Abril</a></li>
                    <li role="presentation"><a class="mes" idNumeral="'.$_GET['idNumeral'].'" year="'.$value['year'].'" mes="mayo" href="#">Mayo</a></li>
                    <li role="presentation"><a class="mes" idNumeral="'.$_GET['idNumeral'].'" year="'.$value['year'].'" mes="junio" href="#">Junio</a></li>
                    <li role="presentation"><a class="mes" idNumeral="'.$_GET['idNumeral'].'" year="'.$value['year'].'" mes="julio" href="#">Julio</a></li>
                    <li role="presentation"><a class="mes" idNumeral="'.$_GET['idNumeral'].'" year="'.$value['year'].'" mes="agosto" href="#">Agosto</a></li>
                    <li role="presentation"><a class="mes" idNumeral="'.$_GET['idNumeral'].'" year="'.$value['year'].'" mes="septiembre" href="#">Septiembre</a></li>
                    <li role="presentation"><a class="mes" idNumeral="'.$_GET['idNumeral'].'" year="'.$value['year'].'" mes="octubre" href="#">Octubre</a></li>
                    <li role="presentation"><a class="mes" idNumeral="'.$_GET['idNumeral'].'" year="'.$value['year'].'" mes="noviembre" href="#">Noviembre</a></li>
                    <li role="presentation"><a class="mes" idNumeral="'.$_GET['idNumeral'].'" year="'.$value['year'].'" mes="diciembre" href="#">Diciembre</a></li>
                </ul>
            </div>';
            }   
        }
    }
        
}