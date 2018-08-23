<?php
require_once '../../controllers/NotificacionesController.php';
require_once '../../models/NotificacionesModel.php';
class AjaxNotifications
{
    public $id;
    public function sendNotificationsAjax()
    {
        $dato = $this->id;
        $resp = NotificacionesController::listarNotificacionesSubidasController($dato);
        echo $resp;
    }

}
if (isset($_POST['idUsuarioNotificaciones']) && !empty($_POST['idUsuarioNotificaciones']))
{
    $not = new AjaxNotifications();
    $not->id = $_POST['idUsuarioNotificaciones'];
    $not->sendNotificationsAjax();
}
