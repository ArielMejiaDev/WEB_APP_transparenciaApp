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
            if ($status==1)
            {
                echo '<div class="panel panel-full-color panel-full-danger">
                        <p class="text-center"><img width="100px" src="views/images/logo blanco y negro transparente.png" style="margin-top:20px;"></p>
                        <div class="panel-heading panel-heading-contrast">Aviso
                        <div class="tools"></div><span class="panel-subtitle">Importante!</span>
                        </div>
                        <div class="panel-body">
                        <p> '.$aviso.'</p>
                        </div>
                    </div>';
            }else{
                $this->renderTabsController();
            }
        } 
    }
    public function renderTabsController()
    {
        echo "tabs";
    }
}